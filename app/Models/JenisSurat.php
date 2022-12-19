<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = "tb_jenissurat";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'jenissurat',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
