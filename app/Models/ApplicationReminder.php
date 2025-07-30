<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'sent_by',
        'sent_to',
        'message',
        'type',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(GradeCompletionApplication::class, 'application_id');
    }

    public function sentBy()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    public function sentTo()
    {
        return $this->belongsTo(User::class, 'sent_to');
    }
}
