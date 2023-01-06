<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = "tb_account";
    protected $primaryKey = "id";
    protected $fillable = array(
        'id',
        'nama',
        'email',
        'password',
        'level',
        'createat',
        'updateat'
    );
    public $timestamps = false;
}
