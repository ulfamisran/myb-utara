<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFormatsurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_formatsurat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodenomorsurat', 20);
            $table->string('perihal', 20);
            $table->text('kepalasurat');
            $table->text('isisurat');
            $table->text('kakisurat');
            $table->text('legalitas');            
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
        Schema::dropIfExists('tb_formatsurat');
    }
}
