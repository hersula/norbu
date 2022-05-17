<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    use HasFactory;
    protected $table = 'master_countries';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =
    [
        'phone_code', 'country_code', 'country_name',
    ];
}