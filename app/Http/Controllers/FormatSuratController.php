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
        $nama_pengesah =$pengesahan->nama;
        $jabatan_pengesah =$pengesahan->pengesahan;


        //KEPALAKELUARGA
        $nomor_kk = $KK->nokk;
        $nik_kk = $KK->nik_kk;
        $nama_kk = $KK->nama_kk;
        $jk_kk= $KK->jk_kk;
        $alamat_kk = $KK->alamat_kk;
        $ttl_kk= $KK->tempatlahir_kk.', '.$KK->tgllahir_kk;
        $agama_kk = $KK->agama_kk;
        $pendidikan_kk = $KK->pendidikan_kk;
        $pekerjaan_kk = $KK->pekerjaan_kk;
        $jk_kk= $KK->jk_kk;
        $status_kk = $KK->status_kk;



        //PENDUDUK
        $nama=$individu->namalengkap;
        $nik=$individu->nik;
        $jk=$individu->jk;
        $alamat=$individu->alamat;
        $ttl=$individu->tempatlahir.', '.$individu->tanggallahir;
        $pendidikan=$individu->pendidikan;
        $pekerjaan=$individu->pekerjaan;
        $status=$individu->status;
        $agama=$individu->agama;

        //gambarttd
        $ttd_pengesahan = '<div><img  src="/gambarlegalitas/'.$pengesahan->ttd.'" alt="" height="60px"></div>';

        $isisurat = $FormatSurat->isisurat;

        $isisurat=str_replace(array('!!nama_pengesahan!!', '!!jabatan_pengesahan!!'),
        array($nama_pengesah, $jabatan_pengesah), $isisurat);

        $isisurat=str_replace(array('!!nama_kk!!', '!!nik_kk!!', '!!alamat_kk!!', '!!jk_kk!!', '!!ttl_kk!!','!!pendidikan_kk!!', '!!statuskawin_kk!!','!!agama_kk!!','!!pekerjaan_kk!!','!!nomor_kk!!'),
        array($nama_kk, $nik_kk, $alamat_kk, $jk_kk, $ttl_kk, $pendidikan_kk, $pekerjaan_kk, $status_kk, $agama_kk, $nomor_kk), $isisurat);

        $isisurat=str_replace(array('!!nama!!', '!!nik!!', '!!alamat!!', '!!jk!!', '!!ttl!!','!!pendidikan!!', '!!statuskawin!!','!!agama!!','!!pekerjaan!!'),
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

        $PDF->setCellHeightRatio(0.8);
        $kop = '<br><br><p style="text-align:center; font-family:Georgia, serif; font-size:12px;"><b><u>'.$FormatSurat->perihal.'</u></b></p>';
        $kop .= '<p style="text-align:center; font-family:Georgia, serif; font-size:12px;">Nomor : 001/002/'.$FormatSurat->kodenomorsurat.'/XI/2022</p>';
        $PDF->writeHTML($kop, false, false, true, false, '');
        // $PDF->Ln(); 
        // $PDF->Ln(); 
        $PDF->setCellHeightRatio(1.15);
        $isi = '<div  style="text-align:justify; font-family:Georgia, serif; font-size:12px; ">';
        // $isi .= '<p style="text-align:center; font-family:Georgia, serif; font-size:12px;"><b><u>'.$FormatSurat->perihal.'</u></b></p>';
        // $isi .= '<p style="text-align:center; font-family:Georgia, serif; font-size:12px;">Nomor : 001/002/'.$FormatSurat->kodenomorsurat.'/XI/2022</p>';
        $isi .= $isisurat;
        $isi .='</div>';
        $PDF->writeHTML($isi, false, false, true, false, '');
        
        $PDF->setCellHeightRatio(0.8);
        $ttd = '<div style="text-align:justify; font-family:Georgia, serif; font-size:12px;">';
        $ttd .= $FormatSurat->kakisurat;
        $ttd .='</div>';
        
        $ttd = str_replace('!!ttd_pengesahan!!', $ttd_pengesahan, $ttd);
        $ttd=str_replace(array('!!nama_pengesahan!!', '!!jabatan_pengesahan!!'),
        array($nama_pengesah, $jabatan_pengesah), $ttd);

        $PDF->writeHTML($ttd, true, false, true, false, '');

        
        
        // $PDF->writeHTML($html, true, false, true, false, '');

        $PDF->Output('surat.pdf');

    }
    
}
