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
        Schema::create('billings', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('CCA');
            $table->bigInteger('SND');
            $table->biginteger('SND_GROUP')->nullable();
            $table->string('Nama')->nullable();
            $table->string('NAME')->nullable();
            $table->string('Alamat')->nullable();
            $table->integer('NCLI')->nullable();
            $table->integer('DATMS')->nullable();
            $table->integer('DATRS')->nullable();
            $table->string('CUSTOMER_CATEGORY')->nullable();
            $table->string('NM_CLUSTER')->nullable();
            $table->string('PORTFOLIO')->nullable();
            $table->string('PRODUK')->nullable();
            $table->string('BUNDLING')->nullable();
            $table->string('INDIHOME')->nullable();
            $table->string('JENIS_INDIHOME');
            $table->string('DIVISI')->nullable();
            $table->string('WITEL')->nullable();
            $table->string('DATEL')->nullable();
            $table->string('STO')->nullable();
            $table->string('UBIS')->nullable();
            $table->string('BISNIS_AREA')->nullable();
            $table->string('SEGMEN')->nullable();
            $table->string('SUBSEGMEN')->nullable();
            $table->integer('NPER')->nullable();
            $table->integer('BILL_AMOUNT')->nullable();
            $table->integer('RP_TOTAL_NET')->nullable();
            $table->integer('RP_TOTAL')->nullable();
            $table->string('INSTALL ADDRESS')->nullable();
            $table->string('CUSTOMER NAME')->nullable();
            $table->string('CHANNEL')->nullable();
            $table->string('KCONTACT')->nullable();
            $table->bigInteger('GSM')->nullable();
            $table->string('VOC CALL')->nullable();
            $table->string('VOC VISIT')->nullable();
            $table->string('KETERANGAN')->nullable();
            $table->string('STATUS')->nullable();
            $table->string('Status bayar')->nullable();
            $table->string('CEK')->nullable();
            $table->string('Cek 2 ( Digital Produk)')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
