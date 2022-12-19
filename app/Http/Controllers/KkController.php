<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kk;
use App\Models\DetailKk;

use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class KkController extends Controller
{
    /* DATATABLE Kk*/
    public function getTabelKk(){
        $data = DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
        ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
        ->get();
        return DataTables()->of($data)
        ->addColumn('detail', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="detail_kk_btn" data_id="'.$data->nokk.'"class="btn-xs btn-primary">
             &nbsp<i class="fas fa-search"></i>  Detail&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_kk_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_kk_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['detail','aksi'])
        ->make(true);
    }

    /* GET ALL Kk */
    public function getAllKk(){
        return Kk::all();
    }

    /* GET A Kk BY ID */
    public function getKkById($id){
        $data=DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
        ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.id as id_kk','tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
        ->where('tb_kk.id', $id)->first();
        return $data;
    }

    /* GET A Kk BY NIK */
    public function getKkByNik($nik){
        $data=DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
        ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.id as id_kk','tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
        ->where('tb_kk.nik', $nik)->first();
        return $data;
    }

    /* GET A Kk BY ID */
    // public function getKkByNo($nokk){
    //     $data=DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
    //     ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.id as id_kk','tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
    //     ->where('tb_kk.id', $id)->first();
    //     return $data;
    // }

    /* INSERT Kk */
    public function tambahKk(Request $req){
        $Kk = new Kk;
        $Kk->nokk= $req->nokk;
        $Kk->nik_kk = $req->nik_kk;
        $Kk->id_kk = $req->id_kk;

            if($Kk->save()){
                $DetailKk = new DetailKk;
                $DetailKk->nokk = $req->nokk;
                $DetailKk->nik_penduduk = $req->nik_kk;
                $DetailKk->id_penduduk = $req->id_kk;
                $DetailKk->status = "Kepala Keluarga";
                if($DetailKk->save()){
                    return response()->json([
                        'status' => 'success',
                        'kk' => $Kk->nokk
                    ]);
                }
        }else {
            return response()->json([
                'status'=>'failed',
                'kk'=>$Kk->nokk
            ]);
        }
    }

    /* UPDATE Kk */
    public function updateKk(Request $req){
        $Kk = Kk::where('id', $req->id)->first();
        $Kk->nokk= $req->nokk;
        $Kk->nik_kk = $req->nik_kk;
        $Kk->id_kk = $req->id_kk;

        if( $Kk->save()){
            return response()->json([
                'status' => 'success',
                'kk' =>  $Kk->nokk
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'kk'=> $Kk->nokk
            ]);
        }
    }

    /* DELETE Kk */
    public function hapusKk($id){
        $Kk = Kk::find($id);
        if($Kk!=null){
            $del=$Kk->delete();
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
