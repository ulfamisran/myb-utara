<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class KecamatanController extends Controller
{
    /* DATATABLE Kecamatan*/
    public function getTabelKecamatan(){
        return DataTables()->of(Kecamatan::all())
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="detail_kecamatan_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-search"></i>  Lihat Kelurahan&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .= '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="lihat_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-users"></i>  Lihat Pemilih&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_kecamatan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_kecamatan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['detail','aksi'])
        ->make(true);
    }

    /* GET ALL Kecamatan */
    public function getAllKecamatan(){
        return Kecamatan::all();
    }

    /* GET A Kecamatan BY ID */
    public function getKecamatanById($id){
        return Kecamatan::where('id', $id)->first();
    }

    /* INSERT Kecamatan */
    public function tambahKecamatan(Request $req){
        $Kecamatan = new Kecamatan;
        $Kecamatan->nama_kecamatan = $req->kecamatan;
         if($Kecamatan->save()){
             return response()->json([
                 'status' => 'success',
                 'kecamatan' => $Kecamatan->nama_kecamatan
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'kecamatan'=>$Kecamatan->nama_kecamatan
             ]);
         }
    }

    /* UPDATE Kecamatan */
    public function updateKecamatan(Request $req){
        $Kecamatan = Kecamatan::where('id', $req->id)->first();
        $Kecamatan->nama_kecamatan= $req->kecamatan;
        if( $Kecamatan->save()){
            return response()->json([
                'status' => 'success',
                'kecamatan' =>  $Kecamatan->nama_kecamatan
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'kecamatan'=> $Kecamatan->nama_kecamatan
            ]);
        }
    }

    /* DELETE Kecamatan */
    public function hapusKecamatan($id){
        $Kecamatan = Kecamatan::find($id);
        if($Kecamatan!=null){
            $del=$Kecamatan->delete();
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
