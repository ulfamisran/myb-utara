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
        $data = DB::table('tb_permohonansurat')->join('tb_formatsurat', 'tb_permohonansurat.formatsurat', 'tb_formatsurat.id')
        ->select('tb_permohonansurat.id as id','tb_permohonansurat.nikpemohon as nikpemohon', 'tb_permohonansurat.namapemohon as namapemohon', 'tb_formatsurat.perihal as perihal', 'tb_permohonansurat.keperluansurat as keperluansurat', 'tb_permohonansurat.statussurat as statussurat')
        ->Where('tb_permohonansurat.statussurat', '=', '1')
        ->get();
        return DataTables()->of($data)
        ->addColumn('statussurat', function($data){
            if ($data->statussurat==1) {
                $link='<div class=""><span style=text-decoration:none;"
                class="btn-xs  btn-primary">
                </i>&nbsp&nbsp Permohonan Baru &nbsp&nbsp</span>';
            }else if  ($data->statussurat==2){
                $link = '<div class="btn-group"><span style=text-decoration:none; href="javascript:void(0);"
                id="" data_id="'.$data->id.'"class="btn-xs btn-warning">
                </i>&nbsp&nbsp Permohonan  Ditolak &nbsp&nbsp</span> &nbsp&nbsp</div>';
            }else if ($data->statussurat==3){
                $link='<div class="btn-group"><span style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-success">
                </i>&nbsp&nbsp Permohonan Diterima &nbsp&nbsp</span>';
            }else{
                $link='<div class="btn-group"><span style=text-decoration:none; href="javascript:void(0);"
                class="btn-xs  btn-success">
                </i>&nbsp&nbsp - &nbsp&nbsp</span>';
            }
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="terima_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fa fa-check-square"></i>  Terima Permohonan&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div><br>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="tolak_permohonansurat_btn" data_id="'.$data->id.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-times-circle"></i> Tolak&nbsp  Permohonan&nbsp&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['statussurat','aksi'])
        ->make(true);
    }

    public function getTabelRiwayatPermohonanSurat(){
        $data = DB::table('tb_permohonansurat')
        ->select('tb_permohonansurat.id as id','tb_permohonansurat.nikpemohon as nikpemohon', 'tb_permohonansurat.namapemohon as namapemohon', 'tb_permohonansurat.perihal as perihal', 'tb_permohonansurat.keperluansurat as keperluansurat', 'tb_permohonansurat.statussurat as statussurat')
        ->Where('tb_permohonansurat.statussurat', '<>', '1')
        ->get();
        return DataTables()->of($data)
        ->addColumn('statussurat', function($data){
            if ($data->statussurat==1) {
                $link='<div class=""><span style=text-decoration:none;"
                class="btn-xs  btn-danger">
                </i>&nbsp Permohonan Baru &nbsp</span>';
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
        $data = DB::table('tb_permohonansurat')->join('tb_penduduk', 'tb_permohonansurat.nikpemohon', 'tb_penduduk.nonik')
        ->select('tb_permohonansurat.*', 'tb_penduduk.namalengkap as namalengkap')
        ->Where('tb_permohonansurat.id', '=', $id)
        ->first();

        return $data;
    }


    /* INSERT PermohonanSurat */
    public function tambahPermohonanSurat(Request $req){
        $PermohonanSurat = new PermohonanSurat;
        $PermohonanSurat->nokkpemohon = $req->nokkpemohon;
        $PermohonanSurat->nikpemohon = $req->nikpemohon;
        $PermohonanSurat->namapemohon = $req->namapemohon;
        $PermohonanSurat->jenissurat = $req->jenissurat;
        $PermohonanSurat->formatsurat = $req->formatsurat;
        $PermohonanSurat->perihal = $req->perihal;
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

        $PermohonanSurat = PermohonanSurat::where('id', $req->id)->first();
        $PermohonanSurat->jenissurat = $req->jenissurat;
        $PermohonanSurat->formatsurat = $req->formatsurat;
        $PermohonanSurat->perihal = $req->perihal;
        $PermohonanSurat->keperluansurat = $req->keperluansurat;
        $PermohonanSurat->statussurat = 1;

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

    /* TERIMA PERMINTAAN PermohonanSurat */
    public function terimaPermohonanSurat($id){

        $PermohonanSurat = PermohonanSurat::where('id', $id)->first();
        $PermohonanSurat->statussurat = 3;

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


    /* TOLAK PERMINTAAN PermohonanSurat */
    public function tolakPermohonanSurat($id){

        $PermohonanSurat = PermohonanSurat::where('id', $id)->first();
        $PermohonanSurat->statussurat = 2;

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
