<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->unsignedBigInteger('id_pelanggan'); // Foreign key
            $table->string('bahan_material');
            $table->string('frame');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('tinggi');
            $table->timestamps();
        
            // Relasi dengan tabel pelanggan
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
