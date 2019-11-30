<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Target;

use DB;
use Response;

class DataController extends Controller
{
    public function insertData(Request $request)
    {                          
        // Update Billcomp Canvaser                
        $decoded_data = json_decode(stripslashes($request->data_object));
        foreach ($decoded_data as $data){  
            $sales = Sales::where('nsorder_quo',$data->nsorder_quo)
                ->where('name_sold',$data->name_sold)
                ->first();

            if($sales == null)
                $sales = new Sales();

            $sales->nsorder_quo                 = $data->nsorder_quo;
            $sales->createdon_quo               = date("Y-m-d h:m:s",strtotime($data->createdon_quo));
            $sales->umur_createdon_quo          = $data->umur_createdon_quo;
            $sales->userstatus_quo              = $data->userstatus_quo;

            $sales->nsorder_ao                  = $data->nsorder_ao;
            $sales->createdon_ao                = date("Y-m-d h:m:s",strtotime($data->createdon_ao));
            $sales->umur_createdon_ao           = $data->umur_createdon_ao;
            $sales->userstatus_ao               = $data->userstatus_ao;

            $sales->sid                         = $data->sid;

            $sales->sotp_no                     = $data->sotp_no;
            $sales->nipnas                      = $data->nipnas;
            $sales->name_sold                   = $data->name_sold;
            $sales->region_sotp                 = $data->region_sotp;
            $sales->segmen_sotp                 = $data->segmen_sotp;

            $sales->shtp                        = $data->shtp;
            $sales->name_shtp                   = $data->name_shtp;
            $sales->region_shtp                 = $data->region_shtp;

            $sales->accountnas                  = $data->accountnas;
            $sales->productid                   = $data->productid;

            $sales->sero_id_fs                  = $data->sero_id_fs;
            $sales->status_abbreviation_fs      = $data->status_abbreviation_fs;
            $sales->status_date_fs              = date("Y-m-d",strtotime($data->status_date_fs));
            $sales->umur_status_date_fs         = $data->umur_status_date_fs;

            $sales->sero_id_prov                = $data->sero_id_prov;
            $sales->status_abbreviation_prov    = $data->status_abbreviation_prov;
            $sales->status_date_prov            = date("Y-m-d",strtotime($data->status_date_prov));

            $sales->witel                       = $data->witel;
            $sales->skema_bisnis                = $data->skema_bisnis;
            $sales->groupstatus_tenoss          = $data->groupstatus_tenoss;
            $sales->ubis                        = $data->ubis;
            $sales->groupstatus                 = $data->groupstatus;
            $sales->reg_id                      = $data->reg_id;

            $sales->projectname_prov            = $data->projectname_prov;
            $sales->projectname_fs              = $data->projectname_fs;
            $sales->amount_price                = $data->amount_price;
            $sales->jml_ap_attr                 = $data->jml_ap_attr;
            $sales->billcompdate                = date("Y-m-d",strtotime($data->billcompdate));
            $sales->group_ubis                  = $data->group_ubis;

            $sales->task_name                   = $data->task_name;
            $sales->task_name_date              = date("Y-m-d",strtotime($data->task_name_date));
            $sales->tgl_pcom_ao                 = date("Y-m-d h:m:s",strtotime($data->createdon_ao));

            $sales->kcontact                    = $data->kcontact;

            $sales->ap_status                   = $data->ap_status;
            $sales->partner_name                = $data->partner_name;
            $sales->loc_id                      = $data->loc_id;

            $sales->durasi_fs_closed            = $data->durasi_fs_closed;
            $sales->durasi_ao_closed            = $data->durasi_ao_closed;
            $sales->durasi_order_closed         = $data->durasi_order_closed;

            $sales->id_canvaser                 = $data->id_canvaser;

            $sales->save();         
        }        

        //Update Curent Month Target
        $startdate = date('Y-m-01');
        $enddate = date('Y-m-d');

        // $startdate = substr($startdate,0,4);        
        $realisasi = Sales::where('billcompdate','>=',$startdate)
            ->where('billcompdate','<=',$enddate)
            ->get()
            ->count();

        $target = Target::where('bulan',date('m'))->where('tahun',date('Y'))->first();
        if($target == null)
            $target = new Target();

        $target->category = 'Total Bulanan';
        $target->real = $realisasi;
        $target->bulan = date('m');
        $target->tahun = date('Y');
        $result_target = $target->save(); 

        $response = [
            'status'=>'SUCCESS',
            'icon'=>'success',
        ];
        return Response::json($response);
    }    

    public function setTargetCanvaser(Request $request)
    {
        $target_canvaser = $request->target_data;

        $result = DB::table('target')
            ->where('category', "Canvaser")
            ->update(['target' => $target_canvaser]);       
            
        $response = [
            'status'=>'SUCCESS',
            'icon'=>'success',            
        ];
        return Response::json($response);
    }

    public function setTargetCurrentMonth(Request $request)
    {
        $target_month = Target::where('bulan',date('m'))->where('tahun',date('Y'))->first();

        if($target_month == null)
            $target_month = new Target();
            
        $target_month->category = 'Total Bulanan';
        $target_month->target = $request->target_data;
        $target_month->bulan = date('m');
        $target_month->tahun = date('Y');
        
        if($target_month->save()){
            $response = [
                'status'=>'SUCCESS',
                'icon'=>'success',
                'data'=>$target_month
            ];
        }else{
            $response = [
                'status'=>'ERROR',
                'icon'=>'error',            
            ];
        }
        return Response::json($response);
    }

}