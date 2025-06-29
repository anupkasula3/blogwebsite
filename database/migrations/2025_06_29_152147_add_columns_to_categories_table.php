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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('color', 20)->nullable()->after('is_active');
            $table->boolean('is_featured')->default(false)->after('color');
            $table->boolean('show_in_menu')->default(true)->after('is_featured');
            $table->string('meta_title')->nullable()->after('show_in_menu');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->string('icon')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'color',
                'is_featured',
                'show_in_menu',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'icon',
            ]);
        });
    }
};
