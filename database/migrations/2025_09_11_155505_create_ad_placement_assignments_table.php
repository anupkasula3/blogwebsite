<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ad_placement_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ads')->cascadeOnDelete();
            $table->foreignId('ad_placement_id')->constrained('ad_placements')->cascadeOnDelete();
            $table->unsignedInteger('weight')->default(1); // for rotation probability
            $table->unsignedInteger('priority')->default(0); // manual ordering if needed
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['ad_id', 'ad_placement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_placement_assignments');
    }
};
