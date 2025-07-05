<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'units',
        'year_level',
        'trimester',
        'track',
        'course',
        'sort_order',
    ];

    /**
     * Get student grades for this subject
     */
    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class);
    }

    /**
     * Get grades for this subject (alias for studentGrades)
     */
    public function grades()
    {
        return $this->hasMany(StudentGrade::class, 'subject_id');
    }

    /**
     * Get the grade for a specific student
     */
    public function gradeForStudent($studentId)
    {
        return $this->studentGrades()->where('user_id', $studentId)->first();
    }

    /**
     * Scope subjects by year level and trimester
     */
    public function scopeByTrimester($query, $yearLevel, $trimester)
    {
        return $query->where('year_level', $yearLevel)
                    ->where('trimester', $trimester);
    }

    /**
     * Scope subjects by track (including common subjects)
     */
    public function scopeByTrack($query, $track)
    {
        return $query->where(function($q) use ($track) {
            $q->where('track', $track)
              ->orWhereNull('track'); // Include common subjects
        });
    }

    /**
     * Scope subjects by course
     */
    public function scopeByCourse($query, $course)
    {
        return $query->where('course', $course);
    }
}
