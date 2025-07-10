<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('cell_occupations', function (Blueprint $table) {
            $table->id();
            $table->string('wing', 1)->nullable()->default(null); // A, B or C
            $table->string('cell_number', 4)->nullable()->default(null); // e.g. A100, B200, C363
            $table->unsignedBigInteger('prisoner_id')->nullable();
            $table->foreign('prisoner_id')->references('id')->on('prisoners')->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->unique(['wing', 'cell_number', 'end_time']); // Prevent double bookings
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cell_occupations');
        Schema::dropIfExists('prisoners');
    }
};