<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = "tb_penduduk";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nonik',
        'namalengkap',
        'alamat',
        'agama',
        'jeniskelamin',
        'tempatlahir',
        'tanggallahir',
        'pekerjaan',
        'pendidikan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
