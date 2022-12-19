<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatSurat extends Model
{
    use HasFactory;
    protected $table = "tb_formatsurat";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'jenissurat',
        'kodenomorsurat',
        'perihal',
        'kepalasurat',
        'isisurat',
        'kakisurat',
        'legalitas',
        'pengesahan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
