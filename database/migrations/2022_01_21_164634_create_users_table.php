<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('new_email')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('gender', ['r', 'n']);
            $table->string('pob', 50)->nullable();
            $table->date('dob')->nullable();
            $table->string('impression', 255)->nullable();
            $table->string('message', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->index('name');
            $table->index('username');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
