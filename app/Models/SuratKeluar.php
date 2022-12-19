<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $table = "tb_suratkeluar";
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
        'kakisurat',
        'file',
        'approve',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
