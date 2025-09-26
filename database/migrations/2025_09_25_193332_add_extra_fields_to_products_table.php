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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('valid')->default(false);
            $table->boolean('is_catalog')->default(false)->after('valid');
            $table->string('catalogpdf', 2000)->nullable()->after('is_catalog');
            $table->boolean('has_manual')->default(false)->after('catalogpdf');
            $table->string('manualpdf', 2000)->nullable()->after('has_manual');
            $table->boolean('has_supply')->default(false)->after('manualpdf');
            $table->string('supplypdf', 2000)->nullable()->after('has_supply');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
        if (Schema::hasColumn('products', 'valid')) {
            $table->dropColumn('valid');
        }
        if (Schema::hasColumn('products', 'is_catalog')) {
            $table->dropColumn('is_catalog');
        }
        if (Schema::hasColumn('products', 'catalogpdf')) {
            $table->dropColumn('catalogpdf');
        }
        if (Schema::hasColumn('products', 'has_manual')) {
            $table->dropColumn('has_manual');
        }
        if (Schema::hasColumn('products', 'manualpdf')) {
            $table->dropColumn('manualpdf');
        }
        if (Schema::hasColumn('products', 'has_supply')) {
            $table->dropColumn('has_supply');
        }
        if (Schema::hasColumn('products', 'supplypdf')) {
            $table->dropColumn('supplypdf');
        }
    });
    }
};
