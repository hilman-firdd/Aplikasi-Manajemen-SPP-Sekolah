<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tagihan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->double('jumlah');
            $table->boolean('wajib_semua')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_tagihan');
    }
}
