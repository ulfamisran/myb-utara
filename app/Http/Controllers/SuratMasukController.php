<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SuratMasuk;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class SuratMasukController extends Controller
{
    /* DATATABLE SuratMasuk*/
    public function getTabelSuratMasuk(){ 
        return DataTables()->of(SuratMasuk::all())
        ->addColumn('file', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="/suratmasuk/'.$data->filesurat.'" target="_blank"
             id="detail_suratmasuk_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
             &nbsp<i class="fas fa-search"></i>  Lihat  File&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="update_suratmasuk_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_suratmasuk_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['file','aksi'])
        ->make(true);
    }

    /* GET ALL SuratMasuk */
    public function getAllSuratMasuk(){
        return SuratMasuk::all();
    }

    /* GET A SuratMasuk BY ID */
    public function getSuratMasukById($id){
        return SuratMasuk::where('id', $id)->first();
    }

    /* GET A SuratMasuk BY NIK */
    public function getSuratMasukByNik($nik){
        return SuratMasuk::where('nonik', $nik)->first();
    }

    /* INSERT SuratMasuk */
    public function tambahSuratMasuk(Request $req){
        $validator = Validator::make($req->all(), [
            'tanggalmasuk' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'filesurat' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->passes()) {
            $filesurat = $req->file('filesurat');
            $filename =  "file" . time().".".$filesurat->getClientOriginalExtension(); 
            $req->file('filesurat')->move(public_path('suratmasuk/'), $filename); 

            $SuratMasuk = new SuratMasuk;
            $SuratMasuk->tanggalmasuk = $req->tanggalmasuk;
            $SuratMasuk->pengirim = $req->pengirim;
            $SuratMasuk->perihal = $req->perihal;
            $SuratMasuk->filesurat = $filename;

            if($SuratMasuk->save()){
                return response()->json([
                    'status' => 'success',
                    'suratmasuk' => $SuratMasuk->perihal
                ]);
            }else {
                return response()->json([
                    'status'=>'failed',
                    'suratmasuk'=>$SuratMasuk->perihal
                ]);
            }
        }
        

    }

    /* UPDATE SuratMasuk */
    public function updateSuratMasuk(Request $req){
        $SuratMasuk = SuratMasuk::where('id', $req->id)->first();
        $SuratMasuk->tanggalmasuk = $req->tanggalmasuk;
        $SuratMasuk->pengirim = $req->pengirim;
        $SuratMasuk->perihal = $req->perihal;
        $SuratMasuk->filesurat= "tes";
        if( $SuratMasuk->save()){
            return response()->json([
                'status' => 'success',
                'suratmasuk' =>  $SuratMasuk->namalengkap
            ]);
        }else {
            return response()->json([
                'status' =>'failed',
                'suratmasuk'=> $SuratMasuk->namalengkap
            ]);
        }
    }

    /* DELETE SuratMasuk */
    public function hapusSuratMasuk($id){
        $SuratMasuk = SuratMasuk::find($id); 
        if($SuratMasuk!=null){
            $del=$SuratMasuk->delete();
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
