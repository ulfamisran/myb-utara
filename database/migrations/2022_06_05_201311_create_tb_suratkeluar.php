<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSuratkeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_suratkeluar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomorsurat');   
            $table->string('idpermohonan', 20);
            $table->string('pemohon', 100);
            $table->string('surat', 100);
            $table->date('tanggalpengesahan');

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
        Schema::dropIfExists('tb_suratkeluar');
    }
}
