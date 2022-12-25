<?php

namespace App\Http\Controllers;

use PDF;
use TCPDF;

use App\Models\Kk;
use App\Models\Penduduk;
use App\Models\FormatSurat;
use App\Models\ApproveSuratKeluar;
use App\Models\SuratKeluar;
use App\Models\InfoDesa;
use App\Models\Pengesahan;

use Illuminate\Http\Request;

use DB;

class SuratPdfController extends Controller
{

    // LIHAT Surat Keluar
    public function lihatSuratKeluar($id){

        $surat = DB::table('tb_suratkeluar')
        ->join('tb_formatsurat', 'tb_suratkeluar.idformatsurat', '=', 'tb_formatsurat.id')
        ->select('tb_suratkeluar.*','tb_formatsurat.pengesahan as pengesahan')
        ->where('tb_suratkeluar.id', '=', $id)
        ->first();

        // $FormatSurat = FormatSurat::find($id);
        // dd($surat);
        $InfoDesa =InfoDesa::first();

        $pengesahan = Pengesahan::where('id','=', $surat->pengesahan)->first();
        // dd($pengesahan->pengesahan);


        $KK = DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
        ->join('tb_agama', 'tb_penduduk.agama', '=', 'tb_agama.id')
        ->join('tb_pendidikan', 'tb_penduduk.pendidikan', '=', 'tb_pendidikan.id')
        ->join('tb_pekerjaan', 'tb_penduduk.pekerjaan', '=', 'tb_pekerjaan.id')
        ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.nonik as nik_kk', 'tb_penduduk.namalengkap as nama_kk', 'tb_penduduk.jeniskelamin as jk_kk', 'tb_penduduk.status as status_kk',
                'tb_penduduk.tempatlahir as tempatlahir_kk', 'tb_penduduk.tanggallahir as tgllahir_kk', 'tb_penduduk.alamat as alamat_kk', 'tb_agama.agama as agama_kk',
                'tb_pendidikan.pendidikan as pendidikan_kk', 'tb_pekerjaan.pekerjaan as pekerjaan_kk')
        ->where('tb_kk.nokk', '=', $surat->nokk)
        ->first();
        // dd($KK);

        // $individu1 = Penduduk::where('id', $id)->first();
        $individu = DB::table('tb_penduduk')->join('tb_agama', 'tb_penduduk.agama', '=', 'tb_agama.id')
        ->join('tb_pendidikan', 'tb_penduduk.pendidikan', '=', 'tb_pendidikan.id')
        ->join('tb_pekerjaan', 'tb_penduduk.pekerjaan', '=', 'tb_pekerjaan.id')
        ->select('tb_penduduk.nonik as nik', 'tb_penduduk.namalengkap as namalengkap', 'tb_penduduk.jeniskelamin as jk', 'tb_penduduk.tempatlahir as tempatlahir', 'tb_penduduk.tanggallahir as tanggallahir', 'tb_penduduk.alamat as alamat',
        'tb_penduduk.status as status', 'tb_agama.agama as agama', 'tb_pendidikan.pendidikan as pendidikan', 'tb_pekerjaan.pekerjaan as pekerjaan')
        ->where('tb_penduduk.nonik', '=', $surat->nonik)
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

        $tgl = date("d");
        $bulan = date("m");
        $tahun = date("Y");


        $namabulan = "";
        switch ($bulan) {
            case 1 : $namabulan = "Januari"; break;
            case 2 : $namabulan = "Februari"; break;
            case 3 : $namabulan = "Maret"; break;
            case 4 : $namabulan = "April"; break;
            case 5 : $namabulan = "Mei"; break;
            case 6 : $namabulan = "Juni"; break;
            case 7 : $namabulan = "Juli"; break;
            case 8 : $namabulan = "Agustus"; break;
            case 9 : $namabulan = "September"; break;
            case 10 : $namabulan = "Oktober"; break;
            case 11 : $namabulan = "November"; break;
            case 12 : $namabulan = "Desember"; break;

        }
        $tanggal_pengesahan = "Gura, ".$tgl." ".$namabulan." ".$tahun;


        $isisurat = $surat->isisurat;

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
        $kop = '<br><br><p style="text-align:center; font-family:Georgia, serif; font-size:12px;"><b><u>'.$surat->perihal.'</u></b></p>';
        $kop .= '<p style="text-align:center; font-family:Georgia, serif; font-size:12px;">Nomor : 000/'.$surat->nomorsurat.'/Bln/Tahun</p>';
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
        $ttd .= $surat->kakisurat;
        $ttd .='</div>';


        $ttd = str_replace('!!ttd_pengesahan!!', $ttd_pengesahan, $ttd);
        $ttd=str_replace(array('!!nama_pengesahan!!', '!!jabatan_pengesahan!!', '!!tanggal_pengesahan!!'),
        array($nama_pengesah, $jabatan_pengesah, $tanggal_pengesahan), $ttd);

        $PDF->writeHTML($ttd, true, false, true, false, '');



        // $PDF->writeHTML($html, true, false, true, false, '');

        $PDF->Output('surat.pdf');

   }


    /* LIHAT Surat Approve*/
    public function lihatSuratApprove($id){

         $surat = DB::table('tb_approve_surat_keluar')
         ->join('tb_suratkeluar', 'tb_approve_surat_keluar.id_surat_keluar', '=', 'tb_suratkeluar.id')
        ->join('tb_formatsurat', 'tb_suratkeluar.idformatsurat', '=', 'tb_formatsurat.id')
        ->select('tb_approve_surat_keluar.no_surat_keluar as nosurat', 'tb_approve_surat_keluar.tgl_approve as tanggalapprove', 'tb_suratkeluar.perihal','tb_suratkeluar.file',
        'tb_suratkeluar.id as id_surat_keluar', 'tb_suratkeluar.nokk', 'tb_suratkeluar.nonik', 'tb_suratkeluar.isisurat as isisurat', 'tb_suratkeluar.kakisurat as kakisurat', 'tb_formatsurat.pengesahan as pengesahan')
        ->where('tb_approve_surat_keluar.id', '=', $id)
        ->first();

        // $FormatSurat = FormatSurat::find($id);
        // dd($surat);
        $InfoDesa =InfoDesa::first();

        $pengesahan = Pengesahan::where('id','=', $surat->pengesahan)->first();
        // dd($pengesahan->pengesahan);


        $KK = DB::table('tb_kk')->join('tb_penduduk', 'tb_kk.id_kk', '=', 'tb_penduduk.id')
        ->join('tb_agama', 'tb_penduduk.agama', '=', 'tb_agama.id')
        ->join('tb_pendidikan', 'tb_penduduk.pendidikan', '=', 'tb_pendidikan.id')
        ->join('tb_pekerjaan', 'tb_penduduk.pekerjaan', '=', 'tb_pekerjaan.id')
        ->select('tb_kk.id as id', 'tb_kk.nokk as nokk', 'tb_penduduk.nonik as nik_kk', 'tb_penduduk.namalengkap as nama_kk', 'tb_penduduk.jeniskelamin as jk_kk', 'tb_penduduk.status as status_kk',
                'tb_penduduk.tempatlahir as tempatlahir_kk', 'tb_penduduk.tanggallahir as tgllahir_kk', 'tb_penduduk.alamat as alamat_kk', 'tb_agama.agama as agama_kk',
                'tb_pendidikan.pendidikan as pendidikan_kk', 'tb_pekerjaan.pekerjaan as pekerjaan_kk')
        ->where('tb_kk.nokk', '=', $surat->nokk)
        ->first();
        // dd($KK);

        // $individu1 = Penduduk::where('id', $id)->first();
        $individu = DB::table('tb_penduduk')->join('tb_agama', 'tb_penduduk.agama', '=', 'tb_agama.id')
        ->join('tb_pendidikan', 'tb_penduduk.pendidikan', '=', 'tb_pendidikan.id')
        ->join('tb_pekerjaan', 'tb_penduduk.pekerjaan', '=', 'tb_pekerjaan.id')
        ->select('tb_penduduk.nonik as nik', 'tb_penduduk.namalengkap as namalengkap', 'tb_penduduk.jeniskelamin as jk', 'tb_penduduk.tempatlahir as tempatlahir', 'tb_penduduk.tanggallahir as tanggallahir', 'tb_penduduk.alamat as alamat',
        'tb_penduduk.status as status', 'tb_agama.agama as agama', 'tb_pendidikan.pendidikan as pendidikan', 'tb_pekerjaan.pekerjaan as pekerjaan')
        ->where('tb_penduduk.nonik', '=', $surat->nonik)
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

        $isisurat = $surat->isisurat;

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
        $kop = '<br><br><p style="text-align:center; font-family:Georgia, serif; font-size:12px;"><b><u>'.$surat->perihal.'</u></b></p>';
        $kop .= '<p style="text-align:center; font-family:Georgia, serif; font-size:12px;">Nomor : '.$surat->nosurat.'</p>';
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
        $ttd .= $surat->kakisurat;
        $ttd .='</div>';

        $ttd = str_replace('!!ttd_pengesahan!!', $ttd_pengesahan, $ttd);
        $ttd=str_replace(array('!!nama_pengesahan!!', '!!jabatan_pengesahan!!', '!!tanggal_pengesahan!!'),
        array($nama_pengesah, $jabatan_pengesah, "Gura, ".$surat->tanggalapprove), $ttd);

        $PDF->writeHTML($ttd, true, false, true, false, '');



        // $PDF->writeHTML($html, true, false, true, false, '');

        $PDF->Output('surat.pdf');

    }
}
