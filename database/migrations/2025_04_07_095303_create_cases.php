<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('case_prisoner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id');
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreignId('prisoner_id');
            $table->foreign('prisoner_id')->references('id')->on('prisoners')->onDelete('cascade');
            $table->string('reason');
            $table->timestamps();
        });
        Schema::table('cell_occupations', function (Blueprint $table) {
            $table->foreignId('case_prisoner_id')->nullable();
            $table->foreign('case_prisoner_id')->references('id')->on('case_prisoner')->nullOnDelete();
        });

        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id');
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidence');
        Schema::table('cell_occupations', function (Blueprint $table) {
            $table->dropForeign(['case_prisoner_id']);
            $table->dropColumn('case_prisoner_id');
        });
        Schema::dropIfExists('case_prisoner');
        Schema::dropIfExists('cases');
    }
};