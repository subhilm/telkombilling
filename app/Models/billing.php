<?php

namespace App\Models;

use App\Events\BillingUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class billing extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
        'updated' => BillingUpdated::class,
    ];
    protected $fillable = [
        'id',
        'CCA',
        'SND',
        'SND_GROUP',
        'Nama',
        'Alamat',
        'NCLI',
        'DATMS',
        'DATRS',
        'CUSTOMER',
        'NM_CLUSTER',
        'PORTOFOLIO',
        'PRODUK',
        'BUNDLING',
        'INDIHOME',
        'JENIS_INDIHOME',
        'DIVISI',
        'WITEL',
        'DATEL',
        'STO',
        'UBIS',
        'BISNIS_AREA',
        'SEGMEN',
        'SUBSEGMEN',
        'NPER',
        'BILL_AMOUNT',
        'RP_TOTAL_NET',
        'RP_TOTAL',
        'INSTALL ADDRESS',
        'CUSTOMER_NAME',
        'CHANNEL',
        'KCONTACT',
        'GSM',
        'VOC CALL',
        'VOC VISIT',
        'KETERANGAN',
        'STATUS',
        'STATUS_BAYAR',
        'CEK',
        'CEK 2 (Digital Produk)'
    ];
    public $timestamps = true;
}
