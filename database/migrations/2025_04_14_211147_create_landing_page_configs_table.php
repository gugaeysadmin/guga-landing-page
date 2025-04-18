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
        Schema::create('landing_page_configs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('mission')->nullable();
            $table->text('vission')->nullable();
            $table->text('values')->nullable();
            $table->text('services_description')->nullable();
            $table->text('main_description')->nullable();
            $table->string('main_video_url',300)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('contact_phone_alternative', 20)->nullable();
            $table->string('contact_email', 50)->nullable();
            $table->text('address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_page_configs');
    }
};
