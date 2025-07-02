<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add user_id to profiles table
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained();
        });

        // Remove profile_id from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
        });
    }

    public function down(): void
    {
        // Revert changes
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('profile_id')->nullable()->constrained('profiles');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
