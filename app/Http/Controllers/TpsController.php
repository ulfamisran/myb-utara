<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TPS;
use App\Models\VwTps;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class TPSController extends Controller
{

    /* DATATABLE TPS By Kelurahan*/
    public function getTabelTps($id_kec, $id_kel){
        if ($id_kec == 0 && $id_kel == 0) {
            $TPS = VwTps::all();
        } else if ($id_kec != 0 && $id_kel == 0) {
            $TPS = VwTps::Where('id_kecamatan', $id_kec)->get();
        } else if ($id_kec != 0 && $id_kel != 0){
            $TPS = VwTps::where('id_kelurahan', $id_kel)->Where('id_kecamatan', $id_kec)->get();
        }

        return DataTables()->of($TPS)
        ->addColumn('jumlah_pemilih', function($data){
            if ($data->jumlah_pemilih == 0) {
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0)";
            class="btn-xs btn-danger">&nbsp<i class="fa fa-exclamation-circle"></i>  '.$data->jumlah_pemilih.' Pemilih &nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            } else {
                $link = '<b>'.$data->jumlah_pemilih.' Pemilih </b> dari <br><b>'.$data->jumlah_patappa.' Patappa </b>';
            }
            return $link;
        })
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="lihat_pemilih_btn" data_id="'.$data->id_tps.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-users"></i>  Lihat Pemilih&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_tps_btn" data_id="'.$data->id_tps.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_tps_btn" data_id="'.$data->id_tps.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['jumlah_pemilih','detail','aksi'])
        ->make(true);
    }


    /* GET ALL TPS */
    public function getAllTPS(){
        return TPS::all();
    }

    /* GET A TPS BY ID */
    public function getTPSById($id){
        return TPS::where('id', $id)->first();
    }

    /* GET A TPS BY ID KECAMATAN */
    public function getTPSByIdKelurahan($id_kec){
        if ($id_kec = 0) {
            return VwTps::all();
        } else {
            return VwTps::where('id_kelurahan', $id_kec)->get();
        }
    }

    /* GET A TPS BY ID KECAMATAN KELURAHAN TPS */
    public function getTpsByIdKecamatanKelurahanTps($id_kec, $id_kel, $id_tps){
        if ($id_kec == 0) {
            return VwTps::all();
        } else if($id_kec !=0 && $id_kel == 0){
            return VwTps::where('id_kecamatan', $id_kec)->get();
        } else if ($id_kec !=0 && $id_kel!=0 && $id_tps == 0) {
            return VwTps::where('id_kecamatan', $id_kec)->Where('id_kelurahan', $id_kel)->get();
        } else if ($id_kec !=0 && $id_kel!=0 && $id_tps != 0) {
            return VwTps::where('id_kecamatan', $id_kec)->Where('id_kelurahan', $id_kel)->Where('id_tps', $id_tps)->get();
        }
    }

    /* GET A TPS BY ID KECAMATAN KELURAHAN TPS */
    public function getTpsByIdKecamatanKelurahan($id_kec, $id_kel){
        if ($id_kec == 0 && $id_kel == 0) {
            return VwTps::all();
        } else if($id_kec !=0 && $id_kel == 0){
            return VwTps::where('id_kecamatan', $id_kec)->get();
        } else if ($id_kec !=0 && $id_kel!=0 ) {
            return VwTps::where('id_kecamatan', $id_kec)->Where('id_kelurahan', $id_kel)->get();
        }
    }


    /* INSERT TPS */
    public function tambahTPS(Request $req){
        $TPS = new TPS;
        $TPS->kecamatan_id = $req->kecamatan;
        $TPS->nama_tps = $req->tps;
            if($TPS->save()){
                return response()->json([
                    'status' => 'success',
                    'tps' => $TPS->nama_tps
                ]);
            }else {
                return response()->json([
                    'status'=>'failed',
                    'tps'=>$TPS->nama_tps
                ]);
            }
    }

    /* UPDATE TPS */
    public function updateTPS(Request $req){
        $TPS = TPS::where('id', $req->id)->first();
        $TPS->kecamatan_id = $req->kecamatan;
        $TPS->nama_tps= $req->tps;
        if( $TPS->save()){
            return response()->json([
                'status' => 'success',
                'tps' =>  $TPS->nama_tps
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'tps'=> $TPS->nama_tps
            ]);
        }
    }

    /* DELETE TPS */
    public function hapusTPS($id){
        $TPS = TPS::find($id);
        if($TPS!=null){
            $del=$TPS->delete();
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'failed'
            ]);

        }

    }
}
