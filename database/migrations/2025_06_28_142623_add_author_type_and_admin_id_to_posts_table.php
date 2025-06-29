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
        Schema::table('posts', function (Blueprint $table) {
            $table->enum('author_type', ['user', 'admin'])->default('user')->after('user_id');
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('cascade')->after('author_type');

            // Make user_id nullable since posts can now be created by admins
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['author_type', 'admin_id']);
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
};
