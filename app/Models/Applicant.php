<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'education',
        'birth_date',
        'city',
        'position_applied',
        'current_position',
        'current_salary',
        'experience',
        'etimad_knowledge',
        'cv_path',
        'portfolio_path',
        'status',
        'is_read',
        'is_qualified',
    ];

    protected $casts = [
        'birth_date'       => 'date',
        'etimad_knowledge' => 'boolean',
        'is_read'          => 'boolean',
        'is_qualified'     => 'boolean',
    ];
}
