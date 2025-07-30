<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeanNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'dean_id',
        'application_id',
        'sent_by',
        'admin_reminder_id',
        'type',
        'message',
        'is_read',
        'read_at',
        'metadata'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'metadata' => 'array'
    ];

    // Relationships
    public function dean()
    {
        return $this->belongsTo(User::class, 'dean_id');
    }

    public function application()
    {
        return $this->belongsTo(GradeCompletionApplication::class, 'application_id');
    }

    public function sentBy()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    public function adminReminder()
    {
        return $this->belongsTo(ApplicationReminder::class, 'admin_reminder_id');
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeAdminReminders($query)
    {
        return $query->where('type', 'admin_reminder');
    }

    public function scopeDeadlineWarnings($query)
    {
        return $query->where('type', 'deadline_warning');
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
        $metadata = $this->metadata ?? [];
        
        return match($this->type) {
            'overdue' => 'high',
            'admin_reminder' => $metadata['urgency'] ?? 'medium',
            'deadline_warning' => 'medium',
            'follow_up' => 'high',
            default => 'low'
        };
    }

    public function getIconClass()
    {
        return match($this->type) {
            'admin_reminder' => 'fas fa-user-shield text-blue-500',
            'deadline_warning' => 'fas fa-clock text-yellow-500',
            'overdue' => 'fas fa-exclamation-triangle text-red-500',
            'follow_up' => 'fas fa-bell text-orange-500',
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

    public function getTypeLabel()
    {
        return match($this->type) {
            'admin_reminder' => 'Admin Reminder',
            'deadline_warning' => 'Deadline Warning',
            'overdue' => 'Overdue Notice',
            'follow_up' => 'Follow Up',
            default => 'Notification'
        };
    }
}
