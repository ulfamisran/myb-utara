<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Auth;
use Alert;

class LoginController extends Controller
{
    public function cekLogin(Request $req){

        $username = $req->username;
        $pass = $req->password;

        if(Auth::attempt(['email'=> $username, 'password'=> $pass])){
            // if (Auth::user()->level==2){
            //     return response()->json([
            //         'status' => 'success'
            //     ]);
            // } else if (Auth::user()->level==1){
            //     return response()->json([
            //         'status' => 'success'
            //     ]);
            // } else {
            //     return response()->json([
            //         'status'=>'failed'
            //     ]);
            // }
            return response()->json([
                'status' => 'success'
            ]);

        }else {
            return response()->json([
                'status'=>'error',
            ]);
        }
    }

    public function logOut(){
        Auth::logout();
        return redirect ('/login');
    }

}
