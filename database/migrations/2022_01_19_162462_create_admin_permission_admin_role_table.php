<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionAdminRoleTable extends Migration
{
    public function up()
    {
        Schema::create('admin_permission_admin_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_permission_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_permission_admin_role');
    }
}
