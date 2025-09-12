<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ad_placements', function (Blueprint $table) {
            $table->unsignedInteger('default_display_count')->nullable()->after('is_auto');
            $table->string('default_gap', 32)->nullable()->after('default_display_count');
        });
    }

    public function down(): void
    {
        Schema::table('ad_placements', function (Blueprint $table) {
            $table->dropColumn(['default_display_count', 'default_gap']);
        });
    }
};
