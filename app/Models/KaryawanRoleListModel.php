<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanRoleListModel extends Model
{
    use HasFactory;
    protected $table = 'karyawan_role_list';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'karyawanID', 'rolesID', 'status'
    ];
}