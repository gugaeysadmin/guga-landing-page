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
        Schema::create('speciality_areas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',100);
            $table->text('description')->nullable();
            $table->string('icon_file_url',300);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_areas');
    }
};
