<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Target;

use DB;

class AnalyticsController extends Controller
{
    
    public function canvaserAnalytic(Request $request)
    {
        $kode_canvaser = $request->kc;        

        $yearly_data = DB::select('
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
                        MONTH(billcompdate) = bulan and 
                        MONTH(createdon_quo) = MONTH(billcompdate) and
                        userstatus_ao LIKE \'%Billing Completed%\'
            ) as bc,
            (
                SELECT 
                        COUNT(MONTH(createdon_quo)) 
                FROM 
                        sales 
                WHERE 
                        id_canvaser = kode_canvaser and 
                        MONTH(createdon_quo) = bulan  
            ) as sales,
            user.nama as nama
        FROM
            sales, user
        WHERE
            id_canvaser = \''.$kode_canvaser.'\' and 
            id_canvaser = user.sales_id and 
            user.is_active = \'Y\'
        ORDER BY kode_canvaser, bulan
        ');

        $monthly_data_bc = DB::select('
        SELECT	
            DISTINCT DATE(billcompdate) as tanggal,
            id_canvaser as kode_canvaser,
            (
                SELECT 
                    COUNT(DATE(billcompdate)) 
                FROM 
                    sales 
                WHERE 
                    id_canvaser = kode_canvaser and 
                    DATE(billcompdate) = tanggal and
                    MONTH(createdon_quo) = MONTH(billcompdate)
            ) as total
        FROM
            sales, user
        WHERE
            id_canvaser = \''.$kode_canvaser.'\' and 
            MONTH(billcompdate) = '.date('m').' and 
            user.is_active = \'Y\'
        ORDER BY tanggal, kode_canvaser
        ');

        $monthly_data_sales = DB::select('
        SELECT	
            DISTINCT DATE(createdon_quo) as tanggal,
            id_canvaser as kode_canvaser,
            (
                SELECT 
                    COUNT(DATE(createdon_quo)) 
                FROM 
                    sales 
                WHERE 
                    id_canvaser = kode_canvaser and 
                    DATE(createdon_quo) = tanggal
            ) as total
        FROM
            sales, user
        WHERE
            id_canvaser = \''.$kode_canvaser.'\' and 
            MONTH(createdon_quo) = '.date('m').' and 
            user.is_active = \'Y\'
        ORDER BY tanggal, kode_canvaser
        ');        
        
        $target_canvaser = Target::where('category','Canvaser')->first();

        $user_data = Users::where('sales_id',$kode_canvaser)->first();

        return view("analytic_canvaser")
        ->with('yearly_data',$yearly_data)
        ->with('monthly_data_bc',$monthly_data_bc)
        ->with('monthly_data_sales',$monthly_data_sales)
        ->with('target_canvaser',$target_canvaser)
        ->with('user',$user_data);
    }

}
