<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $table = "tps";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'kecamatan_id',
        'kelurahan_id',
        'nama_tps',
        'lat',
        'lon',
        'desc',
        'slug',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
