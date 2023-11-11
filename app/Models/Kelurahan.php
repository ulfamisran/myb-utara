<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = "kelurahans";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nama_kelurahan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
