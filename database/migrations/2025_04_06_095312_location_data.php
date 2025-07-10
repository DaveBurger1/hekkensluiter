<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prisoners', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->timestamps();
        });
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('city');
            $table->integer('cell_amount');
            $table->timestamps();
        });
        Schema::create('location_user', function (Blueprint $table) {
            $table->foreignId('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
        Schema::dropIfExists('location_user');
    }
};