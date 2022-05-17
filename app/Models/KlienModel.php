<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlienModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'typeClientID',
        'nameClient',
        'address',
        'phone',
        'status',
    ];
    
    // Set table name in the database that this model use
    protected $table = "master_client";
}
