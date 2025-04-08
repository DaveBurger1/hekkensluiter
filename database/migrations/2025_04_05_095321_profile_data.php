<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('bsn', 9);
            $table->string('address', 50)->nullable();
            $table->string('city', 50)->nullable();

            $table->date('date_of_birth');
            $table->string('place_of_birth');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('profile_id')->unsigned()->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
        });
        Schema::dropIfExists('profiles');
    }
};