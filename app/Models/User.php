<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'track',
        'student_id',
        'course',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is a student
     */
    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    /**
     * Check if user is faculty
     */
    public function isFaculty(): bool
    {
        return $this->hasRole('faculty');
    }

    /**
     * Check if user is dean
     */
    public function isDean(): bool
    {
        return $this->hasRole('dean');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Get student grades
     */
    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class);
    }

    /**
     * Get subjects available for this student based on course and track
     */
    public function getAvailableSubjects()
    {
        return Subject::byCourse($this->course)
                     ->byTrack($this->track)
                     ->orderBy('year_level')
                     ->orderBy('trimester')
                     ->orderBy('sort_order')
                     ->get();
    }

    /**
     * Get subjects grouped by year and trimester
     */
    public function getSubjectsByYearAndTrimester()
    {
        $subjects = $this->getAvailableSubjects();
        $grouped = [];

        foreach ($subjects as $subject) {
            $year = $subject->year_level;
            $trimester = $subject->trimester;
            
            if (!isset($grouped[$year])) {
                $grouped[$year] = [];
            }
            if (!isset($grouped[$year][$trimester])) {
                $grouped[$year][$trimester] = [];
            }
            
            // Get grade for this subject if exists
            $grade = $subject->gradeForStudent($this->id);
            $subject->grade_info = $grade;
            
            $grouped[$year][$trimester][] = $subject;
        }

        return $grouped;
    }

    /**
     * Get current year level and trimester
     */
    public function getCurrentYearAndTrimester()
    {
        // This is a simple implementation - you might want to make this more sophisticated
        // For now, let's assume 3rd year, 3rd trimester as shown in the original view
        return [
            'year' => 3,
            'trimester' => 3
        ];
    }
}
