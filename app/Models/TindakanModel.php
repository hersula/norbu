<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanModel extends Model
{
    use HasFactory;
    protected $table = "master_tindakan";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'price',
        'typeTindakan',
        'spesimen',
        'status',
    ];
}