<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPermohonansurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_permohonansurat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nikpemohon',20);
            $table->string('namapemohon', 100);
            $table->string('jenissurat');
            $table->string('keperluansurat');
            $table->string('statussurat'); // (1)Belum Konfirmasi, (2)Selesai, (3)Ditolak
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
        Schema::dropIfExists('tb_permohonansurat');
    }
}
