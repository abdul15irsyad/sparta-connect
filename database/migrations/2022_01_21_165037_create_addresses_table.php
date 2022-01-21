<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('label', 255)->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('province_id', 10);
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->string('regency_id', 10);
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->string('district_id', 10);
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->string('detail', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
