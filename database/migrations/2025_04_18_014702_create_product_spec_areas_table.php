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
        Schema::create('product_spec_areas', function (Blueprint $table) {
            $table->id();
            $table->integer('priority');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('spec_area_id');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
            
            $table->foreign('spec_area_id')
                  ->references('id')
                  ->on('speciality_areas')
                  ->onDelete('cascade');

            $table->unique(['product_id','spec_area_id']);

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_spec_areas');
    }
};
