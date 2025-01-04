<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("produk_id");
            $table->string("customer");
            $table->date("tanggal");
            $table->datetime("jam_mulai");
            $table->integer("qty");
            $table->integer("harga_perjam");
            $table->integer("diskon");
            $table->integer("harga_sebelum_diskon");
            $table->integer("harga_setelah_diskon");
            $table->enum("payment",['sudah','belum'])->default('belum');
            $table->integer("bayar")->nullable();
            $table->integer("kembalian")->nullable();
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
        Schema::dropIfExists('rents');
    }
}
