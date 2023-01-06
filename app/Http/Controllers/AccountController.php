<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Response;
use DataTables;
use DB;

class AccountController extends Controller
{
    /* DATATABLE MASTER USER */
    public function getTabelAccount(){
        return DataTables()->of(Account::all())
        ->addColumn('aksi', function($data){
            $link = '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
             id="reset_account_btn" data_id="'.$data->id.'"class="btn-xs btn-success">
             &nbsp<i class="fas fa-edit"></i>  Reset&nbsp&nbsp  </a>';
            $link .= '&nbsp&nbsp</div>';
            $link .=  '<div class="btn-group"><a style=text-decoration:none; href="javascript:void(0);"
            id="delete_account_btn" data_id="'.$data->id.'"class="btn-xs btn-danger">
            &nbsp<i class="fas fa-trash"></i>  Delete&nbsp&nbsp  </a>';
           $link .= '&nbsp</div>';
            return $link;
        })
        ->addIndexColumn()
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /* GET ALL MASTER USER */
    public function getAllAccount(){
        return Account::all();
    }

    /* GET A MASTER USER BY ID */
    public function getAccount($id){
        return Account::where('id', $id)->first();
    }

    /* INSERT MASTER USER */
    public function insertAccount(Request $req){

        $Account = new Account;
        $Account->nama = $req->nama;
        $Account->email = $req->email;
        $Account->password = Hash::make($req->password);
        $Account->level = 1;

         if($Account->save()){
             return response()->json([
                 'status' => 'success',
                 'data' => $req->email
             ]);
         }else {
             return response()->json([
                 'status'=>'failed',
                 'data'=>$req->email
             ]);
         }
    }

    /* UPDATE MASTER USER */
    public function updateAccount(Request $req){
        $id = $req->id;

        $Account = Account::where('id', $id)->first();
        $Account->nama = $req->nama;
        $Account->email = $req->email;
        $Account->password = Hash::make($req->password);
        $Account->level = 1;


        if($Account->save()){
            return response()->json([
                'status' => 'success',
                'data' => $Account->master_user
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'data'=>$Account->master_user
            ]);
        }

    }

    /* DELETE MASTER USER */
    public function deleteAccount($id){
        $Account = Account::find($id);
        if($Account!=null){
            $del=$Account->delete();
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'failed'
            ]);

        }

    }

     /* RESET Account */
     public function resetAccount($id){
        $Account = Account::find($id);
        $Account->password = Hash::make($Account->email);
        if($Account->save()){
            return response()->json([
                'status' => 'success',
                'akun' => $Account->name
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'akun'=>$Account->name
            ]);
        }
    }

     /* Update Password */
     public function updatePassword(Request $req){
        $user = Account::find($req->id);


        if (!Hash::check($req->lastpass, $user->password)){
             return response()->json([
                    'error' => 'Password Salah !'
                ]);
        }
        if(strcmp($req->lastpass, $req->newpass)==0){
            return response()->json([
                'error' => 'Password Baru Tidak Boleh Sama Dengan Password Lama !'
            ]);
        }

        $user->password=Hash::make($req->newpass);
        // $user->save();
        if($user->save()){
            return response()->json([
                'status' => 'success',
                'akun' => $user->name
            ]);
        }else {
            return response()->json([
                'status'=>'failed',
                'akun'=>$user->name
            ]);
        }

    }




}
