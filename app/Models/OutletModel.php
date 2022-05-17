<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletModel extends Model
{
    use HasFactory;
    protected $table = 'master_outlet';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'marketingID', 'name', 'address', 'phone', 'isFaskes', 'status', 'createdAt',
    ];
}