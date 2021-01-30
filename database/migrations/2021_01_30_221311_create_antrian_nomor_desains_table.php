<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianNomorDesainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_nomor_desains', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_antrian')->nullable;
            $table->string('nama', 30)->nullable;
            $table->string('telepon', 15)->nullable;
            $table->integer('customer_filter_id')->nullable;
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
        Schema::dropIfExists('antrian_nomor_desains');
    }
}
