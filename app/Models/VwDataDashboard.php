<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwDataDashboard extends Model
{
    use HasFactory;
    protected $table = "vw_datadashboard";
    protected $primaryKey = "";
    protected $fillable = array(
        'total_kk',
        'total_penduduk',
        'total_format_surat',
        'total_surat_masuk',
        'total_surat_keluar',
        'total_permohonan_surat'
    );
    public $timestamps = false;
}
