<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('penyewa_id')->unsigned()->nullable();
            $table->foreign('penyewa_id')->references('id')->on('penyewas')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('lokasi_id')->unsigned()->nullable();
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('nomor');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('tenants');
    }
}
