<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengesahan extends Model
{
    use HasFactory;
    protected $table = "tb_pengesahan";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'pengesahan',
        'nama',
        'ttd',
        'createat',
        'updateat'
    );
    public $timestamps = false;
}
