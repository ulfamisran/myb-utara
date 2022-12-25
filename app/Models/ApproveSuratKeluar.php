<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveSuratKeluar extends Model
{
    use HasFactory;
    protected $table = "tb_approve_surat_keluar";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'id_surat_keluar',
        'no_surat_keluar',
        'bulan',
        'tahun',
        'tgl_approve',
    );
    public $timestamps = false;
}
