<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienModel extends Model
{

    use HasFactory;
    protected $table = 'master_pasien';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'nik', 'name', 'email', 'phone', 'address', 'gender', 'placeOfBirth', 'dateOfBirth', 'password',
        'avatar', 'token', 'status', 'passport', 'country', 'isWNA', 'isSelfRegister', 'isEmailVerified', 'createdAt'
    ];
}