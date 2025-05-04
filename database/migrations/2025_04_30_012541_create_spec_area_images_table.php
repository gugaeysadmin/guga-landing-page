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
        Schema::create('spec_area_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url',300);
            $table->json('optional1')->nullable();
            $table->json('optional2')->nullable();
            $table->integer('index')->default(0);
            $table->boolean('active');
            $table->unsignedBigInteger('spec_area_id');

            $table->foreign('spec_area_id')
                  ->references('id')
                  ->on('speciality_areas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spec_area_images');
    }
};
