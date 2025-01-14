<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('struk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('lokasi');
            $table->string('material_name');
            $table->string('frame_name');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('tinggi');
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struk');
    }
};
