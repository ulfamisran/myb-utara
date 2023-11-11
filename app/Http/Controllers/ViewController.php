<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\VwTps;
use App\Models\Pemilihs;


class ViewController extends Controller
{
    public function dashboardView(){
        return view ('pages.dashboard');
    }

    public function kecamatanView(){
        return view ('pages.kecamatanview');
    }


    public function kelurahanView($id_kecamatan){
        return view ('pages.kelurahanview', compact('id_kecamatan'));
    }

    public function tpsView($id_kecamatan, $id_kelurahan){
        // dd($id_kelurahan);
        return view ('pages.tpsview', compact('id_kecamatan', 'id_kelurahan'));
    }

    public function pallawaView(){
        return view ('pages.pallawaview');
    }

    public function patappaView($id_pallawa){
        return view ('pages.patappaview', compact('id_pallawa'));
    }

    public function pemilihByTimView($id_pallawa, $id_patappa){
        return view ('pages.pemilihbytimview', compact('id_pallawa', 'id_patappa'));
    }

    public function pemilihByTpsView($id_kecamatan, $id_kelurahan, $id_tps){
        return view ('pages.pemilihbytpsview', compact('id_kecamatan', 'id_kelurahan', 'id_tps'));
    }

    public function persebaranTpsView($id_kecamatan, $id_kelurahan){

        $filter_kecamatan = $id_kecamatan;
        $filter_kelurahan = $id_kelurahan;


        if ($filter_kecamatan == 0 && $filter_kelurahan == 0) {
            $data = VwTps::all();

        } else {
            try {
                $data =  VwTps::all();

                if ($filter_kecamatan != 0) {
                    $data->where('id_kecamatan', $filter_kecamatan);
                }

                if ($filter_kelurahan != 0) {
                    $data->where('id_kelurahan', $filter_kelurahan);
                }

                if ($data->count() == 0) {
                    return datatables()->of([])->toJson();
                }

                return response()->json($data->get());

            } catch (\Throwable $th) {
                return response()->json([]);

            }
        }

        $locations = $data;

        return view('pages.persebarantps', compact( 'locations','filter_kecamatan', 'filter_kelurahan'));
    }

    public function persebaranTimView($id_pallawa, $id_patappa){

        if ($id_pallawa == 0 && $id_patappa == 0) {
            $data = VwTps::all();

        } else {
            try {
                if ($id_pallawa != 0 && $id_patappa == 0) {
                    $data= DB::select('CALL CountPemilihByPallawa(?)', array($id_pallawa));
                }
                if ($id_pallawa != 0 && $id_patappa != 0) {
                    $data= DB::select('CALL CountPemilihByPallawaAndPatappa(?,?)', array($id_pallawa, $id_patappa));
                }
                if ($data->count() == 0) {
                    return datatables()->of([])->toJson();
                }

                return response()->json($data->get());

            } catch (\Throwable $th) {
                return response()->json([]);

            }
        }

        $locations = $data;

        return view('pages.persebarantim', compact( 'locations','id_pallawa', 'id_patappa'));
    }


}
