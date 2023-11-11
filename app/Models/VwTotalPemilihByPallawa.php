<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwTotalPemilihByPallawa extends Model
{
    use HasFactory;
    protected $table = "vwtotalpemilihbypallawa";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id_pallawa',
        'nama_pallawa',
        'jumlah_pemilih',
        'jumlah_patappa',
        'jumlah_tps',
    );
    public $timestamps = false;
}
