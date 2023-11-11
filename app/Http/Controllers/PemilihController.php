<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\VwPemilihDetail;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class PemilihController extends Controller
{

    /* DATATABLE Pemilih By TIM*/
    public function getTabelPemilihByTim($id_pallawa, $id_patappa){
        if ($id_pallawa == 0 && $id_patappa == 0) {
            $Pemilih = VwPemilihDetail::all();
        } else if ($id_pallawa != 0 && $id_patappa == 0) {
            $Pemilih = VwPemilihDetail::Where('id_pallawa', $id_pallawa)->get();
        } else if ($id_pallawa != 0 && $id_patappa != 0){
            $Pemilih = VwPemilihDetail::where('id_patappa', $id_patappa)->Where('id_pallawa', $id_pallawa)->get();
        }

        return DataTables()->of($Pemilih)
        ->addColumn('pemilih', function($data){
            $link = '<b>' . strtoupper($data->nik) . ' - ' . strtoupper($data->nama) . '</b>';
            return $link;
        })
        ->addColumn('tps', function($data){
            $link = '<b>'.$data->tps.'</b><br> <i>Kec. '.$data->kecamatan.'</i>';
            return $link;
        })
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="detail_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-warning">
            &nbsp<i class="fa fa-envelope-open"></i>  Detail Data&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .= '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="update_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
            &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
            $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['tps','pemilih','aksi'])
        // ->parameters([
        //     'buttons' => ['excel'],
        // ])
        ->make(true);
    }

        /* DATATABLE Pemilih By TPS*/
        public function getTabelPemilihByTps($id_kec, $id_kel, $id_tps){
            if ($id_kec == 0 && $id_kel == 0 && $id_tps == 0) {
                $Pemilih = VwPemilihDetail::all();
            } else if ($id_kec != 0 && $id_kel == 0) {
                $Pemilih = VwPemilihDetail::Where('id_kecamatan', $id_kec)->get();
            } else if ($id_kec != 0 && $id_kel != 0 && $id_tps == 0){
                $Pemilih = VwPemilihDetail::where('id_kelurahan', $id_kel)->Where('id_kecamatan', $id_kec)->get();
            } else if ($id_kec != 0 && $id_kel != 0 && $id_tps != 0){
                $Pemilih = VwPemilihDetail::where('id_kelurahan', $id_kel)->Where('id_kecamatan', $id_kec)->Where('id_tps', $id_tps)->get();
            } else if ($id_kec == 0 && $id_kel == 0 && $id_tps !=0){
                $Pemilih = VwPemilihDetail::where('id_tps', $id_tps)->get();
            }
            return DataTables()->of($Pemilih)
            ->addColumn('pemilih', function($data){
                $link = '<b>' . strtoupper($data->nik) . ' - ' . strtoupper($data->nama) . '</b>';
                return $link;
            })
            ->addColumn('tps', function($data){
                $link = '<b>'.$data->tps.'</b><br> <i>Kec. '.$data->kecamatan.'</i>';
                return $link;
            })
            ->addColumn('aksi', function($data){
                $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="detail_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-warning">
                &nbsp<i class="fa fa-envelope-open"></i>  Detail Data&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
                $link .= '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="update_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
                &nbsp<i class="fas fa-edit"></i>  Update&nbsp&nbsp  </a>';
                $link .= '&nbsp&nbsp</div>';
                $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
                id="delete_pemilih_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
                &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
                $link .= '&nbsp</div>';
                return $link;
            })
            ->addIndexColumn()
            ->rawColumns(['tps','pemilih','aksi'])
            ->make(true);
        }


    public function getPemilihByTim($id_pallawa, $id_patappa){
        if ($id_pallawa == 0 && $id_patappa == 0) {
            $Pemilih = VwPemilihDetail::all();
        } else if ($id_pallawa != 0 && $id_patappa == 0) {
            $Pemilih = VwPemilihDetail::Where('id_pallawa', $id_pallawa)->get();
        } else if ($id_pallawa != 0 && $id_patappa != 0){
            $Pemilih = VwPemilihDetail::where('id_patappa', $id_patappa)->Where('id_pallawa', $id_pallawa)->get();
        }
        return $Pemilih;
    }

    // GET COUNT PEMILIH BY PALLAWA PATAPPA  GROUP TPS
    public function getTpsPemilihByTim($id_pallawa, $id_patappa){
        if ($id_pallawa == 0 && $id_patappa == 0) {
            $Pemilih = VwTps::all();
        } else if ($id_pallawa != 0 && $id_patappa == 0) {
            $Pemilih = DB::select('CALL CountPemilihByPallawa(?)', array($id_pallawa));
        } else if ($id_pallawa != 0 && $id_patappa != 0){
            $Pemilih = DB::select('CALL CountPemilihByPallawaAndPatappa(?,?)', array($id_pallawa, $id_patappa));
        }
        return $Pemilih;
    }

    /* GET ALL Pemilih */
    public function getAllPemilih(){
        return Pemilih::all();
    }

    /* GET A Pemilih BY ID */
    public function getPemilihById($id){
        return Pemilih::where('id', $id)->first();
    }

    /* GET A Pemilih BY ID KECAMATAN */
    public function getPemilihByIdKelurahan($id_kec){
        if ($id_kec = 0) {
            return VwPemilihDetail::all();
        } else {
            return VwPemilihDetail::where('id_patappa', $id_kec)->get();
        }
    }

    /* INSERT Pemilih */
    public function tambahPemilih(Request $req){
        $Pemilih = new Pemilih;
        $Pemilih->pallawa_id = $req->pallawa;
        $Pemilih->nama_pemilih = $req->pemilih;
            if($Pemilih->save()){
                return response()->json([
                    'status' => 'success',
                    'pemilih' => $Pemilih->nama_pemilih
                ]);
            }else {
                return response()->json([
                    'status'=>'failed',
                    'pemilih'=>$Pemilih->nama_pemilih
                ]);
            }
    }

    /* UPDATE Pemilih */
    public function updatePemilih(Request $req){
        $Pemilih = Pemilih::where('id', $req->id)->first();
        $Pemilih->pallawa_id = $req->pallawa;
        $Pemilih->nama_pemilih= $req->pemilih;
        if( $Pemilih->save()){
            return response()->json([
                'status' => 'success',
                'pemilih' =>  $Pemilih->nama_pemilih
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'pemilih'=> $Pemilih->nama_pemilih
            ]);
        }
    }

    /* DELETE Pemilih */
    public function hapusPemilih($id){
        $Pemilih = Pemilih::find($id);
        if($Pemilih!=null){
            $del=$Pemilih->delete();
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
