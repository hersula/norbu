<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePembayaranModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'namePayment',
        'status'
    ];
    
    // Set table name in the database that this model use
    protected $table = "master_payment";
}
