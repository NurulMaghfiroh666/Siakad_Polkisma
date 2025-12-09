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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->integer('IdJadwal')->autoIncrement();
            $table->integer('IdDosen');
            $table->string('KodeMK');
            $table->string('Hari');
            $table->string('Jam');
            $table->string('Kelas')->nullable();
            $table->string('Ruang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};
