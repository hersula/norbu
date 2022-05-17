<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $table = 'temp_cart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'nik', 'nikTo', 'outletID', 'tindakanID', 'registerTo', 'gejala', 'deskripsiGejala', 'qty', 'price',
    ];
}