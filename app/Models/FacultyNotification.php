<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'application_id',
        'type',
        'message',
        'is_read',
        'read_at',
        'deadline_date',
        'days_until_deadline',
        'email_sent',
        'email_sent_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'email_sent' => 'boolean',
        'read_at' => 'datetime',
        'email_sent_at' => 'datetime',
        'deadline_date' => 'date'
    ];

    // Relationships
    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    public function application()
    {
        return $this->belongsTo(GradeCompletionApplication::class, 'application_id');
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeDeadlineWarnings($query)
    {
        return $query->where('type', 'deadline_warning');
    }

    public function scopeOverdue($query)
    {
        return $query->where('type', 'overdue');
    }

    // Helper methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function getUrgencyLevel()
    {
        return match($this->type) {
            'overdue' => 'high',
            'deadline_warning' => $this->days_until_deadline <= 3 ? 'high' : 'medium',
            'completion_required' => 'medium',
            default => 'low'
        };
    }

    public function getIconClass()
    {
        return match($this->type) {
            'deadline_warning' => 'fas fa-clock text-yellow-500',
            'overdue' => 'fas fa-exclamation-triangle text-red-500',
            'completion_required' => 'fas fa-bell text-blue-500',
            default => 'fas fa-info-circle text-gray-500'
        };
    }

    public function getBadgeClass()
    {
        return match($this->getUrgencyLevel()) {
            'high' => 'bg-red-100 text-red-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
