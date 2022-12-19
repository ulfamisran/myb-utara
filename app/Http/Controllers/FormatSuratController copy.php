<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormatSurat;
use App\Models\InfoDesa;
use App\Models\Penduduk;
use App\Models\Kk;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use App\Models\Agama;
use App\Models\Pengesahan;



use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;
use PDF;
use TCPDF;

class FormatSuratController extends Controller
{
    /* DATATABLE FormatSurat*/
    public function getTabelFormatSurat(){ 
        return DataTables()->of(FormatSurat::all())
        
        ->addColumn('lihatsurat', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; target="_blank"; href="/admin/lihatformatsurat/'.$data->id.';"
            id="lihat_formatsurat_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
            &nbsp<i class="fas fa-edit"></i>  Lihat Surat&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_formatsurat_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_formatsurat_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['lihatsurat','aksi'])
        ->make(true);
    }

    /* GET ALL FormatSurat */
    public function getAllFormatSurat(){
        return FormatSurat::all();
    }

    /* GET A FormatSurat BY ID */
    public function getFormatSuratById($id){
        return FormatSurat::where('id', $id)->first();
    }

     /* GET A FormatSurat BY Jenis Surat */
     public function getFormatSuratByJenisSurat($jenissurat){
        return FormatSurat::where('jenissurat', $jenissurat)->get();
    }


    /* INSERT FormatSurat */
    public function tambahFormatSurat(Request $req){
        $filename="";
        if($req->hasFile('image')){
            $gambar = $req->file('image');
            $filename =  "file" . time().".".$gambar->getClientOriginalExtension(); 
            $req->file('image')->move(public_path('gambarlegalitas/'), $filename); 
        }

        $FormatSurat = new FormatSurat;
        $FormatSurat->jenissurat = $req->jenissurat;
        $FormatSurat->kodenomorsurat = $req->kodenomorsurat;
        $FormatSurat->perihal = $req->perihal;
        $FormatSurat->kepalasurat = $req->kepalasurat;
        $FormatSurat->isisurat = $req->isisurat;
        $FormatSurat->kakisurat = $req->kakisurat;
        $FormatSurat->legalitas = $req->legalitas;
        $FormatSurat->pengesahan = $req->pengesahan;

        
        if($FormatSurat->save()){
            return response()->json([
                'status' => 'success',
                'formatsurat' => $FormatSurat->perihal
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'formatsurat'=>$FormatSurat->perihal
            ]);
        }
    }

    /* UPDATE FormatSurat */
    public function updateFormatSurat(Request $req){
        $FormatSurat = FormatSurat::where('id', $req->id)->first();
        $FormatSurat->jenissurat = $req->jenissurat;
        $FormatSurat->kodenomorsurat = $req->kodenomorsurat;
        $FormatSurat->perihal = $req->perihal;
        $FormatSurat->kepalasurat = $req->kepalasurat;
        $FormatSurat->isisurat = $req->isisurat;
        $FormatSurat->kakisurat = $req->kakisurat;
        $FormatSurat->legalitas = $req->legalitas;

        if( $FormatSurat->save()){
            return response()->json([
                'status' => 'success',
                'formatsurat' =>  $FormatSurat->perihal
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'formatsurat'=> $FormatSurat->perihal
            ]);
        }
    }

    /* DELETE FormatSurat */
    public function hapusFormatSurat($id){
        $FormatSurat = FormatSurat::find($id); 
        if($FormatSurat!=null){
            $del=$FormatSurat->delete();
            return response()->json([
                'status'=>'success'
            ]);           
        }else{
            return response()->json([
                'status'=>'failed'
            ]);
           
        }

    }

     /* LIHAT FormatSurat */
     public function lihatFormatSurat1($id){
        $FormatSurat = FormatSurat::find($id); 

        $InfoDesa =InfoDesa::first();

 
    }

     /* LIHAT FormatSurat */
     public function lihatFormatSurat($id){

        $FormatSurat = FormatSurat::find($id); 
        // dd($FormatSurat->pengesahan);
        $InfoDesa =InfoDesa::first();

        $pengesahan = Pengesahan::where('id','=', $FormatSurat->pengesahan)->first();
        // dd($pengesahan->pengesahan);


        $KK = DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
        ->join('tb_agama', 'tb_penduduk.agama', '=', 'tb_agama.id')
        ->join('tb_pendidikan', 'tb_penduduk.pendidikan', '=', 'tb_pendidikan.id')
        ->join('tb_pekerjaan', 'tb_penduduk.pekerjaan', '=', 'tb_pekerjaan.id')
        ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.nonik as nik_kk', 'tb_penduduk.namalengkap as nama_kk', 'tb_penduduk.jeniskelamin as jk_kk', 'tb_penduduk.status as status_kk',
                'tb_penduduk.tempatlahir as tempatlahir_kk', 'tb_penduduk.tanggallahir as tgllahir_kk', 'tb_penduduk.alamat as alamat_kk', 'tb_agama.agama as agama_kk', 
                'tb_pendidikan.pendidikan as pendidikan_kk', 'tb_pekerjaan.pekerjaan as pekerjaan_kk')
        ->where('tb_kk.id', '=', 1)
        ->first();
        // dd($KK);

        // $individu1 = Penduduk::where('id', $id)->first();
        $individu = DB::table('tb_penduduk')->join('tb_agama', 'tb_penduduk.agama', '=', 'tb_agama.id')
        ->join('tb_pendidikan', 'tb_penduduk.pendidikan', '=', 'tb_pendidikan.id')
        ->join('tb_pekerjaan', 'tb_penduduk.pekerjaan', '=', 'tb_pekerjaan.id')
        ->select('tb_penduduk.nonik as nik', 'tb_penduduk.namalengkap as namalengkap', 'tb_penduduk.jeniskelamin as jk', 'tb_penduduk.tempatlahir as tempatlahir', 'tb_penduduk.tanggallahir as tanggallahir', 'tb_penduduk.alamat as alamat',
        'tb_penduduk.status as status', 'tb_agama.agama as agama', 'tb_pendidikan.pendidikan as pendidikan', 'tb_pekerjaan.pekerjaan as pekerjaan')
        ->where('tb_penduduk.id', '=', 1)
        ->first();
        // dd($individu);
        
        //PENGESAH
        $nama_pengesah ='<table><tr><td width="5%"></td><td width="30%">Nama</td><td width="2%">:</td><td width="63%">'.$pengesahan->nama.'</td></tr></table>';
        $jabatan_pengesah ='<table><tr><td width="5%"></td><td width="30%">Jabatan</td><td width="2%">:</td><td width="63%">'.$pengesahan->pengesahan.'</td></tr></table>';


        //KEPALAKELUARGA
        $nomor_kk = '<table><tr><td width="5%"></td><td width="30%">No. Kartu Keluarga</td><td width="2%">:</td><td width="63%">'.$KK->nokk.'</td></tr></table>';
        $nik_kk = '<table><tr><td width="5%"></td><td width="30%">NIK</td><td width="2%">:</td><td width="63%">'.$KK->nik_kk.'</td></tr></table>';
        $nama_kk = '<table><tr><td width="5%"></td><td width="30%">Nama</td><td width="2%">:</td><td width="63%">'.$KK->nama_kk.'</td></tr></table>';
        $jk_kk='<table><tr><td width="5%"></td><td width="30%">Jenis Kelamin</td><td width="2%">:</td><td width="63%">'.$KK->jk_kk.'</td></tr></table>';
        $alamat_kk = '<table><tr><td width="5%"></td><td width="30%">Alamat</td><td width="2%">:</td><td width="63%">'.$KK->alamat_kk.'</td></tr></table>';
        $ttl_kk='<table><tr><td width="5%"></td><td width="30%">Tempat Tanggal Lahir</td><td width="2%">:</td><td width="63%">'.$KK->tempatlahir_kk.', '.$KK->tgllahir_kk.'</td></tr></table>';
        $agama_kk = '<table><tr><td width="5%"></td><td width="30%">Agama</td><td width="2%">:</td><td width="63%">'.$KK->agama_kk.'</td></tr></table>';
        $pendidikan_kk = '<table><tr><td width="5%"></td><td width="30%">Pendidikan</td><td width="2%">:</td><td width="63%">'.$KK->pendidikan_kk.'</td></tr></table>';
        $pekerjaan_kk = '<table><tr><td width="5%"></td><td width="30%">Pekerjaan</td><td width="2%">:</td><td width="63%">'.$KK->pekerjaan_kk.'</td></tr></table>';
        $jk_kk='<table><tr><td width="5%"></td><td width="30%">Jenis Kelamin</td><td width="2%">:</td><td width="63%">'.$KK->jk_kk.'</td></tr></table>';
        $status_kk = '<table><tr><td width="5%"></td><td width="30%">Status</td><td width="2%">:</td><td width="63%">'.$KK->status_kk.'</td></tr></table>';



        //PENDUDUK
        $nama='<table><tr><td width="5%"></td><td width="30%">Nama</td><td width="2%">:</td><td width="63%">'.$individu->namalengkap.'</td></tr></table>';
        $nik='<table><tr><td width="5%"></td><td width="30%">NIK</td><td width="2%">:</td><td width="63%">'.$individu->nik.'</td></tr></table>';
        $jk='<table><tr><td width="5%"></td><td width="30%">Jenis Kelamin</td><td width="2%">:</td><td width="63%">'.$individu->jk.'</td></tr></table>';
        $alamat='<table><tr><td width="5%"></td><td width="30%">Alamat</td><td width="2%">:</td><td width="63%">'.$individu->alamat.'</td></tr></table>';
        $ttl='<table><tr><td width="5%"></td><td width="30%">Tempat Tanggal Lahir</td><td width="2%">:</td><td width="63%">'.$individu->tempatlahir.', '.$individu->tanggallahir.'</td></tr></table>';
        $pendidikan='<table><tr><td width="5%"></td><td width="30%">Pendidikan</td><td width="2%">:</td><td width="63%">'.$individu->pendidikan.'</td></tr></table>';
        $pekerjaan='<table><tr><td width="5%"></td><td width="30%">Pekerjaan</td><td width="2%">:</td><td width="63%">'.$individu->pekerjaan.'</td></tr></table>';
        $status='<table><tr><td width="5%"></td><td width="30%">Status Kawin</td><td width="2%">:</td><td width="63%">'.$individu->status.'</td></tr></table>';
        $agama='<table><tr><td width="5%"></td><td width="30%">Agama</td><td width="2%">:</td><td width="63%">'.$individu->agama.'</td></tr></table>';

        //gambarttd
        $ttd_pengesahan = '<div><img  src="/gambarlegalitas/'.$pengesahan->ttd.'" alt="" height="60px"></div>';

        $isisurat = $FormatSurat->isisurat;

        $isisurat=str_replace(array('<p>!!nama_pengesahan!!</p>', '<p>!!jabatan_pengesahan!!</p>'),
        array($nama_pengesah, $jabatan_pengesah), $isisurat);

        $isisurat=str_replace(array('<p>!!nama_kk!!</p>', '<p>!!nik_kk!!</p>', '<p>!!alamat_kk!!</p>', '<p>!!jk_kk!!</p>', '<p>!!ttl_kk!!</p>','<p>!!pendidikan_kk!!</p>', '<p>!!statuskawin_kk!!</p>','<p>!!agama_kk!!</p>','<p>!!pekerjaan_kk!!</p>','<p>!!nomor_kk!!</p>'),
        array($nama_kk, $nik_kk, $alamat_kk, $jk_kk, $ttl_kk, $pendidikan_kk, $pekerjaan_kk, $status_kk, $agama_kk, $nomor_kk), $isisurat);

        $isisurat=str_replace(array('<p>!!nama!!</p>', '<p>!!nik!!</p>', '<p>!!alamat!!</p>', '<p>!!jk!!</p>', '<p>!!ttl!!</p>','<p>!!pendidikan!!</p>', '<p>!!statuskawin!!</p>','<p>!!agama!!</p>','<p>!!pekerjaan!!</p>'),
        array($nama, $nik, $alamat, $jk, $ttl, $pendidikan, $pekerjaan, $status, $agama), $isisurat);

        // Custom Header
        

        $PDF = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(297, 210), true, 'UTF-8', false);
       
        $PDF->SetMargins(25, 10, 25, true);
        $PDF->SetAutoPageBreak(TRUE, 0);
        $PDF->SetTitle('Surat');
        $PDF->setPrintFooter(false);
        $PDF->setPrintHeader(false);
        $PDF->AddPage('P');
        $PDF->SetCellPaddings(0, 0, 0);
        // $PDF->SetFont('Helvetica', '', 10);

        // get the current page break margin
        $bMargin = $PDF->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $PDF->getAutoPageBreak();
        // disable auto-page-break
        $PDF->SetAutoPageBreak(TRUE, 0);
        
        // restore auto-page-break status
        $PDF->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $PDF->setPageMark();
        // $PDF->Image($img_file, 0, 0, 0, 0, '', '', '', false, 0, '', false, false, 0);
        $PDF->setCellHeightRatio(0.8);

        #header
        $header = '<div><img  src="/gambarlogo/logo_enrekang.png" style=" text-align:center; " alt="" height="60px"></div>';
        $header .= '<h3 style="text-align:center; font-family:Georgia, serif; font-size:14px;" >PEMERINTAH KABUPATEN ENREKANG</h3>
        <h3 style="text-align:center; font-family:Georgia, serif; font-size:14px;">KECAMATAN BUNTU BATU</h3>
        <h2 style="text-align:center; font-family:Georgia, serif; font-size:18px;">DESA BUNTU MONDONG</h2>
        <h5 style="text-align:center; font-family:Georgia, serif; font-size:10px;">Alamat : Dusun Gura Jln. Poros Baraka-Latimojong No. 10 &#13;<br>';
        $header .='<hr style="height:2px;border-width:0;color:black;">';
        $PDF->writeHTML($header, false, false, true, false, '');
        // $PDF->Ln(); 
        // $PDF->Ln(); 
        $PDF->setCellHeightRatio(1.15);
        $isi = '<div  style="text-align:justify; font-family:Georgia, serif; font-size:12px; ">';
        $isi .= $isisurat;
        $isi .='</div>';
        $PDF->writeHTML($isi, false, false, true, false, '');
        
        $PDF->setCellHeightRatio(0.8);
        $ttd = '<div style="text-align:justify; font-family:Georgia, serif; font-size:12px;">';
        $ttd .= $FormatSurat->kakisurat;
        $ttd .='</div>';
        
        $ttd = str_replace('!!ttd_pengesahan!!', $ttd_pengesahan, $ttd);

        $PDF->writeHTML($ttd, true, false, true, false, '');

        
        
        // $PDF->writeHTML($html, true, false, true, false, '');

        $PDF->Output('surat.pdf');

    }
    
}
