<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwTps extends Model
{
    use HasFactory;
    protected $table = "vwtps";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id_kecamatan',
        'kecamatan',
        'id_kelurahan',
        'kelurahan',
        'id_tps',
        'tps',
        'lon',
        'lat',
        'jumlah_pemilih',
        'jumlah_patappa',
    );
    public $timestamps = false;
}
