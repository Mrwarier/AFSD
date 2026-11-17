<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Mass-assignable fields.
     */
    protected $fillable = [
        'name',
        'description',
        'duration',
        'fee',
        'difficulty',
        'is_active',
    ];

    /**
     * Type-cast columns to PHP types automatically.
     * 'boolean' means MySQL's tinyint(1) is converted to true/false.
     * 'decimal:2' ensures fee is always a string with 2 decimal places when
     * serialised (avoids float rounding issues).
     */
    protected $casts = [
        'is_active' => 'boolean',
        'fee'       => 'decimal:2',
    ];
}
