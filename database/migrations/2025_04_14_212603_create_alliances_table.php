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
        Schema::create('alliances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('index');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('img_url');
            $table->boolean('active');
            $table->string('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alliances');
    }
};
