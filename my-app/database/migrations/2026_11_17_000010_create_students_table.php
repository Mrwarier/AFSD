<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the students table with all required columns.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();                              // Auto-increment primary key
            $table->string('name');                    // Student full name
            $table->string('email')->unique();         // Must be unique across all students
            $table->string('phone', 20);               // Phone number (string to allow +44 etc.)
            $table->text('address')->nullable();       // Optional home address
            $table->date('date_of_birth')->nullable(); // Optional date of birth
            $table->timestamps();                      // created_at + updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
