<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitungSuratKeluar extends Model
{
    use HasFactory;
    protected $table = "tb_suratkeluar_hitung";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'jumlah_surat'
    );
    public $timestamps = false;
}
