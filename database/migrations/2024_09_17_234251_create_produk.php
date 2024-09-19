<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            /* Primary key of the table */
            $table->increments('id'); // Primary key
            
            /* Nama produk */
            $table->string('nama');
            
            /* Tanggal produk ditambahkan */
            $table->dateTime('date');
            
            /* Jumlah produk */
            $table->float('Jumlah');
            
            /* Harga produk */
            $table->float('harga');
            
            /* Gambar produk, jika ada */
            $table->json('images')->nullable();
            
            /* Foreign key to the users table */
            $table->unsignedBigInteger('id_user'); // Menggunakan unsignedBigInteger untuk foreign key
            
            /* Timestamp created at */
            $table->timestamps(); // Otomatis menambah kolom created_at dan updated_at

            /* Foreign key constraint */
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Remove the posts table if it exists */
        Schema::dropIfExists('posts');
    }
}
