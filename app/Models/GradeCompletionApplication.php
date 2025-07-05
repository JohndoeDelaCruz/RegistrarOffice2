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
        'status',
        'dean_status',
        'dean_remarks',
        'dean_reviewed_at',
        'dean_reviewed_by',
        'dean_signature',
        'dean_signature_type',
        'dean_signature_date',
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
}
