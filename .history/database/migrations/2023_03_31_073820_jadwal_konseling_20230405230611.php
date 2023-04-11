<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalKonseling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("jadwal_konseling", function(Blueprint $table){
            $table->id("id_jk");
            $table->unsignedInteger("id_konselor");
            $table->string("keterangan");
            $table->integer("minggu");
            $table->integer("bulan");
            $table->integer("tahun");
            $table->enum("status", ["Selesai","Berjalan"]);

            $table->foreign("id_konselor")->references("id")->on("users");
        });

        Schema::create("detail_jk", function(Blueprint $table){
            $table->id("id_djk");
            $table->unsignedBigInteger("id_jk");
            $table->integer("hari");
            $table->integer("pertemuan_ke");
            $table->time("dari");
            $table->time("sampai");
            $table->time("r_dari")->nullable();
            $table->time("r_sampai")->nullable();
            $table->string("keterangan_reschedule")->nullable();
            $table->dateTime("tanggal", $precision=0);
            $table->foreign("id_jk")->references("id_jk")->on("jadwal_konseling");
        });

        Schema::create("billing_konseling", function(Blueprint $table){
            $table->id("id_bk");
            $table->unsignedBigInteger("id_djk");
            $table->string("nis_siswa");
            $table->string("keterangan_siswa");
            $table->string("catatan_konselor")->nullable();
            $table->string("tempat")->nullable();
            $table->string("pdg")->nullable();
            $table->enum("status", ["Dipesan", "Selesai", "Reschedule"]);
            $table->timestamps();

            $table->foreign("id_djk")->references("id_djk")->on("detail_jk");
            $table->foreign("nis_siswa")->references("nis")->on("siswa");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
