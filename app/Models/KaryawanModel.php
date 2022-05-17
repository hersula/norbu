<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanModel extends Model
{
    use HasFactory;
    protected $table = "master_karyawan";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'outletID',
        'name',
        'email',
        'phone',
        'password',
        'status',
        'createdAt'
    ];
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'karyawan_role_list');
    }
}