<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTesModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'idTransaction',
        'idPasien',
        'pemeriksaan',
        'spesimen',
        'hasil',
        'keterangan',
        'nameTargetGen',
        'gen0',
        'gen1',
        'gen2',
        'gen3',
        'gen4',
        'gen5',
        'createdAt'
    ];
    
    // Set table name in the database that this model use
    protected $table = "master_hasil_tes";
}
