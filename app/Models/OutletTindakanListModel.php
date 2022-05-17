<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletTindakanListModel extends Model
{
    use HasFactory;
    protected $table = 'outlet_tindakan_list';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'outletID', 'outletTindakan', 'price', 'isVisibleToPasien', 'status'
    ];
}