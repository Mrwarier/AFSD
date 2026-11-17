<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the courses table with all required columns.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');                                        // Course title
            $table->text('description');                                   // Full description
            $table->unsignedInteger('duration');                           // Length in weeks
            $table->decimal('fee', 8, 2);                                  // Price, e.g. 1999.99
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard']);        // Difficulty tier
            $table->boolean('is_active')->default(true);                   // Active/inactive toggle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
