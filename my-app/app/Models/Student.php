<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Mass-assignable fields.
     * Without $fillable, $model->fill() / Student::create() would throw a
     * MassAssignmentException. Listing fields here tells Laravel we trust them.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
    ];
}
