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
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'student'])->default('student');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}