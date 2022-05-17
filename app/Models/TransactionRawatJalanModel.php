<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRawatJalanModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'transaksiID',
        'barcodeLab',
        'sofDeleteBarcode',
        'pasienID',
        'tindakanID',
        'outletID',
        'targetGentID',
        'price',
        'totalDisc',
        'Tax',
        'grandTotal',
        'nikAccount',
        'gejala',
        'deskripsiGejala',
        'tglTindakan',
        'paymenType',
        'paymenURL',
        'billTo',
        'status',
        'createdFrom',
        'deleteFrom',
        'confirmPaymentFrom',
        'confirmGetSample',
        'createdAt',
        'deleteAt',
        'sampleTima',
        'barcodeLabTime',
        'resulTime',
        'isSelfRegister',
    ];

    // Set table name in the database that this model use
    protected $table = "Transaksi_rawat_jalan";
}