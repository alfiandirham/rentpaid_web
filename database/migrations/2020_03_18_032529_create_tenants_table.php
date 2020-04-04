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
            $table->bigInteger('lokasi_id');
            $table->string('kategori',7);
            $table->integer('nomor');
            $table->float('harga');
            $table->boolean('status')->default(true);
            $table->foreign('penyewa_id')->references('id')->on('penyewas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade')->onUpdate('cascade');
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
