<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $table = "tb_agama";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'agama',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
