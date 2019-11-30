<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sales;
use App\Target;

use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $canvaser = DB::table('user')
        ->select('sales_id')
        ->get();

        $target_canvaser = DB::table('target')->where('category','Canvaser')->first();

        $data = DB::select('
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
                    userstatus_ao LIKE \'%Billing Completed%\'
            ) as total,
            user.nama as nama
        FROM
            sales, user
        WHERE
            id_canvaser LIKE \'%JKB%\' and 
            id_canvaser = user.sales_id and 
	        user.is_active = \'Y\'
        ORDER BY kode_canvaser, bulan
        ');

        //sort by active canvaser
        $max_ach = 0;
        $sorted_data = array();
        foreach ($data as $d) {
            foreach ($canvaser as $c) {
                if(strpos($c->sales_id,$d->kode_canvaser) !== false){
                    $sorted_data[$d->nama][$d->bulan] = $d->total;
                    if($d->total > $max_ach)
                        $max_ach = $d->total;                    
                }
            }            
        }
        
        $data_bulan_ini = DB::select('
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
                    DATE(billcompdate) = tanggal
            ) as total
        FROM
            sales, user
        WHERE
            id_canvaser LIKE \'%JKB%\' and 
            MONTH(billcompdate) = '.date('m').'  and 
            user.is_active = \'Y\'
        ORDER BY tanggal, kode_canvaser
        ');

        //sort by active canvaser bulan ini
        $sorted_data_bulan = array();
        $sorted_data_harian = array();
        date_default_timezone_set('Asia/Jakarta');
        $total_current_ach = 0;
        foreach ($data_bulan_ini as $d) {
            foreach ($canvaser as $c) {
                if(strpos($c->sales_id,$d->kode_canvaser) !== false){
                    $sorted_data_bulan[$c->sales_id][str_replace("-","",$d->tanggal)] = $d->total;
                    $total_current_ach += $d->total;
                    if(date('Y-m-d', strtotime(date('Y-m-d'))) == $d->tanggal){
                        $sorted_data_harian[$c->sales_id] = $d->total;                        
                    }
                }                
            }                      
        }
        
        $list_canvaser = DB::select('
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
            user.nama
        FROM
            sales, user
        WHERE
            user.sales_id = sales.id_canvaser and
            MONTH(billcompdate) = '.date('m').'	and 
            user.is_active = \'Y\'
        ORDER BY total DESC
        ');
            
        $current_ach = Sales::where('userstatus_ao','LIKE','%Billing Completed%')
        ->where(DB::raw('MONTH(billcompdate)'),date('m'))
        ->count();

        // $current_target = Target::where('category','Total Bulanan')->first();
            
        $billcomp_tahun = DB::select('
        SELECT
            distinct MONTH(billcompdate) as bulan,
            (
                SELECT 
                    COUNT(*) 
                FROM
                    sales 
                WHERE
                    createdon_quo >= \'2019-01-01\' and 
                    MONTH(createdon_quo) = bulan
            ) as sales,
            (
                SELECT 
                    COUNT(*) 
                FROM 
                    sales 
                WHERE 
                    MONTH(billcompdate) = bulan and 
                    billcompdate >=  \'2019-01-01\' 
            ) as realisasi,
            (
                SELECT 
                    COUNT(*) 
                FROM 
                    sales 
                WHERE 
                    MONTH(billcompdate) = bulan and 
                    MONTH(createdon_quo) = MONTH(billcompdate) and
                    billcompdate >=  \'2019-01-01\' 
            ) as realisasi_current
        FROM
            sales        
        ORDER BY
            bulan
        ');

        $target_bulanan = Target::where('Category','Total Bulanan')
        ->where('tahun',date('Y'))
        ->get();

        return view("dashboard")        
        ->with('data',$sorted_data)
        ->with('max_data',$max_ach)
        ->with('data_bulan',$sorted_data_bulan)
        ->with('total_data_current',$total_current_ach)
        ->with('data_harian',$sorted_data_harian)
        ->with('target_canvaser',$target_canvaser)
        ->with('list_canvaser',$list_canvaser)
        ->with('current_ach',$current_ach)        
        ->with('target_bulanan',$target_bulanan)
        ->with('billcomp', $billcomp_tahun);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
