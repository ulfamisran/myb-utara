<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKk extends Model
{
    use HasFactory;
    protected $table = "tb_detail_kk";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'idkk',
        'nokk',
        'status',
        'nik_penduduk',
        'id_penduduk',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
