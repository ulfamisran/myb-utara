<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKtp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ktp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nonik', 16);
            $table->string('namalengkap', 100);
            $table->string('alamat', 100);
            $table->string('agama', 50);
            $table->string('jeniskelamin', 50);
            $table->string('ttl', 100);
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
        Schema::dropIfExists('tb_ktp');
    }
}
