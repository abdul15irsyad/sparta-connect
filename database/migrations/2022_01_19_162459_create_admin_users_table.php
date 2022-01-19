<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('new_email')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('admin_role_id')->constrained('admin_roles');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->index('name');
            $table->index('username');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
