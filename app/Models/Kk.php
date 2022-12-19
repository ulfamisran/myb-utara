<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kk extends Model
{
    use HasFactory;
    protected $table = "tb_kk";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nokk',
        'nik_kk',
        'id_kk',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
