<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusKeluarga;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class StatusKeluargaController extends Controller
{
    /* DATATABLE StatusKeluarga*/
    public function getTabelStatusKeluarga(){ 
        return DataTables()->of(StatusKeluarga::all())
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_statuskeluarga_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_statuskeluarga_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL StatusKeluarga */
    public function getAllStatusKeluarga(){
        return StatusKeluarga::all();
    }

    /* GET A StatusKeluarga BY ID */
    public function getStatusKeluargaById($id){
        return StatusKeluarga::where('id', $id)->first();
    }

    /* INSERT StatusKeluarga */
    public function tambahStatusKeluarga(Request $req){
        $StatusKeluarga = new StatusKeluarga;
        $StatusKeluarga->statuskeluarga = $req->statuskeluarga;
         if($StatusKeluarga->save()){
             return response()->json([
                 'status' => 'success',
                 'statuskeluarga' => $StatusKeluarga->statuskeluarga
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'statuskeluarga'=>$StatusKeluarga->statuskeluarga
             ]);
         }
    }

    /* UPDATE StatusKeluarga */
    public function updateStatusKeluarga(Request $req){
        $StatusKeluarga = StatusKeluarga::where('id', $req->id)->first();
        $StatusKeluarga->statuskeluarga= $req->statuskeluarga;
        if( $StatusKeluarga->save()){
            return response()->json([
                'status' => 'success',
                'statuskeluarga' =>  $StatusKeluarga->statuskeluarga
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'statuskeluarga'=> $StatusKeluarga->statuskeluarga
            ]);
        }
    }

    /* DELETE StatusKeluarga */
    public function hapusStatusKeluarga($id){
        $StatusKeluarga = StatusKeluarga::find($id); 
        if($StatusKeluarga!=null){
            $del=$StatusKeluarga->delete();
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
