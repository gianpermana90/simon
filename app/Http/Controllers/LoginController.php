<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Users;
use App\Providers\UrlManagement;

use Response;
use Auth;

class LoginController extends Controller
{

    public function index()
    {
        if (Session::get('login')){
            if(Session::get('user_data')->role == "Admin"){
                return redirect(UrlManagement::admin_dashboard);
            }else{
                return redirect(UrlManagement::user_profile);
            }
        }else{
            return view('login');
        }        
    }    

    public function logout(){
        Session::flush();
        return redirect(UrlManagement::index);
    }

    public function process(Request $request)
    {
        $email = $request->email;
        $pass = $request->password;

        $data = Users::where('email',$email)->first();
        if($data){
            if ($pass == $data->password) {
                
                Session::put('user_data',$data);                
                Session::put('login',TRUE);

                $response = [
                    'status'=>'success',
                    'icon'=>'success',
                    'message'=>'Login Berhasil'
                ];
            }else{
                $response = [
                    'status'=>'error',
                    'icon'=>'error',
                    'message'=>'Password salah'
                ];                
            }
        }else{
            $response = [
                'status'=>'error',
                'icon'=>'error',
                'message'=>'Email tidak terdaftar'
            ];            
        }

        return Response::json($response);
    }
}
