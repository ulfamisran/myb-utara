<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patappa extends Model
{
    use HasFactory;
    protected $table = "patappas";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nik',
        'nama',
        'jk',
        'tps_id',
        'pallawa_id',
        'user_id',
        'lat',
        'lon',
        'lokasi_name',
        'no_telp',
        'slug',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
