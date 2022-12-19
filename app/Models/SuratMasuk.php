<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = "tb_suratmasuk";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'tanggalmasuk',
        'pengirim',
        'perihal',
        'filesurat',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
