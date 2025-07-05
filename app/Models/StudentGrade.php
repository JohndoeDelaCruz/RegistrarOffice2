<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'grade',
        'academic_year',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the student that owns this grade
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the subject for this grade
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Scope to completed grades
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * Scope to pending grades
     */
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    /**
     * Check if grade is passing
     */
    public function isPassing()
    {
        if (!$this->grade) {
            return false;
        }
        
        // Assuming grades like 1.0, 1.5, 2.0, 2.5, 3.0 are passing
        // and grades like 5.0, F, INC are failing
        $passingGrades = ['1.0', '1.25', '1.5', '1.75', '2.0', '2.25', '2.5', '2.75', '3.0'];
        return in_array($this->grade, $passingGrades);
    }
}
