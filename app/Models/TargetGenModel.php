<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetGenModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'nameTargetGen',
        'status',
    ];

    // Set table name in the database that this model use
    protected $table = "master_target_gen";
}