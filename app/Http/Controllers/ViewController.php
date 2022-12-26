<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;

class ViewController extends Controller
{
    public function dashboardView(){
        return view ('pages.dashboard');
    }

    public function agamaView(){
        return view ('pages.agamaview');
    }

    public function pendidikanView(){
        return view ('pages.pendidikanview');
    }

    public function pekerjaanView(){
        return view ('pages.pekerjaanview');
    }

    public function statusKeluargaView(){
        return view('pages.statuskeluargaview');
    }

    public function suratMasukView(){
        return view ('pages.suratmasukview');
    }

    public function suratKeluarView(){
        return view ('pages.suratkeluarview');
    }


    public function pendudukView(){
        return view ('pages.pendudukview');
    }

    public function kkView(){
        return view ('pages.kkview');
    }

    public function detailKkView($nokk){
        return view ('pages.detailkkview', compact('nokk'));
    }

    public function formatSuratView(){
        return view('pages.formatsuratview');
    }

    public function jenisSuratView(){
        return view('pages.jenissuratview');
    }

    public function permohonanSuratView(){
        return view ('pages.permohonansuratview');
    }

    public function pengesahanView(){
        return view ('pages.pengesahanview');
    }


}
