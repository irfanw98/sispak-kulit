<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dokter', function (Blueprint $table) {
            $table->bigIncrements('id')->length(20)->unsigned();
            $table->string('kd_dokter', 20)->unique();
            $table->string('nama', 255);
            $table->integer('nip')->length(10)->unique();
            $table->string('foto', 255);
            $table->string('email')->unique();
            $table->string('username', 100);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dokter');
    }
}
