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
        Schema::create('table_class_item', function (Blueprint $table) {
            $table->bigIncrements('class_id'); // Auto-incrementing primary key
            $table->string('class_name'); // Class name (e.g., class_A)
 // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_class_item');
    }
};
