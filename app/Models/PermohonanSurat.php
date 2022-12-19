<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;
    protected $table = "tb_permohonansurat";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nikpemohon',
        'namapemohon',
        'jenissurat',
        'keperluansurat',
        'statussurat',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
