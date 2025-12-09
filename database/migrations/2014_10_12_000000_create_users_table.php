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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('Id')->autoIncrement();
            $table->string('Username')->unique();
            $table->string('Password');
            $table->enum('Role', ['admin', 'dosen', 'mahasiswa']);
            $table->integer('IdAdmin')->nullable();
            $table->integer('IdDosen')->nullable();
            $table->integer('IdMahasiswa')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
