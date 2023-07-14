<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VwDataDashboard;
use Response;

class VwDataDashboardController extends Controller
{
    public function getAllDataDashboard(){
        return VwDataDashboard::all();
    }
}
