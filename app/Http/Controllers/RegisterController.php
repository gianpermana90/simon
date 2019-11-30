<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;

use Validator;
use Response;

class RegisterController extends Controller
{    
    public function index()
    {
        return view("register");
    }

    public function addUser(Request $request){
        
        $user = Users::where('email',$request->email)->first();
        if($user){
            $response = [
                'status'=>'error',
                'icon'=>'error',
                'message'=>'Email telah terdaftar'
            ];
            return Response::json($response);
        }

        $user = Users::where('sales_id',$request->sales_id)->first();
        if($user){
            $response = [
                'status'=>'error',
                'icon'=>'error',
                'message'=>'Sales ID telah terdaftar'
            ];
            return Response::json($response);
        }
        
        $user = new Users();
        $user->nama     = $request->nama;
        $user->sales_id = $request->sales_id;
        $user->lahir    = $request->lahir;
        $user->hp       = $request->hp;
        $user->alamat   = $request->alamat;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->id_witel = "Jakarta Barat";
        $user->role     = "User";        

        if ($user->save()) {
            $response = [
                'status'=>'success',
                'icon'=>'success',
                'message'=>'Data berhasil disimpan'
            ];
        }else{
            $response = [
                'status'=>'error',
                'icon'=>'error',
                'message'=>'Gagal menyimpan data'
            ];
        }   
        return Response::json($response);
    }

    public function deleteUser(Request $request){
        $sales_id = $request->sales_id;

        $user = Users::where('sales_id',$sales_id)->first();
        if($user){
            if($user->delete()){
                $response = [
                    'status'=>'success',
                    'icon'=>'success',
                    'message'=>'Data berhasil dihapus'
                ];
            }else{
                $response = [
                    'status'=>'error',
                    'icon'=>'error',
                    'message'=>'Gagal menghapus data'
                ];
            }            
        }else{
            $response = [
                'status'=>'error',
                'icon'=>'error',
                'message'=>'Kode Sales tidak ditemukan'
            ];
        }        
        return Response::json($response);
    }
}
