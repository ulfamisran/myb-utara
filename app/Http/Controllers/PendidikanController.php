<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendidikan;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PendidikanController extends Controller
{
    /* DATATABLE Pendidikan*/
    public function getTabelPendidikan(){ 
        return DataTables()->of(Pendidikan::all())
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_pendidikan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_pendidikan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL Pendidikan */
    public function getAllPendidikan(){
        return Pendidikan::all();
    }

    /* GET A Pendidikan BY ID */
    public function getPendidikanById($id){
        return Pendidikan::where('id', $id)->first();
    }

    /* INSERT Pendidikan */
    public function tambahPendidikan(Request $req){
        $Pendidikan = new Pendidikan;
        $Pendidikan->pendidikan = $req->pendidikan;
         if($Pendidikan->save()){
             return response()->json([
                 'status' => 'success',
                 'pendidikan' => $Pendidikan->pendidikan
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'pendidikan'=>$Pendidikan->pendidikan
             ]);
         }
    }

    /* UPDATE Pendidikan */
    public function updatePendidikan(Request $req){
        $Pendidikan = Pendidikan::where('id', $req->id)->first();
        $Pendidikan->pendidikan= $req->pendidikan;
        if( $Pendidikan->save()){
            return response()->json([
                'status' => 'success',
                'pendidikan' =>  $Pendidikan->pendidikan
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'pendidikan'=> $Pendidikan->pendidikan
            ]);
        }
    }

    /* DELETE Pendidikan */
    public function hapusPendidikan($id){
        $Pendidikan = Pendidikan::find($id); 
        if($Pendidikan!=null){
            $del=$Pendidikan->delete();
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
