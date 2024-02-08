<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->string('nomor_unik', 10)->unique();
            $table->string('nama_pelanggan');
            $table->string('fasilitas');
            $table->integer('jumlah_hari'); 
            $table->integer('total_harga'); 
            $table->integer('uang_bayar');
            $table->integer('uang_kembali');
            $table->date('tanggal_checkout');
            $table->date('tanggal_checkin');
            $table->timestamps();
    
            $table->foreign('id_produk')->references('id')->on('products');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
