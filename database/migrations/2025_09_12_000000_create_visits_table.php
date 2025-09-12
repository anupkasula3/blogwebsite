<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id', 64)->index();
            $table->string('session_id', 100)->nullable()->index();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('ip_address', 45)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->text('landing_page')->nullable();

            $table->string('source', 100)->nullable()->index();
            $table->string('medium', 100)->nullable()->index();
            $table->string('campaign', 150)->nullable()->index();
            $table->string('term', 150)->nullable();
            $table->string('content', 150)->nullable();
            $table->string('gclid', 200)->nullable()->index();

            $table->boolean('is_paid')->default(false)->index();
            $table->string('channel', 50)->nullable()->index();

            $table->timestamps();

            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
