<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'faculty_id',
        'department',
        'position',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'office_location',
        'specialization',
        'education_level',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
