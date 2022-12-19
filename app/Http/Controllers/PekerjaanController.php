<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PekerjaanController extends Controller
{
    /* DATATABLE Pekerjaan*/
    public function getTabelPekerjaan(){ 
        return DataTables()->of(Pekerjaan::all())
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_pekerjaan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_pekerjaan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL Pekerjaan */
    public function getAllPekerjaan(){
        return Pekerjaan::all();
    }

    /* GET A Pekerjaan BY ID */
    public function getPekerjaanById($id){
        return Pekerjaan::where('id', $id)->first();
    }

    /* INSERT Pekerjaan */
    public function tambahPekerjaan(Request $req){
        $Pekerjaan = new Pekerjaan;
        $Pekerjaan->pekerjaan = $req->pekerjaan;
         if($Pekerjaan->save()){
             return response()->json([
                 'status' => 'success',
                 'pekerjaan' => $Pekerjaan->pekerjaan
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'pekerjaan'=>$Pekerjaan->pekerjaan
             ]);
         }
    }

    /* UPDATE Pekerjaan */
    public function updatePekerjaan(Request $req){
        $Pekerjaan = Pekerjaan::where('id', $req->id)->first();
        $Pekerjaan->pekerjaan= $req->pekerjaan;
        if( $Pekerjaan->save()){
            return response()->json([
                'status' => 'success',
                'pekerjaan' =>  $Pekerjaan->pekerjaan
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'pekerjaan'=> $Pekerjaan->pekerjaan
            ]);
        }
    }

    /* DELETE Pekerjaan */
    public function hapusPekerjaan($id){
        $Pekerjaan = Pekerjaan::find($id); 
        if($Pekerjaan!=null){
            $del=$Pekerjaan->delete();
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
