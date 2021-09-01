<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAturanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aturan', function (Blueprint $table) {
            $table->id();
            $table->string('penyakit_kode', 8);
            $table->string('gejala_kode', 8);
            $table->timestamps();

            $table->foreign('penyakit_kode')->references('kode_penyakit')->on('tb_penyakit')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('gejala_kode')->references('kode_gejala')->on('tb_gejala')->onDelete('restrict')->onUpdate('restrict');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aturan');
    }
}
