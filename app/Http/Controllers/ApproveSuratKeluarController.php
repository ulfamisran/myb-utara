<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApproveSuratKeluarController extends Controller
{
    /* DATATABLE ApproveSuratKeluar*/
    public function getTabelApproveSuratKeluar(){
        $data = DB::table('tb_approve_surat_keluar')->join('tb_suratkeluar', 'tb_approve_surat_keluar.id_surat_keluar', '=', 'tb_suratkeluar.id')
        ->join('tb_penduduk', 'tb_suratkeluar.nonik', '=', 'tb_penduduk.nonik')
        ->select('tb_approve_surat_keluar.id_approve as idapprove','tb_approve_surat_keluar.no_surat_keluar as nosurat', 'tb_approve_surat_keluar.tgl_approve as tanggalapprove', 'tb_suratkeluar.perihal',
        'tb_suratkeluar.id as id_surat_keluar', 'tb_suratkeluar.nokk', 'tb_suratkeluar.nonik', 'tb_penduduk.namalengkap')
        ->get();

        return DataTables()->of($data)
        ->editColumn('nonik', function($data){
            $link = $data->nonik.'<br>'.$data->namalengkap;
            return $link;
        })
        ->addColumn('file', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="/suratkeluar/'.$data->file.'" target="_blank"
            data_id="'.$data->id.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-search"></i>  Lihat  File&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
                $link =  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="delete_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['nonik','file','aksi'])
        ->make(true);
    }


    /* INSERT SuratKeluar */
    public function tambahApproveSuratKeluar(Request $req){
        $filesurat = $req->file('filesurat');
        $filename = "";
        if($filesurat!=null){
            $filename =  "file" . time().".".$filesurat->getClientOriginalExtension();
            $req->file('filesurat')->move(public_path('suratkeluar/'), $filename);
        }

        $SuratKeluar = new SuratKeluar;
        $SuratKeluar->nomorsurat = $req->nosurat;
        $SuratKeluar->perihal = $req->perihalsurat;
        $SuratKeluar->nokk = $req->nokk;
        $SuratKeluar->nonik = $req->nonik;
        $SuratKeluar->idformatsurat =$req->formatsurat;
        $SuratKeluar->isisurat = $req->isisurat;
        $SuratKeluar->kakisurat = $req->kakisurat;
        $SuratKeluar->file = $filename;
        $SuratKeluar->approve = "0";

        if($SuratKeluar->save()){
            return response()->json([
                'status' => 'success',
                'suratkeluar' => $SuratKeluar->perihal
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'suratkeluar'=>$SuratKeluar->perihal
            ]);
        }
    }
}
