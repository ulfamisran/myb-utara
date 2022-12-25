<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApproveSuratKeluar;
use App\Models\SuratKeluar;
use App\Models\HitungSuratKeluar;

use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;
use Carbon\Carbon;

class ApproveSuratKeluarController extends Controller
{
    /* DATATABLE ApproveSuratKeluar*/
    public function getTabelApproveSuratKeluar(){
        $data = DB::table('tb_approve_surat_keluar')->join('tb_suratkeluar', 'tb_approve_surat_keluar.id_surat_keluar', '=', 'tb_suratkeluar.id')
        ->join('tb_penduduk', 'tb_suratkeluar.nonik', '=', 'tb_penduduk.nonik')
        ->select('tb_approve_surat_keluar.id as idapprove','tb_approve_surat_keluar.no_surat_keluar as nosurat', 'tb_approve_surat_keluar.tgl_approve as tanggalapprove', 'tb_suratkeluar.perihal','tb_suratkeluar.file',
        'tb_suratkeluar.id as id_surat_keluar', 'tb_suratkeluar.nokk', 'tb_suratkeluar.nonik', 'tb_penduduk.namalengkap')
        ->get();

        return DataTables()->of($data)
        ->editColumn('nonik', function($data){
            $link = $data->nonik.'<br>'.$data->namalengkap;
            return $link;
        })
        ->addColumn('file', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="/suratkeluar/'.$data->file.'" target="_blank"
            data_id="'.$data->idapprove.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-search"></i>  Lihat  File&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
                $link =  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="delete_suratkeluar_btn" data_id="'.$data->idapprove.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['nonik','file','aksi'])
        ->make(true);
    }


    /* APPROVE SuratKeluar */
    public function ApproveSuratKeluar(Request $req){

        $SuratKeluar = SuratKeluar::where('id', '=', $req->idsuratkeluar)->first();
        // $kodesurat = $SuratKeluar->nomorsurat;
        $date = Carbon::now();
        $formatedDate = $date->format('Y-m-d');
        $bulan = date("m");
        $tahun = date("Y");

        $jumlahsuratkeluar = HitungSuratKeluar::where('id','=', '1')->first();
        $nosurat = $jumlahsuratkeluar->jumlah_surat+1;
        $bulanromawi = "";
        switch ($bulan) {
            case 1 : $bulanromawi = "I"; break;
            case 2 : $bulanromawi = "II"; break;
            case 3 : $bulanromawi = "IIi"; break;
            case 4 : $bulanromawi = "IV"; break;
            case 5 : $bulanromawi = "V"; break;
            case 6 : $bulanromawi = "VI"; break;
            case 7 : $bulanromawi = "VII"; break;
            case 8 : $bulanromawi = "VIII"; break;
            case 9 : $bulanromawi = "IX"; break;
            case 10 : $bulanromawi = "X"; break;
            case 11 : $bulanromawi = "XI"; break;
            case 12 : $bulanromawi = "XII"; break;

        }
        $no_surat_keluar ="";

        for($i=0; $i<$req->jumlahsurat; $i++){
            $no_surat_keluar = $nosurat."/".$SuratKeluar->nomorsurat."/".$bulanromawi."/".$tahun;
            $Approve = new ApproveSuratKeluar;
            $Approve->id_surat_keluar = $req->idsuratkeluar;
            $Approve->no_surat_keluar = $no_surat_keluar;
            $Approve->bulan = $bulanromawi;
            $Approve->tahun = $tahun;
            $Approve->tgl_approve = date("Y-m-d");

            $Approve->save();

            $nosurat = $nosurat+1;
        }

        $HitungSuratKeluar = HitungSuratKeluar::where('id', '=', 1)->first();
        $HitungSuratKeluar->jumlah_surat = $nosurat-1;

        if($HitungSuratKeluar->save()){
            $SuratKeluar->approve=1;
            $SuratKeluar->save();
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
