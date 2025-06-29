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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'user_post', 'post_approved', 'post_rejected', 'post_published', etc.
            $table->string('title');
            $table->text('message');
            $table->text('data')->nullable(); // JSON data for additional info
            $table->string('recipient_type'); // 'admin', 'user'
            $table->unsignedBigInteger('recipient_id'); // admin_id or user_id
            $table->string('sender_type')->nullable(); // 'admin', 'user'
            $table->unsignedBigInteger('sender_id')->nullable(); // admin_id or user_id
            $table->string('action_url')->nullable(); // URL to redirect when clicked
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['recipient_type', 'recipient_id']);
            $table->index(['is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
