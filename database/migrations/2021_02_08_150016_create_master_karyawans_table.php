<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->nullable();
            $table->string('nama_lengkap', 50)->nullable();
            $table->string('nama_panggilan', 20)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nomor_ktp', 18)->nullable();
            $table->string('status_ktp', 20)->nullable();
            $table->string('foto', 30)->nullable();
            $table->integer('cabang_id')->nullable();
            $table->integer('jabatan_id')->nullable();
            $table->string('jenis_kelamin', 1)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat_asal')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->text('alasan')->nullable();
            $table->date('tanggal_pengambilan_ijazah')->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('master_karyawans');
    }
}
