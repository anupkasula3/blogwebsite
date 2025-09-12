<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ad_placements', function (Blueprint $table) {
            $table->uuid('embed_token')->nullable()->unique()->after('default_gap');
        });
    }

    public function down(): void
    {
        Schema::table('ad_placements', function (Blueprint $table) {
            $table->dropUnique(['embed_token']);
            $table->dropColumn('embed_token');
        });
    }
};


