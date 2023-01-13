<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class LandingPageController extends Controller
{
       /* DATATABLE SuratKeluar*/
       public function getCekSuratKeluarApprove($nik){

        $penduduk = DB::table('tb_penduduk')->select('nonik', 'namalengkap')->where('nonik', '=', $nik)->first();

        $approvesurat = DB::table('tb_suratkeluar')->join('tb_penduduk', 'tb_suratkeluar.nonik', '=', 'tb_penduduk.nonik')
        ->join('tb_approve_surat_keluar', 'tb_approve_surat_keluar.id_surat_keluar', '=', 'tb_suratkeluar.id')
        ->select('tb_suratkeluar.*', 'tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap','tb_approve_surat_keluar.id as idapprove', 'tb_approve_surat_keluar.*')
        ->where('tb_suratkeluar.approve', '=', '1')->where('tb_suratkeluar.nonik','=',$nik)
        ->get();

        // dd($approvesurat);



        $permohonansurat = DB::table('tb_permohonansurat')
        ->select('tb_permohonansurat.id as id','tb_permohonansurat.nikpemohon as nikpemohon', 'tb_permohonansurat.namapemohon as namapemohon','tb_permohonansurat.keperluansurat as keperluansurat', 'tb_permohonansurat.statussurat as statussurat', 'tb_permohonansurat.created_at as tanggal')
        ->Where('tb_permohonansurat.nikpemohon', '=', $nik)
        ->get();

        // dd($permohonansurat);

        return view('landingpage.suratkeluar',[
            'Nik'=> $penduduk->nonik,
            'NamaLengkap' => $penduduk->namalengkap,
            'PermohonanSurat' => $permohonansurat,
            'SuratKeluar' => $approvesurat
        ]);

    }
}
