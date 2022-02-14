<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dataKategoriMenu');
            $table->string('kategori');
            $table->string('nama_menu');
            $table->integer('harga');
            $table->string('photo');
            $table->timestamps();

            $table->foreign('id_dataKategoriMenu')->references('id')->on('data_kategori_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_menu');
    }
}
