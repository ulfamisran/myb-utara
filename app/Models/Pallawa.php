<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pallawa extends Model
{
    use HasFactory;
    protected $table = "pallawas";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nik',
        'nama',
        'jk',
        'tps_id',
        'user_id',
        'no_telp',
        'lat',
        'lon',
        'lokasi_name',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
