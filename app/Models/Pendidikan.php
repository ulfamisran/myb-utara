<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = "tb_pendidikan";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'pendidikan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
