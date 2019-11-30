<?php
    $kc = $_GET['kc'];
?>

@extends('layout.main')

@section('content-header')
Canvaser Analytics
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> </h4>
                <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    Trend Sales & BC Per Canvaser
                </h3>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-default float-right" id="daterange-btn">
                        <i class="far fa-calendar-alt"></i> Date range picker
                        <i class="fas fa-caret-down"></i>
                    </button> -->                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" onClick="setChartBC(salesBCDataTahun,'Tahun')" class="dropdown-item set-range">Tahun</a>
                            <a href="#" onClick="setChartBC(salesBCDataBulan,'Bulan')" class="dropdown-item set-range active">Bulan</a>
                            <a href="#" onClick="setChartBC(salesBCDataMinggu,'Minggu')" class="dropdown-item set-range">Minggu</a>
                            <!-- <a class="dropdown-divider"></a> -->
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">

                    <div class="col-md-8">                        
                        <div class="chart">
                            <!-- <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">820</span>
                                    <span>Visitors Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span class="text-muted">Since last week</span>
                                </p>
                            </div> -->

                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="335"></canvas>
                            </div>                            
                        </div>
                    </div>                                        
                    <?php
                    $achievement = 0;
                    $s = date('Y-m-d', strtotime("-7 day", strtotime('now')));
                    $e = date('Y-m-d');
                    while (strtotime($s) <= strtotime($e)) {
                        foreach ($monthly_data_bc as $mbc) {
                            if($mbc->tanggal == $s){
                                $achievement += $mbc->total;
                            }
                        }
                        $s = date ("Y-m-d", strtotime("+1 day", strtotime($s)));
                    }

                    if($target_canvaser->target != 0)
                        $achievement = number_format(($achievement/7)*100);

                    if ($achievement >= 100) {
                        $status = "green";
                    }else if ($achievement < 100 && $achievement>=75) {
                        $status = "blue";
                    }else if ($achievement < 75 && $achievement>= 30) {
                        $status = "yellow";
                    }else{
                        $status = "red";
                    }

                    ?>

                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-gradient-{{$status}}">
                            <div class="card-header text-muted border-bottom-0" style="color:white !important">
                                {{$user->sales_id}}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h4 class="mb-4"><b>{{$user->nama}}</b></h4>
                                        <!-- <p class="text-muted text-sm" style="color:white !important">
                                            <b>Kode : </b> {{$user->sales_id}}
                                        </p> -->
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small m-2" style="color:white !important"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                {{$user->alamat}}
                                            </li>
                                            <li class="small m-2" style="color:white !important"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                {{$user->hp}}
                                            </li>
                                            <li class="small m-2" style="color:white !important"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span>
                                                {{$user->lahir}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">                                        
                                        <img src="assets/dist/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right" style="text-align:center !important">
                                    <h5>                                    
                                        Weekly Performance : 
                                            @if($achievement >= 100)
                                            <i class="fas fa-lg fa-laugh-beam"></i>
                                            @elseif($achievement < 100 && $achievement>=75)
                                            <i class="fas fa-lg fa-smile-beam"></i>
                                            @elseif($achievement < 75 && $achievement>= 30)
                                            <i class="fas fa-lg fa-grin-beam-sweat"></i>
                                            @else
                                            <i class="fas fa-lg fa-frown"></i>
                                            @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>                              

                </div>
            </div>
            
            <!-- <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">25</h5>
                            <span class="description-text">SALES BULAN LALU</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                0%</span>
                            <h5 class="description-header">12</h5>
                            <span class="description-text">BILLCOMP BULAN LALU</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                            <h5 class="description-header">3</h5>
                            <span class="description-text">SALES HARIAN</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                18%</span>
                            <h5 class="description-header">2</h5>
                            <span class="description-text">BILLCOMP HARIAN</span>
                        </div>
                    </div>
                </div>
            </div>             -->
        </div>
    </div>
</div>

@endsection

@section('additional-script')
    @include('scripts.s_analytic_canvaser')
@endsection