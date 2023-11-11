<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwTotalPemilihByPatappa extends Model
{
    use HasFactory;
    protected $table = "vwtotalpemilihbypatappa";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id_pallawa',
        'nama_pallawa',
        'id_patappa',
        'nama_patappa',
        'jumlah_pemilih',
        'jumlah_tps'
    );
    public $timestamps = false;
}
