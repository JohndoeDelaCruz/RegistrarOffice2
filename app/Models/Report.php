<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'type_color',
        'format',
        'status',
        'file_name',
        'file_path',
        'file_size',
        'parameters',
        'data',
        'created_by'
    ];

    protected $casts = [
        'parameters' => 'array',
        'data' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
