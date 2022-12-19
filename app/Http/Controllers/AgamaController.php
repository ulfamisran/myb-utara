<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class AgamaController extends Controller
{
    /* DATATABLE Agama*/
    public function getTabelAgama(){ 
        return DataTables()->of(Agama::all())
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_agama_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_agama_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL Agama */
    public function getAllAgama(){
        return Agama::all();
    }

    /* GET A Agama BY ID */
    public function getAgamaById($id){
        return Agama::where('id', $id)->first();
    }

    /* INSERT Agama */
    public function tambahAgama(Request $req){
        $Agama = new Agama;
        $Agama->agama = $req->agama;
         if($Agama->save()){
             return response()->json([
                 'status' => 'success',
                 'agama' => $Agama->agama
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'agama'=>$Agama->agama
             ]);
         }
    }

    /* UPDATE Agama */
    public function updateAgama(Request $req){
        $Agama = Agama::where('id', $req->id)->first();
        $Agama->agama= $req->agama;
        if( $Agama->save()){
            return response()->json([
                'status' => 'success',
                'agama' =>  $Agama->agama
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'agama'=> $Agama->agama
            ]);
        }
    }

    /* DELETE Agama */
    public function hapusAgama($id){
        $Agama = Agama::find($id); 
        if($Agama!=null){
            $del=$Agama->delete();
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
