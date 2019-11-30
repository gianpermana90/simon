<?php
    use App\Providers\UrlManagement;
?>

@extends('layout.main')

@section('content-header')
Sistem Monitoring Canvaser
@endsection

@section('content')
<div class="row">

    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    Trend BC Per Canvaser
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-atur-target">
                        <i class="fas fa-wrench"></i>
                    </button>                                            
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" onClick="setChartBC(TrendBCTahunData,'Tahun')" class="dropdown-item set-range active">Tahun</a>
                            <a href="#" onClick="setChartBC(TrendBCBulanData,'Bulan')" class="dropdown-item set-range">Bulan</a>
                            <a href="#" onClick="setChartBC(TrendBCMingguData,'Minggu')" class="dropdown-item set-range">Minggu</a>
                            <a href="#" onClick="setChartBC(TrendBCHarianData,'Harian')" class="dropdown-item set-range">Hari</a>
                            <!-- <a class="dropdown-divider"></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <!-- <p class="d-flex flex-column">
                        <span class="text-bold text-lg">{{$max_data}}</span>
                        <span>Pencapaian Tertinggi</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 0
                        </span>
                        <span class="text-muted">Pencapaian Bulan Lalu</span>
                    </p> -->
                </div>

                <div class="position-relative mb-4">
                    <canvas id="line-chart" height="395"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                   
                </div>
            </div>
        </div>
    </div>    

    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">                
                <h3 class="card-title">
                    <i class="fas fa-trophy mr-1"></i>
                    Ranking Canvaser
                </h3>
                <div class="card-tools">                    
                    <button type="button" class="btn btn-tool" onclick="window.location.href = '{{UrlManagement::user_list}}';">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php $no=1; ?>
                    @foreach($list_canvaser as $c)
                        @if($no == count($list_canvaser))
                        <hr class="bg-red">
                        @endif
                        @if($no<=6 || ($no == count($list_canvaser)))
                            <?php                             
                                if($target_canvaser->target != 0)
                                    $achievement = number_format(($c->total/$target_canvaser->target)*100);    
                            ?>
                            <li class="item">
                                <div class="product-img">
                                    <img src="assets/dist/img/default-150x150.png" alt="Product Image" class="img-size-50 img-circle">
                                </div>
                                <div class="product-info">
                                    <a href="{{UrlManagement::analytic_canvaser}}?kc={{$c->kode_canvaser}}" class="product-title">
                                        {{$c->nama}}
                                        @if($achievement >= 100)
                                            <span class="badge badge-success float-right"> Great </span>
                                        @elseif($achievement < 100 && $achievement>=75)
                                            <span class="badge badge-primary float-right"> Keep Going </span>
                                        @elseif($achievement < 75 && $achievement >=30)
                                            <span class="badge badge-warning float-right"> Attention </span>
                                        @else
                                            <span class="badge badge-danger float-right"> Need Counseling </span>
                                        @endif
                                    </a>
                                    <span class="product-description">
                                    <span class="badge badge-info float-right"> #{{$no}} </span>
                                    <span class="badge badge-success float-right"> BC {{$c->total}} </span>
                                    ID {{$c->kode_canvaser}}
                                    </span>
                                </div>
                            </li>                            
                        @endif
                        <?php $no++; ?>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">

        <div class="card card-primary">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    Trend Sales dan BC Total
                </h3>

                <div class="card-tools">
                    <!-- <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button> -->
                </div>
            </div>
            <div class="card-body">
                <canvas class="chart" id="line-chart2" style="max-height: 450px; max-width: 100%;"></canvas>
            </div>

        </div>

    </div>

    <div class="col-md-3">
        <div class="card card-blue">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-invoice-dollar mr-1"></i>
                    BC Bulan Ini
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-toggle="modal"
                        data-target="#modal-atur-target-bulan-ini">
                        <i class="fas fa-wrench"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" align="center">                                
                <h5>
                    Achievement {{number_format((@$current_ach/@$target_bulanan[date('m')-1]->target*100),0)}}%
                </h5>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="donutChart" style="min-height: 305px; max-height: 450px; width: 100%;" width="487"
                    height="230" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- <div class="card-footer" align="center">
                
            </div> -->
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-hand-holding-usd mr-1"></i>
                        Trend Revenue
                    </h3>
                    <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Rp. 0</span>
                        <span>Revenue Bulan Lalu</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-warning">
                            <i class="fas fa-arrow-left"></i> 0%
                        </span>
                        <span class="text-muted">Perkembangan Bulan Lalu</span>
                    </p>
                </div>

                <div class="position-relative mb-4">
                    <canvas id="sales-chart" style="min-height: 250px; height: 250px; max-width: 100%;"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-gray"></i> Target
                    </span>

                    <span>
                        <i class="fas fa-square text-primary"></i> Realisasi
                    </span>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('modals')

<div class="modal fade" id="modal-atur-target">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atur Target Canvaser</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{UrlManagement::set_target_canvaser}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Target</label>
                        <input type="number" class="form-control" name="target_canvaser" id="target_canvaser"
                            placeholder="Masukkan jumlah target">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" id="btn_target_canvaser" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-atur-target-bulan-ini">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Target Bulan Ini</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{UrlManagement::set_target_current_month}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Target</label>
                        <input type="number" class="form-control" name="target_current_month" id="target_current_month"
                            placeholder="Masukkan jumlah target">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" id="btn_target_bulanan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('additional-script')
@include('scripts.s_dashboard')
@endsection