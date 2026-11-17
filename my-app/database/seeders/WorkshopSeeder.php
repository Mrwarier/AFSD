<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;

class WorkshopSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Students
        Student::create([
            'name'          => 'Alice Johnson',
            'email'         => 'alice@example.com',
            'phone'         => '07700 900001',
            'address'       => '12 Maple Street, Birmingham, B1 1AA',
            'date_of_birth' => '2000-03-15',
        ]);
        Student::create([
            'name'          => 'Bob Smith',
            'email'         => 'bob@example.com',
            'phone'         => '07700 900002',
            'address'       => '45 Oak Avenue, Coventry, CV1 2BB',
            'date_of_birth' => '1998-07-22',
        ]);
        Student::create([
            'name'          => 'Carol Patel',
            'email'         => 'carol@example.com',
            'phone'         => '07700 900003',
            'address'       => null,
            'date_of_birth' => null,
        ]);

        // Sample Courses
        Course::create([
            'name'        => 'Introduction to Web Development',
            'description' => 'Learn HTML, CSS and JavaScript from scratch.',
            'duration'    => 8,
            'fee'         => 499.99,
            'difficulty'  => 'Easy',
            'is_active'   => true,
        ]);
        Course::create([
            'name'        => 'Laravel for Beginners',
            'description' => 'Build full-stack PHP applications with the Laravel framework.',
            'duration'    => 12,
            'fee'         => 799.00,
            'difficulty'  => 'Medium',
            'is_active'   => true,
        ]);
        Course::create([
            'name'        => 'Advanced Database Design',
            'description' => 'Deep dive into relational modelling, indexing and query optimisation.',
            'duration'    => 6,
            'fee'         => 649.50,
            'difficulty'  => 'Hard',
            'is_active'   => false,
        ]);
    }
}
