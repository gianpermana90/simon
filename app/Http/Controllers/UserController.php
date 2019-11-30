<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Providers\UrlManagement;

use App\Users;
use App\Target;

use DB;
use Response;
use Auth;

class UserController extends Controller
{

    public function index()
    {
        if (!Session::get('login')){                    
            return redirect(UrlManagement::index);
        }

        $sales_id = Session::get('user_data')->sales_id;
        $data = Users::where('sales_id',$sales_id)->first();
        
        return view('user_profile')
        ->with('data', $data);
    }

    public function listUsers()
    {
        $list_users = DB::select('
        SELECT	
            DISTINCT MONTH(billcompdate) as bulan,
            id_canvaser as kode_canvaser,
            (
                SELECT 
                    COUNT(MONTH(billcompdate)) 
                FROM 
                    sales 
                WHERE 
                    id_canvaser = kode_canvaser and 
                    MONTH(billcompdate) = bulan			
            ) as total,
            (
                SELECT 
                    COUNT(MONTH(createdon_quo)) 
                FROM 
                    sales 
                WHERE 
                    id_canvaser = kode_canvaser and 
                    MONTH(createdon_quo) = bulan			
            ) as sales,
            user.nama
        FROM
            sales, user
        WHERE
            user.sales_id = sales.id_canvaser and
            MONTH(billcompdate) = '.date('m').'	
        ORDER BY total DESC
        ');

        $users = Users::where('role','User')->get();

        foreach ($users as $user) {
            $user->total = 0;
            $user->sales = 0;
            foreach ($list_users as $list) {
                if($user->sales_id == $list->kode_canvaser){
                    $user->total = $list->total; 
                    $user->sales = $list->sales;                   
                }
            }
        }

        $target = Target::where('category','Canvaser')->first();
        
        return view("user_list")
        ->with('users',$users)
        ->with('target',$target);
    }
}
