<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->uuid();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('job');
            $table->string('password');
            $table->uuid();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('organisation_tests', function (Blueprint $table) {
            $table->integer('organisation_id');
            $table->enum('test_identifier', ['enneagram', 'working_genius', 'myers_briggs']);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('name');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('test_results', function (Blueprint $table) {
            $table->integer('user_id');
            $table->enum('test_identifier', ['enneagram', 'working_genius', 'myers_briggs']);
            $table->json('result');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->integer('team_id');
            $table->integer('user_id');
        });   

    }

};
