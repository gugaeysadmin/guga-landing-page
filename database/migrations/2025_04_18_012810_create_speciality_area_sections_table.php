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
        Schema::create('speciality_area_sections', function (Blueprint $table) {
            $table->id();
            $table->string("name",300);
            $table->unsignedBigInteger('speciality_area_id');

            $table->foreign('speciality_area_id')
                  ->references('id')
                  ->on('speciality_areas')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_area_sections');
    }
};
