<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwDataDashboard extends Model
{
    use HasFactory;
    protected $table = "vwdatadashboard";
    protected $primaryKey = "";
    protected $fillable = array(
        'total_pallawa',
        'total_patappa',
        'total_pemilih',
        'total_tps'
    );
    public $timestamps = false;
}
