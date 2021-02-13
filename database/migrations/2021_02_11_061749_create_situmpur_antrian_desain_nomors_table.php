<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitumpurAntrianDesainNomorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situmpur_antrian_desain_nomors', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_antrian')->nullable();
            $table->string('nama_customer', 30)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->integer('customer_filter_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('situmpur_antrian_desain_nomors');
    }
}
