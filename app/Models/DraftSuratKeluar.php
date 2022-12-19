<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftSuratKeluar extends Model
{
    use HasFactory;
    protected $table = "tb_draftsuratkeluar";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nomorsurat',
        'idpermohonan',
        'perihal',
        'nokk',
        'nonik', 
        'idformatsurat',
        'isisurat',
        'file',
        'tanggalpengesahan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
