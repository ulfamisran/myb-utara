<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKeluarga extends Model
{
    use HasFactory;
    protected $table = "tb_statuskeluarga";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'statuskeluarga',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
