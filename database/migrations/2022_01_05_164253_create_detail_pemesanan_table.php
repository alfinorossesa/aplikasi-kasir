<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesanan');
            $table->unsignedBigInteger('id_dataKategoriMenu');
            $table->unsignedBigInteger('id_dataMenu');
            $table->integer('jumlah');
            $table->integer('sub_total');
            $table->timestamps();
            
            $table->foreign('id_pemesanan')->references('id')->on('pemesanan')->onDelete('cascade');
            $table->foreign('id_dataKategoriMenu')->references('id')->on('data_kategori_menu')->onDelete('cascade');
            $table->foreign('id_dataMenu')->references('id')->on('data_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemesanan');
    }
}
