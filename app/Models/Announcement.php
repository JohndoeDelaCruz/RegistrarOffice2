<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'audience',
        'priority',
        'is_published',
        'is_draft',
        'published_at',
        'created_by'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_draft' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Get the dean who created this announcement
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope to get published announcements
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope to get draft announcements
     */
    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    /**
     * Scope to get announcements for a specific audience
     */
    public function scopeForAudience($query, $audience)
    {
        return $query->where(function ($q) use ($audience) {
            $q->where('audience', 'all')
              ->orWhere('audience', $audience);
        });
    }

    /**
     * Scope to get announcements by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get announcements by priority
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Get formatted published date
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('F j, Y \a\t g:i A') : null;
    }

    /**
     * Get priority badge class
     */
    public function getPriorityBadgeClassAttribute()
    {
        switch ($this->priority) {
            case 'urgent':
                return 'bg-red-100 text-red-800';
            case 'high':
                return 'bg-orange-100 text-orange-800';
            default:
                return 'bg-green-100 text-green-800';
        }
    }

    /**
     * Get category badge class
     */
    public function getCategoryBadgeClassAttribute()
    {
        switch ($this->category) {
            case 'academic':
                return 'bg-blue-100 text-blue-800';
            case 'administrative':
                return 'bg-purple-100 text-purple-800';
            case 'urgent':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
}
