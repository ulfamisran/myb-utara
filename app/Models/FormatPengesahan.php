<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatPengesahan extends Model
{
    use HasFactory;
    protected $table = "tb_formatpengesahan";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'bentukpengesahan',
        'isipengesahan',
        'create_at',
        'update_at'
    );
    public $timestamps = false;
}
