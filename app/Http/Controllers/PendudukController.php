<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PendudukController extends Controller
{
    /* DATATABLE Penduduk*/
    public function getTabelPenduduk(){ 
        return DataTables()->of(Penduduk::all())
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="detail_penduduk_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
             &nbsp<i class="fas fa-search"></i>  Detail&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_penduduk_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_penduduk_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['detail','aksi'])
        ->make(true);
    }

    /* GET ALL Penduduk */
    public function getAllPenduduk(){
        return Penduduk::all();
    }

    /* GET A Penduduk BY ID */
    public function getPendudukById($id){
        return Penduduk::where('id', $id)->first();
    }

    /* GET A Penduduk BY NIK */
    public function getPendudukByNik($nik){
        return Penduduk::where('nonik', $nik)->first();
    }

    /* INSERT Penduduk */
    public function tambahPenduduk(Request $req){
        $Penduduk = new Penduduk;
        $Penduduk->nonik = $req->nik;
        $Penduduk->namalengkap = $req->namalengkap;
        $Penduduk->tempatlahir = $req->tempatlahir;
        $Penduduk->tanggallahir = $req->tanggallahir;
        $Penduduk->agama = $req->agama;
        $Penduduk->alamat = $req->alamat;
        $Penduduk->pendidikan = $req->pendidikan;
        $Penduduk->pekerjaan = $req->pekerjaan;
        $Penduduk->jeniskelamin = $req->jeniskelamin;
         if($Penduduk->save()){
             return response()->json([
                 'status' => 'success',
                 'penduduk' => $Penduduk->namalengkap
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'penduduk'=>$Penduduk->namalengkap
             ]);
         }
    }

    /* UPDATE Penduduk */
    public function updatePenduduk(Request $req){
        $Penduduk = Penduduk::where('id', $req->id)->first();
        $Penduduk->nonik = $req->nik;
        $Penduduk->namalengkap = $req->namalengkap;
        $Penduduk->tempatlahir = $req->tempatlahir;
        $Penduduk->tanggallahir = $req->tanggallahir;
        $Penduduk->agama = $req->agama;
        $Penduduk->alamat = $req->alamat;
        $Penduduk->pendidikan = $req->pendidikan;
        $Penduduk->pekerjaan = $req->pekerjaan;
        $Penduduk->jeniskelamin = $req->jeniskelamin;
        if( $Penduduk->save()){
            return response()->json([
                'status' => 'success',
                'penduduk' =>  $Penduduk->namalengkap
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'penduduk'=> $Penduduk->namalengkap
            ]);
        }
    }

    /* DELETE Penduduk */
    public function hapusPenduduk($id){
        $Penduduk = Penduduk::find($id); 
        if($Penduduk!=null){
            $del=$Penduduk->delete();
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
