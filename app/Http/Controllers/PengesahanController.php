<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengesahan;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PengesahanController extends Controller
{
     /* DATATABLE Pengesahan */
     public function getTabelPengesahan(){
        $data = Pengesahan::get();
        return DataTables()->of($data)
        ->editColumn('ttd', function($data){
            $link='<div class="row col-md-12 mb-2"> <img 
            src="/gambarlegalitas/'.$data->ttd.'"
            alt="preview image" style="max-height: 200px; max-width: 150px"></div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_pengesahan_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_pengesahan_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['ttd','aksi'])
        ->make(true);
    }

    /* GET ALL Pengesahan */
    public function getAllPengesahan(){
        return Pengesahan::all();
    }

    /* GET A Pengesahan BY ID */
    public function getPengesahan($id){
        return Pengesahan::where('id', $id)->first();
    }

    /* INSERT Pengesahan */
    public function insertPengesahan(Request $request){
       
        $filename="";
        if($request->hasFile('image')){
            $gambar = $request->file('image');
            $filename =  "file" . time().".".$gambar->getClientOriginalExtension(); 
            $request->file('image')->move(public_path('gambarlegalitas/'), $filename); 
        }

        $Pengesahan = new Pengesahan;
        $Pengesahan->pengesahan=$request->pengesahan;
        $Pengesahan->nama=$request->nama;
        $Pengesahan->ttd=$filename;

        if($Pengesahan->save()){
             return response()->json([
                 'status' => 'success',
                 'pengesahan' => $Pengesahan->pengesahan
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'pengesahan'=>$Pengesahan->pengesahan
             ]);
         }
    }

    /* UPDATE Pengesahan */

    public function updatePengesahan(Request $request){

        $Pengesahan =Pengesahan::where('id', $request->id)->first();
        $filename="";
        if($request->hasFile('image')){
            $gambar = $request->file('image');
            $filename =  "file" . time().".".$gambar->getClientOriginalExtension(); 
            $request->file('image')->move(public_path('gambarlegalitas/'), $filename); 
        }else{
            $filename=$Pengesahan->ttd;
        }

        $Pengesahan->pengesahan=$request->pengesahan;
        $Pengesahan->nama=$request->nama;
        $Pengesahan->ttd=$filename;

        if($Pengesahan->save()){
             return response()->json([
                 'status' => 'success',
                 'pengesahan' => $Pengesahan->pengesahan
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'pengesahan'=>$Pengesahan->pengesahan
             ]);
         }

    }

  
    /* DELETE Pengesahan */
    public function deletePengesahan($id){
        $Pengesahan = Pengesahan::find($id); 
        if($Pengesahan!=null){
            $del=$Pengesahan->delete();
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

