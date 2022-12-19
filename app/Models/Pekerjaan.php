<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $table = "tb_pekerjaan";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'pekerjaan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
