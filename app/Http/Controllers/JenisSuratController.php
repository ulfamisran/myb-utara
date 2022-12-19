<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSurat;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class JenisSuratController extends Controller
{
    /* DATATABLE JenisSurat*/
    public function getTabelJenisSurat(){ 
        return DataTables()->of(JenisSurat::all())
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_jenissurat_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_jenissurat_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL JenisSurat */
    public function getAllJenisSurat(){
        return JenisSurat::all();
    }

    /* GET A JenisSurat BY ID */
    public function getJenisSuratById($id){
        return JenisSurat::where('id', $id)->first();
    }

    /* INSERT JenisSurat */
    public function tambahJenisSurat(Request $req){
        $JenisSurat = new JenisSurat;
        $JenisSurat->jenissurat = $req->jenissurat;
        if($JenisSurat->save()){
            return response()->json([
                'status' => 'success',
                'jenissurat' => $JenisSurat->jenissurat
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'jenissurat'=>$JenisSurat->jenissurat
            ]);
        }
    }

    /* UPDATE JenisSurat */
    public function updateJenisSurat(Request $req){
        $JenisSurat = JenisSurat::where('id', $req->id)->first();
        $JenisSurat->jenissurat= $req->jenissurat;
        if( $JenisSurat->save()){
            return response()->json([
                'status' => 'success',
                'jenissurat' =>  $JenisSurat->jenissurat
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'jenissurat'=> $JenisSurat->jenissurat
            ]);
        }
    }

    /* DELETE JenisSurat */
    public function hapusJenisSurat($id){
        $JenisSurat = JenisSurat::find($id); 
        if($JenisSurat!=null){
            $del=$JenisSurat->delete();
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
