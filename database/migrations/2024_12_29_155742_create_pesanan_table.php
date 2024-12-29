<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan'); // id_pesanan sebagai primary key
            $table->string('email'); // email pelanggan
            $table->string('bahan_material'); // bahan material yang dipilih
            $table->string('frame'); // jenis frame yang dipilih
            $table->integer('panjang'); // panjang box
            $table->integer('lebar'); // lebar box
            $table->integer('tinggi'); // tinggi box
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
