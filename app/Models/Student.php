<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Computed age from date_of_birth.
     */
    protected function age(): Attribute
    {
        return Attribute::get(
            fn () => $this->date_of_birth
                ? $this->date_of_birth->age
                : null
        );
    }
}
