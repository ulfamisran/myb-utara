<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SuratKeluar;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class SuratKeluarController extends Controller
{
    /* DATATABLE SuratKeluar*/
    public function getTabelSuratKeluar(){ 
        return DataTables()->of(SuratKeluar::all())
        ->addColumn('file', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="/suratkeluar/'.$data->filesurat.'" target="_blank"
             id="detail_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
             &nbsp<i class="fas fa-search"></i>  Lihat  File&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            return $link;
        })
        ->addColumn('status', function($data){
            if($data->approve == 0){
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="update_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-edit"></i>  Belum Approve&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
            }else{
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="update_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
                &nbsp<i class="fas fa-edit"></i>  Surat Terapprove&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>'; 
           }

            return $link;
        })
        ->addColumn('aksi', function($data){
            if($data->approve == 0){
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="update_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
                &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
                $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="delete_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
                $link .= '&nbsp</div>';
                $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="approve_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
                &nbsp<i class="fas fa-trash"></i>  Approve&nbsp&nbsp  </a>';
                $link .= '&nbsp</div>';
            }else{
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="update_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
                &nbsp<i class="fas fa-edit"></i>  Surat Terapprove&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>'; 
           }

            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['file','status','aksi'])
        ->make(true);
    }

    /* GET ALL SuratKeluar */
    public function getAllSuratKeluar(){
        return SuratKeluar::all();
    }

    /* GET A SuratKeluar BY ID */
    public function getSuratKeluarById($id){
        return SuratKeluar::where('id', $id)->first();
    }

    /* GET A SuratKeluar BY NIK */
    public function getSuratKeluarByNik($nik){
        return SuratKeluar::where('nonik', $nik)->first();
    }

    /* INSERT SuratKeluar */
    public function tambahSuratKeluar(Request $req){
        $validator = Validator::make($req->all(), [
            'tanggalmasuk' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'filesurat' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->passes()) {
            $filesurat = $req->file('filesurat');
            $filename =  "file" . time().".".$filesurat->getClientOriginalExtension(); 
            $req->file('filesurat')->move(public_path('suratkeluar/'), $filename); 

            $SuratKeluar = new SuratKeluar;
            $SuratKeluar->tanggalmasuk = $req->tanggalmasuk;
            $SuratKeluar->pengirim = $req->pengirim;
            $SuratKeluar->perihal = $req->perihal;
            $SuratKeluar->filesurat = $filename;

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

    /* UPDATE SuratKeluar */
    public function updateSuratKeluar(Request $req){
        $SuratKeluar = SuratKeluar::where('id', $req->id)->first();
        $SuratKeluar->tanggalmasuk = $req->tanggalmasuk;
        $SuratKeluar->pengirim = $req->pengirim;
        $SuratKeluar->perihal = $req->perihal;
        $SuratKeluar->filesurat= "tes";
        if( $SuratKeluar->save()){
            return response()->json([
                'status' => 'success',
                'suratkeluar' =>  $SuratKeluar->namalengkap
            ]);
        }else {
            return response()->json([
                'status' =>'failed',
                'suratkeluar'=> $SuratKeluar->namalengkap
            ]);
        }
    }

    /* DELETE SuratKeluar */
    public function hapusSuratKeluar($id){
        $SuratKeluar = SuratKeluar::find($id); 
        if($SuratKeluar!=null){
            $del=$SuratKeluar->delete();
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
