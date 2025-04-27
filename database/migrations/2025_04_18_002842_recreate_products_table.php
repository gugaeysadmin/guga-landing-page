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
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable(); 
            $table->text('description')->nullable();
            $table->boolean('has_table');
            $table->json('product_services')->nullable();
            $table->json('optional1')->nullable();
            $table->json('optional2')->nullable();
            $table->json('optional3')->nullable();
            $table->json('table_data')->nullable();

            $table->boolean('has_accesrorypdf')->nullable();
            $table->integer('pdf_page')->nullable();
            $table->boolean('has_services')->nullable();
            $table->text('services_description')->nullable();

            $table->unsignedBigInteger('accesorypdf_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();

            $table->foreign('accesorypdf_id')
                  ->references('id')
                  ->on('accesory_pdfs')
                  ->onDelete('cascade');

            $table->foreign('brand_id')
                  ->references('id')
                  ->on('brands')
                  ->onDelete('cascade');
            
            $table->foreign('table_id')
                  ->references('id')
                  ->on('product_table_configurations')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        
    }
};
