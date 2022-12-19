<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSurat;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PermohonanSuratController extends Controller
{
    /* DATATABLE PermohonanSurat*/
    public function getTabelPermohonanSurat(){
        $data = DB::table('tb_permohonansurat')->join('tb_jenissurat', 'tb_permohonansurat.jenissurat', 'tb_jenissurat.id')
        ->select('tb_permohonansurat.id as id','tb_permohonansurat.nikpemohon as nikpemohon', 'tb_permohonansurat.namapemohon as namapemohon', 'tb_jenissurat.jenissurat as jenissurat', 'tb_permohonansurat.keperluansurat as keperluansurat', 'tb_permohonansurat.statussurat as statussurat')
        ->Where('tb_permohonansurat.statussurat', '=', '1')
        ->get();
        return DataTables()->of($data)
        ->addColumn('statussurat', function($data){
            if ($data->statussurat==1) {
                $link='<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-danger">
                </i>&nbsp&nbsp Permohonan Baru &nbsp&nbsp</a>';
            }else if  ($data->statussurat==2){
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="" data_id="'.$data->id.'"class="btn-xs btn-warning">
                </i>&nbsp&nbsp Permohonan  Ditolak &nbsp&nbsp</a> &nbsp&nbsp</div>';
            }else if ($data->statussurat==3){
                $link='<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-success">
                </i>&nbsp&nbsp Permohonan Diterima &nbsp&nbsp</a>';
            }else{
                $link='<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-success">
                </i>&nbsp&nbsp - &nbsp&nbsp</a>';
            }
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-info">
            &nbsp<i class="fa fa-check-square"></i>  Terima Permohonan&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div><br><br>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-times-circle"></i> Tolak Permohonan&nbsp&nbsp  </a>';
            $link .= '&nbsp</div><br><br>';
            $link .= '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['statussurat','aksi'])
        ->make(true);
    }

    public function getTabelRiwayatPermohonanSurat(){
        $data = DB::table('tb_permohonansurat')->join('tb_jenissurat', 'tb_permohonansurat.jenissurat', 'tb_jenissurat.id')
        ->select('tb_permohonansurat.id as id','tb_permohonansurat.nikpemohon as nikpemohon', 'tb_permohonansurat.namapemohon as namapemohon', 'tb_jenissurat.jenissurat as jenissurat', 'tb_permohonansurat.keperluansurat as keperluansurat', 'tb_permohonansurat.statussurat as statussurat')
        ->Where('tb_permohonansurat.statussurat', '<>', '1')
        ->get();
        return DataTables()->of($data)
        ->addColumn('statussurat', function($data){
            if ($data->statussurat==1) {
                $link='<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-danger">
                </i>&nbsp&nbsp Permohonan Baru &nbsp&nbsp</a>';
            }else if  ($data->statussurat==2){
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="" data_id="'.$data->id.'"class="btn-xs btn-warning">
                </i>&nbsp&nbsp Permohonan  Ditolak &nbsp&nbsp</a> &nbsp&nbsp</div>';
            }else if ($data->statussurat==3){
                $link='<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-success">
                </i>&nbsp&nbsp Permohonan Diterima &nbsp&nbsp</a>';
            }else{
                $link='<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-success">
                </i>&nbsp&nbsp - &nbsp&nbsp</a>';
            }
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link =  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['statussurat','aksi'])
        ->make(true);
    }


    /* GET ALL PermohonanSurat */
    public function getAllPermohonanSurat(){
        return PermohonanSurat::all();
    }

    /* GET A PermohonanSurat BY ID */
    public function getPermohonanSuratById($id){
        return PermohonanSurat::where('id', $id)->first();
    }


    /* INSERT PermohonanSurat */
    public function tambahPermohonanSurat(Request $req){
        $PermohonanSurat = new PermohonanSurat;

        $PermohonanSurat->nikpemohon = $req->nikpemohon;
        $PermohonanSurat->namapemohon = $req->namapemohon;
        $PermohonanSurat->jenissurat = $req->jenissurat;
        $PermohonanSurat->keperluansurat = $req->keperluansurat;
        $PermohonanSurat->statussurat = 1;

        if($PermohonanSurat->save()){
            return response()->json([
                'status' => 'success',
                'pemohon' => $PermohonanSurat->namapemohon
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'pemohon'=>$PermohonanSurat->namapemohon
            ]);
        }
    }

    /* UPDATE PermohonanSurat */
    public function updatePermohonanSurat(Request $req){
        $PermohonanSurat = PermohonanSurat::where


        ('id', $req->id)->first();
        $PermohonanSurat->nikpemohon = $req->nikpemohon;
        $PermohonanSurat->namapemohon = $req->namapemohon;
        $PermohonanSurat->jenissurat = $req->jenissurat;
        $PermohonanSurat->keperluansurat = $req->keperluansurat;

        if( $PermohonanSurat->save()){
            return response()->json([
                'status' => 'success',
                'penduduk' =>  $PermohonanSurat->namapemohon
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'penduduk'=> $PermohonanSurat->namapemohon
            ]);
        }
    }

    /* DELETE PermohonanSurat */
    public function hapusPermohonanSurat($id){
        $PermohonanSurat = PermohonanSurat::find($id);
        if($PermohonanSurat!=null){
            $del=$PermohonanSurat->delete();
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
