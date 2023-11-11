<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilihs extends Model
{
    use HasFactory;
    protected $table = "pemilihs";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nik',
        'nama',
        'jk',
        'tps_id',
        'patappa_id',
        'no_telp',
        'slug',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
