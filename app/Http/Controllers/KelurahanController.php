<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelurahan;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class KelurahanController extends Controller
{
    /* DATATABLE Kelurahan*/
    public function getTabelKelurahan(){
        return DataTables()->of(Kelurahan::all())
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="detail_kk_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-search"></i>  Lihat TPS&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_kelurahan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_kelurahan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['detail','aksi'])
        ->make(true);
    }

    /* DATATABLE Kelurahan By Kecamatan*/
    public function getTabelKelurahanByKecamatan($id_kec){
        if ($id_kec == 0) {
            $Kelurahan = Kelurahan::all();
        } else {
            $Kelurahan = Kelurahan::where('kecamatan_id', $id_kec)->get();
        }

        return DataTables()->of($Kelurahan)
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="detail_kelurahan_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-search"></i>  Lihat TPS&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .= '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="lihat_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-users"></i>  Lihat Pemilih&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_kelurahan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_kelurahan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['detail','aksi'])
        ->make(true);
    }


    /* GET ALL Kelurahan */
    public function getAllKelurahan(){
        return Kelurahan::all();
    }

    /* GET A Kelurahan BY ID */
    public function getKelurahanById($id){
        return Kelurahan::where('id', $id)->first();
    }

    /* GET A Kelurahan BY ID KECAMATAN */
    public function getKelurahanByIdKecamatan($id_kec){
        if ($id_kec == 0) {
            return Kelurahan::all();
        } else {
            return Kelurahan::where('kecamatan_id', $id_kec)->get();
        }
    }

    /* INSERT Kelurahan */
    public function tambahKelurahan(Request $req){
        $Kelurahan = new Kelurahan;
        $Kelurahan->kecamatan_id = $req->kecamatan;
        $Kelurahan->nama_kelurahan = $req->kelurahan;
            if($Kelurahan->save()){
                return response()->json([
                    'status' => 'success',
                    'kelurahan' => $Kelurahan->nama_kelurahan
                ]);
            }else {
                return response()->json([
                    'status'=>'failed',
                    'kelurahan'=>$Kelurahan->nama_kelurahan
                ]);
            }
    }

    /* UPDATE Kelurahan */
    public function updateKelurahan(Request $req){
        $Kelurahan = Kelurahan::where('id', $req->id)->first();
        $Kelurahan->kecamatan_id = $req->kecamatan;
        $Kelurahan->nama_kelurahan= $req->kelurahan;
        if( $Kelurahan->save()){
            return response()->json([
                'status' => 'success',
                'kelurahan' =>  $Kelurahan->nama_kelurahan
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'kelurahan'=> $Kelurahan->nama_kelurahan
            ]);
        }
    }

    /* DELETE Kelurahan */
    public function hapusKelurahan($id){
        $Kelurahan = Kelurahan::find($id);
        if($Kelurahan!=null){
            $del=$Kelurahan->delete();
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
