<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwPemilihDetail extends Model
{
    use HasFactory;
    protected $table = "vwpemilihdetail";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id_pallawa',
        'pallawa',
        'id_patappa',
        'patappa',
        'nik',
        'nama',
        'jk',
        'id_kecamatan',
        'kecamatan',
        'id_kelurahan',
        'kelurahan',
        'id_tps',
        'tps',
        'lat',
        'lon',
    );
    public $timestamps = false;
}
