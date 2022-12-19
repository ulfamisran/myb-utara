<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSuratmasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_suratmasuk', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggalmasuk');   
            $table->string('pengirim', 100);
            $table->string('perihal', 100);
            $table->string('filesurat', 100);
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
        Schema::dropIfExists('tb_suratmasuk');
    }
}
