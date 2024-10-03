<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Akun', function (Blueprint $table) {
            $table->id('id_akun');
            $table->timestamps();
            $table->String('username');
            $table->LongText('level');
            $table->String('password');
        });

        Schema::create('Karyawan', function(Blueprint $table){
            $table->id('id_karyawan');
            $table->string('nama_karyawan', 50);
            $table->text('alamat');
            $table->int('gaji');
            $table->date('tanggalmasuk');
            $table->string('shiftkerja', 30);
            $table->int('nomortelepon', 13);
            $table->date('tanggallahir');
            $table->string('posisi', 10);
            $table->timestamps();
        });

        Schema::create('Produk', function(Blueprint $table){
            $table->id('id_produk');
            $table->string('nama_produk', 50);
            $table->text('alamat');
            $table->int('gaji');
            $table->date('tanggalmasukproduk');
            $table->string('shiftkerja', 30);
            $table->int('nomortelepon', 13);
            $table->date('tanggallahir');
            $table->string('posisi', 10);
            $table->foreignId('id_karyawan')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('Admin', function(Blueprint $table){
            $table->id('id_admin');
            $table->string('nama_admin', 50);
            $table->text('alamat');
            $table->int('nomortelepon', 13);
            $table->timestamps();
        });
        
        Schema::create('Transaksi', function(Blueprint $table){
            $table->id('id_transaksi');
            $table->string('metodepembayaran', 20);
            $table->date('tanggaltransaksi');
            $table->int('totalharga');
            $table->text('keterangan');
            $table->foreignId('id_karyawan')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('DetailTransaksi', function(Blueprint $table){
            $table->id('id_detail_transaksi');
            $table->int('hargasatuan');
            $table->int('jumlah');
            $table->foreignId('id_produk')->constrained()->onDelete('cascade');
            $table->foreignId('id_transaksi')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('Pelaporan', function(Blueprint $table){
            $table->id('id_pelaporan');
            $table->int('hargasatuan');
            $table->date('tanggalpelaporan');
            $table->date('tanggalmulai');
            $table->date('tanggalakhir');
            $table->foreignId('id_admin')->constrained()->onDelete('cascade');
            $table->foreignId('id_transaksi')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Akun');
        Schema::dropIfExists('Karyawan');
        Schema::dropIfExists('Produk');
        Schema::dropIfExists('Admin');
        Schema::dropIfExists('Transaksi');
        Schema::dropIfExists('DetailTransaksi');
        Schema::dropIfExists('Pelaporan');
    }
};
