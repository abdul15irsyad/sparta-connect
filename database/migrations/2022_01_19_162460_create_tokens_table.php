<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->enum('type', ['verification', 'forgot_password']);
            $table->tinyInteger('status')->default(1);
            $table->datetime('used_at')->nullable();
            $table->datetime('expired_at');
            $table->morphs('tokenable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
