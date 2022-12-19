<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormatPengesahan;
use App\Models\InfoDesa;
use App\Models\Penduduk;
use App\Models\Kk;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use App\Models\Agama;
use App\Models\Pengesahan;



use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;
use PDF;
use TCPDF;

class FormatPengesahanController extends Controller
{
    /* DATATABLE FormatPengesahan*/
    public function getTabelFormatPengesahan(){ 
        return DataTables()->of(FormatPengesahan::all())
        
      
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_formatpengesahan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_formatpengesahan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL FormatPengesahan */
    public function getAllFormatPengesahan(){
        return FormatPengesahan::all();
    }

    /* GET A FormatPengesahan BY ID */
    public function getFormatPengesahanById($id){
        return FormatPengesahan::where('id', $id)->first();
    }

  

    /* INSERT FormatPengesahan */
    public function tambahFormatPengesahan(Request $req){
        
        $FormatPengesahan = new FormatPengesahan;
        $FormatPengesahan->bentukpengesahan = $req->bentukpengesahan;
        $FormatPengesahan->isipengesahan = $req->isipengesahan;

        if($FormatPengesahan->save()){
            return response()->json([
                'status' => 'success',
                'formatpengesahan' => $FormatPengesahan->bentukpengesahan
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'formatpengesahan'=>$FormatPengesahan->bentukpengesahan
            ]);
        }
    }

    /* UPDATE FormatPengesahan */
    public function updateFormatPengesahan(Request $req){
        $FormatPengesahan = FormatPengesahan::where('id', $req->id)->first();
        $FormatPengesahan->bentukpengesahan = $req->bentukpengesahan;
        $FormatPengesahan->isipengesahan = $req->isipengesahan;

        if( $FormatPengesahan->save()){
            return response()->json([
                'status' => 'success',
                'formatpengesahan' =>  $FormatPengesahan->bentukpengesahan
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'formatpengesahan'=> $FormatPengesahan->bentukpengesahan
            ]);
        }
    }

    /* DELETE FormatPengesahan */
    public function hapusFormatPengesahan($id){
        $FormatPengesahan = FormatPengesahan::find($id); 
        if($FormatPengesahan!=null){
            $del=$FormatPengesahan->delete();
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
