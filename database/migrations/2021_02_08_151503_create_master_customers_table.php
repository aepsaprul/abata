<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer', 30)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_ktp', 18)->nullable();
            $table->date('tanggal_lahir');
            $table->string('segmen', 30)->nullable();
            $table->integer('member')->nullable();
            $table->string('jenis', 20)->nullable();
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
        Schema::dropIfExists('master_customers');
    }
}
