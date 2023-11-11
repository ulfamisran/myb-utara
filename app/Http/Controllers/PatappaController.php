<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patappa;
use App\Models\VwTotalPemilihByPatappa;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PatappaController extends Controller
{

    /* DATATABLE Patappa By Pallawa*/
    public function getTabelPatappaByPallawa($id_pallawa){
        if ($id_pallawa == 0) {
            $Patappa = VwTotalPemilihByPatappa::all();
        } else {
            $Patappa = VwTotalPemilihByPatappa::where('id_pallawa', $id_pallawa)->get();
        }

        return DataTables()->of($Patappa)
        ->addColumn('jumlah_pemilih', function($data){
            $link = '<b>'.$data->jumlah_pemilih.' Pemilih </b>  dari <b> '.$data->jumlah_tps.' TPS </b>';
            return $link;
        })
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="lihat_pemilih_btn" data_id="'.$data->id_patappa.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-users"></i>  Lihat Pemilih&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_patappa_btn" data_id="'.$data->id_patappa.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            if ($data->jumlah_pemilih==0){
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_patappa_btn" data_id="'.$data->id_patappa.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            }
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['jumlah_pemilih','detail','aksi'])
        ->make(true);
    }


    /* GET ALL Patappa */
    public function getAllPatappa(){
        return Patappa::all();
    }

    /* GET A Patappa BY ID */
    public function getPatappaById($id){
        return Patappa::where('id', $id)->first();
    }

    /* GET A Patappa BY ID KECAMATAN */
    public function getPatappaByIdPallawa($id_pallawa){
        if ($id_pallawa == 0) {
            return Patappa::all();
        } else {
            return Patappa::where('pallawa_id', $id_pallawa)->get();
        }
    }

    /* INSERT Patappa */
    public function tambahPatappa(Request $req){
        $user = User::create([
            'username' => $req->no_telp,
            'role' => 'patappa',
        ]);

        $Patappa = new Patappa;
        $Patappa->nama = $req->nama;
        $Patappa->nik = $req->nik;
        $Patappa->jk = $req->jk;
        $Patappa->pallawa_id = $req->pallawa_id;
        $Patappa->tps_id = $req->tps_id;
        $Patappa->user_id = $user->id;
        $Patappa->no_telp = $req->no_telp;
        $Patappa->lokasi_name = $req->lokasi_name;
        $Patappa->lat = $req->lat;
        $Patappa->lon = $req->lon;
        if($Patappa->save()){
            return response()->json([
                'status' => 'success',
                'patappa' => $Patappa->nama
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'patappa'=>$Patappa->nama
            ]);
        }
    }

    /* UPDATE Patappa */
    public function updatePatappa(Request $req){
        $User = User::where('id', $req->user_id)->first();
        $User->username = $req->no_telp;

        if ($User->save()) {
            // Temukan instance model Pallawa dan update kolom-kolom yang sesuai
            $Patappa = Patappa::where('id', $req->id)->first();
            $Patappa->nama = $req->nama;
            $Patappa->nik = $req->nik;
            $Patappa->jk = $req->jk;
            $Patappa->pallawa_id = $req->pallawa_id;
            $Patappa->tps_id = $req->tps_id;
            $Patappa->user_id = $req->user_id;
            $Patappa->no_telp = $req->no_telp;
            $Patappa->lokasi_name = $req->lokasi_name;
            $Patappa->lat = $req->lat;
            $Patappa->lon = $req->lon;

            if ($Patappa->save()) {
                return response()->json([
                    'status' => 'success',
                    'patappa' =>  $Patappa->nama
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'patappa' => $Patappa->nama
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'patappa' => $User->username // Menggunakan kolom 'username' dari User
            ]);
        }
    }

    /* DELETE Patappa */
    public function hapusPatappa($id){
        $Patappa = Patappa::find($id);
        if($Patappa!=null){
            $del_patappa=$Patappa->delete();
            $User = User::where('id', $Patappa->user_id)->first();
            $del_user=$User->delete();
            if($del_user && $del_patappa){
                return response()->json([
                'status'=>'success'
                ]);
            }else{
                return response()->json([
                'status'=>'success'
            ]);
        }
        }else{
            return response()->json([
                'status'=>'failed'
            ]);
        }
    }
}
