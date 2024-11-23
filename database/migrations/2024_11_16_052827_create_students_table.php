<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();                      // Primary key (auto-increment)
            $table->string('name');            // Name of the student
            $table->integer('age');            // Age of the student
            $table->unsignedBigInteger('class_id');
            $table->string('class_name');        // Foreign key to class
            $table->unsignedBigInteger('section_id');
            $table->string('section_name');      // Foreign key to section
            $table->timestamps();              // Created at & Updated at timestamps
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
