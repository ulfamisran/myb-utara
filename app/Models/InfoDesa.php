<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoDesa extends Model
{
    use HasFactory;
    protected $table = "tb_infodesa";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'namadesa',
        'kecamatan',
        'kabupaten',
        'kodepos',
        'logodesa',
        'alamat',
        'notelp',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
