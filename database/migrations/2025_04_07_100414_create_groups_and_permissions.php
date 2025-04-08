<?php

use App\Util\Entities;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('key', 30)->unique();
            $table->string('name_future')->unique();
            $table->string('name_past')->unique();
        });
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('action_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->string('change')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name')->unique();
            $table->string('description')->nullable();
            $table->boolean('requires_link');
            $table->timestamps();
        });

        Schema::create('action_group', function (Blueprint $table) {
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('action_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->primary(['group_id', 'action_id']);
            $table->timestamps();
        });
        Schema::create('group_user', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete();
            $table->primary(['user_id', 'group_id']);
            $table->timestamps();
        });

        foreach (Entities::gen_entity_actions() as $action) {
            list($key, $nameFuture, $namePast) = $action;
            DB::table('actions')->insert([
                'key' => $key,
                'name_future' => $nameFuture,
                'name_past' => $namePast,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('group_action');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('action_logs');
        Schema::dropIfExists('actions');
    }
};