<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKk;
use App\Models\DetailDetailKk;

use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class DetailKkController extends Controller
{
    /* DATATABLE DetailKk*/
    public function getTabelDetailKk($nokk){ 
        $data = DB::table('tb_detail_kk')->join('tb_kk', 'tb_detail_kk.nokk', '=', 'tb_kk.nokk')
        ->join('tb_penduduk', 'tb_detail_kk.nik_penduduk', '=', 'tb_penduduk.nonik')
        ->join('tb_statuskeluarga', 'tb_detail_kk.status', '=', 'tb_statuskeluarga.id')
        ->select('tb_detail_kk.id as iddetail', 'tb_kk.id as idkk', 'tb_kk.nokk as nokk', 'tb_penduduk.id as idpenduduk','tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap', 'tb_statuskeluarga.statuskeluarga as status')
        ->where('tb_detail_kk.nokk', '=', $nokk)
        ->get();
        return DataTables()->of($data)
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="detail_penduduk_btn" data_id="'.$data->idpenduduk.'"class="btn-xs btn-primary">
             &nbsp<i class="fas fa-search"></i>  Detail&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_detailkk_btn" data_id="'.$data->iddetail.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_detailkk_btn" data_id="'.$data->iddetail.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['detail','aksi'])
        ->make(true);
    }

    /* GET ALL DetailKk */
    public function getAllDetailKk(){
        return DetailKk::all();
    }

    /* GET A DetailKk BY ID */
    public function getDetailKkById($id){
        $data=DB::table('tb_detail_kk')->join('tb_penduduk', 'tb_detail_kk.id_kk', '=', 'tb_penduduk.id')
        ->select('tb_detail_kk.id as id', 'tb_detail_kk.nokk as nokk', 'tb_penduduk.id as id_kk','tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
        ->where('tb_detail_kk.id', $id)->first();
        return $data;
    }

    /* GET A DetailKk BY NOKK */
    public function getDetailKkByNoKk($nokk){
        $data=DB::table('tb_detail_kk')->join('tb_penduduk', 'tb_detail_kk.nik_penduduk', '=', 'tb_penduduk.nonik')
        ->select('tb_detail_kk.id as id', 'tb_detail_kk.nokk as nokk', 'tb_penduduk.id as id_kk','tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
        ->where('tb_detail_kk.nokk', $nokk)->get();
        return $data;
    }

    /* INSERT DetailKk */
    public function tambahDetailKk(Request $req){
        $DetailKk = new DetailKk;
        $DetailKk->idkk= $req->idkk;
        $DetailKk->nokk= $req->nokk;
        $DetailKk->nik_penduduk= $req->nikpenduduk;
        $DetailKk->id_penduduk= $req->idpenduduk;
        $DetailKk->status= $req->status;

        if($DetailKk->save()){
            return response()->json([
                'status' => 'success',
                'kk' => $DetailKk->nikpenduduk
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'kk'=>$DetailKk->nikpenduduk
            ]);
        }
    }

    /* UPDATE DetailKk */
    public function updateDetailKk(Request $req){
        $DetailKk = DetailKk::where('id', $req->id)->first();
        $DetailKk->nokk= $req->nokk;
        $DetailKk->nik_kk = $req->nik_kk;
        $DetailKk->id_kk = $req->id_kk;

        if( $DetailKk->save()){
            return response()->json([
                'status' => 'success',
                'kk' =>  $DetailKk->nokk
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'kk'=> $DetailKk->nokk
            ]);
        }
    }

    /* DELETE DetailKk */
    public function hapusDetailKk($id){
        $DetailKk = DetailKk::find($id); 
        if($DetailKk!=null){
            $del=$DetailKk->delete();
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
