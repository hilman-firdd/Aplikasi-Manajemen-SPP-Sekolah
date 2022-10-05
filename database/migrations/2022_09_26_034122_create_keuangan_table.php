<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_keuangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tabungan_id')->nullable();
            $table->integer('transaksi_id')->nullable();
            $table->enum('tipe', ['in', 'out']);
            $table->double('jumlah');
            $table->double('total_kas');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('t_keuangan');
    }
}
