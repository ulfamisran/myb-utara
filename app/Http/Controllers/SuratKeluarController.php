<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SuratKeluar;
use App\Models\ApproveSuratKeluar;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class SuratKeluarController extends Controller
{
    /* DATATABLE SuratKeluar*/


     /* DATATABLE SuratKeluar*/
     public function getTabelSuratKeluar(){
        $data = DB::table('tb_suratkeluar')->join('tb_penduduk', 'tb_suratkeluar.nonik', '=', 'tb_penduduk.nonik')
        ->select('tb_suratkeluar.*', 'tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap')
        ->where('tb_suratkeluar.approve', '=', '0')
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
        ->addColumn('status', function($data){
            if($data->approve == 0){
                $link = '<div class=""><span style=text-decoration:none; href=""
                id="" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-exclamation-circle"></i>  Belum Approve&nbsp&nbsp  </span>';
                $link .= '&nbsp&nbsp</div>';
            }else{
                $link = '<div class="btn-group"><span style=text-decoration:none; href=""
                id="" data_id="'.$data->id.'"class="btn-xs btn-success">
                &nbsp<i class="fas fa-edit"></i>  Surat Terapprove&nbsp&nbsp  </span>';
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
                $link .= '&nbsp&nbsp</div>';
                $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="approve_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
                &nbsp<i class="fas fa-check-circle"></i>  Approve&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
            }else{
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="" data_id="'.$data->id.'"class="btn-xs btn-success">
                &nbsp<i class="fas fa-edit"></i>  Surat Terapprove&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
            }

            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['nonik','file','status','aksi'])
        ->make(true);
    }

    /* DATATABLE SuratKeluar*/
    public function getTabelSuratKeluarApprove(){
        $data = DB::table('tb_suratkeluar')->join('tb_penduduk', 'tb_suratkeluar.nonik', '=', 'tb_penduduk.nonik')
        ->join('tb_approve_suratkeluar', 'tb_approve_suratkeluar.id_suratkeluar', '=', 'tb_suratkeluar.id')
        ->select('tb_suratkeluar.*', 'tb_penduduk.nonik as nonik', 'tb_penduduk.namalengkap as namalengkap', 'tb_approve_suratkeluar.nomorsurat as nomorsurat')
        ->where('tb_suratkeluar.approve', '=', '1')
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
        ->addColumn('status', function($data){
            if($data->approve == 0){
                $link = '<div class=""><span style=text-decoration:none; href=""
                id="" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-exclamation-circle"></i>  Belum Approve&nbsp&nbsp  </span>';
                $link .= '&nbsp&nbsp</div>';
            }else{
                $link = '<div class="btn-group"><a style=text-decoration:none; href=""
                id="" data_id="'.$data->id.'"class="btn-xs btn-success">
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
                $link .= '&nbsp</div>';
                $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="delete_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp&nbsp</div>';
                $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="approve_suratkeluar_btn" data_id="'.$data->id.'"class="btn-xs btn-primary">
                &nbsp<i class="fas fa-check-circle"></i>  Approve&nbsp&nbsp  </a>';
                $link .= '&nbsp</div>';
            }

            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['nonik','file','status','aksi'])
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

    public function approveSuratKeluar($idsuratkeluar){

        $SuratKeluar = SuratKeluar::where('id', $idsuratkeluar)->first();
        $SuratKeluar->approve = "1";
        if( $SuratKeluar->save()){
            $Approve = new ApproveSuratKeluar;
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



    /* UPDATE SuratKeluar */
    public function updateSuratKeluar(Request $req){
        $filesurat = $req->file('filesurat');
        $filename = "";
        if($filesurat!=null){
            $filename =  "file" . time().".".$filesurat->getClientOriginalExtension();
            $req->file('filesurat')->move(public_path('suratkeluar/'), $filename);
        }
        $SuratKeluar = SuratKeluar::where('id', $req->id)->first();
        $SuratKeluar->nomorsurat = $req->nosurat;
        $SuratKeluar->perihal = $req->perihalsurat;
        $SuratKeluar->nokk = $req->nokk;
        $SuratKeluar->nonik = $req->nonik;
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
