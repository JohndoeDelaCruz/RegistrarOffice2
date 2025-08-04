<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeCompletionApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'current_grade',
        'reason',
        'supporting_document',
        'original_filename',
        'status',
        'dean_status',
        'dean_remarks',
        'dean_reviewed_at',
        'dean_reviewed_by',
        'dean_signature',
        'dean_signature_type',
        'dean_signature_date',
        'completion_deadline',
        'faculty_status',
        'final_grade',
        'faculty_processed_at',
        'faculty_processed_by',
        'faculty_remarks',
        'reviewed_at',
        'reviewed_by'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'dean_reviewed_at' => 'datetime',
        'dean_signature_date' => 'datetime',
        'completion_deadline' => 'datetime',
        'faculty_processed_at' => 'datetime'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function deanReviewedBy()
    {
        return $this->belongsTo(User::class, 'dean_reviewed_by');
    }

    public function facultyProcessedBy()
    {
        return $this->belongsTo(User::class, 'faculty_processed_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeDeanPending($query)
    {
        return $query->where('dean_status', 'pending');
    }

    public function scopeDeanApproved($query)
    {
        return $query->where('dean_status', 'approved');
    }

    public function scopeDeanRejected($query)
    {
        return $query->where('dean_status', 'rejected');
    }

    // Deadline utility methods
    public function isDeadlinePassed()
    {
        return $this->completion_deadline && now()->isAfter($this->completion_deadline);
    }

    public function isDeadlineApproaching($days = 30)
    {
        return $this->completion_deadline && 
               now()->addDays($days)->isAfter($this->completion_deadline) &&
               !$this->isDeadlinePassed();
    }

    public function getDaysUntilDeadline()
    {
        if (!$this->completion_deadline) {
            return null;
        }
        
        return floor(now()->diffInDays($this->completion_deadline, false));
    }

    public function getDeadlineStatusAttribute()
    {
        if (!$this->completion_deadline) {
            return 'no_deadline';
        }

        $daysUntil = $this->getDaysUntilDeadline();
        
        if ($daysUntil < 0) {
            return 'overdue';
        } elseif ($daysUntil <= 30) {
            return 'approaching';
        } else {
            return 'active';
        }
    }
}
