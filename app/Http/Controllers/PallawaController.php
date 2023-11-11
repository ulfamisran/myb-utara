<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pallawa;
use App\Models\User;
use App\Models\VwTotalPemilihByPallawa;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PallawaController extends Controller
{
    /* DATATABLE Pallawa*/
    public function getTabelPallawa(){
        return DataTables()->of(VwTotalPemilihByPallawa::all())
        ->addColumn('jumlah_pemilih', function($data){
            $link = $data->jumlah_pemilih.' Pemilih dari '.$data->jumlah_tps.' TPS';
            return $link;
        })
        ->addColumn('jumlah_patappa', function($data){
            $link = $data->jumlah_patappa.' Patappa';
            return $link;
        })
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="detail_pallawa_btn" data_id="'.$data->id_pallawa.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-search"></i>  Lihat Patappa&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .= '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="lihat_pemilih_btn" data_id="'.$data->id_pallawa.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-users"></i>  Lihat Pemilih&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_pallawa_btn" data_id="'.$data->id_pallawa.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';

            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['jumlah_patappa','jumlah_pemilih','detail','aksi'])
        ->make(true);
    }

    /* GET ALL Pallawa */
    public function getAllPallawa(){
        return VwTotalPemilihByPallawa::all();
    }

    /* GET A Pallawa BY ID */
    public function getPallawaById($id){
        return Pallawa::where('id', $id)->first();
    }

    /* INSERT Pallawa */
    public function tambahPallawa(Request $req){

        $user = User::create([
            'username' => $req->no_telp,
            'role' => 'pallawa',
        ]);

        $Pallawa = new Pallawa;
        $Pallawa->nama = $req->nama;
        $Pallawa->nik = $req->nik;
        $Pallawa->jk = $req->jk;
        $Pallawa->tps_id = $req->tps_id;
        $Pallawa->user_id = $user->id;
        $Pallawa->no_telp = $req->no_telp;
        $Pallawa->lokasi_name = $req->lokasi_name;
        $Pallawa->lat = $req->lat;
        $Pallawa->lon = $req->lon;

        if($Pallawa->save()){
            return response()->json([
                'status' => 'success',
                'pallawa' => $Pallawa->nama
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'pallawa'=>$Pallawa->nama
            ]);
        }
    }

    /* UPDATE Pallawa */
    public function updatePallawa(Request $req){
        // Temukan instance model User dan update kolom 'username'
        $User = User::where('id', $req->user_id)->first();
        $User->username = $req->no_telp;

        if ($User->save()) {
            // Temukan instance model Pallawa dan update kolom-kolom yang sesuai
            $Pallawa = Pallawa::where('id', $req->id)->first();
            $Pallawa->nama = $req->nama;
            $Pallawa->nik = $req->nik;
            $Pallawa->jk = $req->jk;
            $Pallawa->tps_id = $req->tps_id;
            $Pallawa->user_id = $req->user_id;
            $Pallawa->no_telp = $req->no_telp;
            $Pallawa->lokasi_name = $req->lokasi_name;
            $Pallawa->lat = $req->lat;
            $Pallawa->lon = $req->lon;

            if ($Pallawa->save()) {
                return response()->json([
                    'status' => 'success',
                    'pallawa' =>  $Pallawa->nama
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'pallawa' => $Pallawa->nama
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'pallawa' => $User->username // Menggunakan kolom 'username' dari User
            ]);
        }
    }


    /* DELETE Pallawa */
    public function hapusPallawa($id){
        $Pallawa = Pallawa::find($id);
        if($Pallawa!=null){
            $del_pallawa=$Pallawa->delete();
            $User = User::where('id', $Pallawa->user_id)->first();
            $del_user=$User->delete();
            if($del_user && $del_pallawa){
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
