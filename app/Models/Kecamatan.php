<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = "kecamatans";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nama_kecamatan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
