<?php
    use App\Providers\UrlManagement;
?>

@extends('layout.main')

@section('content-header')
Data User
@endsection

@section('content')

<!-- Default box -->
<div class="card w3-animate-zoom">
    <div class="card-header">
        <h3 class="card-title">Users</h3>
        <div class="card-tools">
            <button type="button" class="btn bg-info btn-sm"  data-toggle="modal" data-target="#modal-register">
                <i class="fas fa-user-plus"></i>
            </button>            
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
                <tr>                    
                    <th style="">
                        Info
                    </th>
                    <th>
                        Pencapaian Bulan ini
                    </th>
                    <th class="text-center">
                        Sales Bulan ini
                    </th>
                    <th class="text-center">
                        BC Bulan ini
                    </th>
                    <th style="" class="text-center">
                        Performansi Bulan ini
                    </th>
                    <th style="">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1;?>
                @foreach($users as $user)
                <?php 
                    if($target->target != 0)
                        $achievement = number_format(($user->total/$target->target)*100);    
                ?>
                <tr>                    
                    <td>
                        <a>
                            {{$user->nama}}
                        </a>
                        <br />
                        <small>
                            ID {{$user->sales_id}}
                        </small>
                    </td>
                    <?php
                        $color = "";
                        if($achievement >= 100){
                            $color = "green";
                        }elseif($achievement < 100 && $achievement >=75){
                            $color = "blue";
                        }elseif($achievement < 75 && $achievement >= 30){
                            $color = "yellow";
                        }else{
                            $color = "red";
                        }
                    ?>
                    <td class="project_progress">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-{{$color}}" role="progressbar" aria-volumenow="57"
                                aria-volumemin="0" aria-volumemax="100" style="width: {{$achievement}}%"></div>
                        </div>
                        <small>
                            @if($target->target != 0)
                            {{$achievement}}% Complete
                            @endif
                        </small>
                    </td>
                    <td class="project-state">
                        <a>
                            {{$user->sales}}
                        </a>
                    </td>
                    <td class="project-state">
                        <a>
                            {{$user->total}}
                        </a>
                    </td>
                    <td class="project-state">
                        @if($achievement >= 100)
                        <span class="badge badge-success">Great</span>
                        @elseif($achievement < 100 && $achievement>=75)
                        <span class="badge bg-blue">Keep Going</span>
                        @elseif($achievement < 75 && $achievement>= 30)
                        <span class="badge badge-warning">Attention</span>
                        @else
                        <span class="badge badge-danger">Need Counseling</span>
                        @endif
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm"
                            href="{{UrlManagement::analytic_canvaser}}?kc={{$user->sales_id}}">
                            <i class="fas fa-eye"></i>
                            Detail
                        </a>
                        <a class="btn btn-info btn-sm" href="#">
                            <i class="fas fa-pencil-alt"></i>
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="hapusData('{{$user->sales_id}}')">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                    </td>
                </tr>
                <?php $no++; ?>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection

@section('modals')
<div class="modal fade" id="modal-register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama" id="nama">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Kode Sales SIMOR" id="sales_id">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="HP" id="hp">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-mobile-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" placeholder="Lahir" id="lahir">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-birthday-cake"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <textarea class="form-control" rows="3" placeholder="Alamat" id="alamat"></textarea>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-home"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Ketik ulang password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>                    
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-flat" onclick="simpanData()">Simpan</button>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional-script')
<script>

$("#user_table").DataTable();

function simpanData(){

    var nama = $("#nama").val();
    var sales_id = $("#sales_id").val();
    var hp = $("#hp").val();
    var lahir = $("#lahir").val();
    var alamat = $("#alamat").val();
    var email = $("#email").val();
    var password = $("#password").val();

    jQuery.ajax({
        method: 'POST',
        dataType: 'json',
        url: "{{UrlManagement::register_process}}",
        crossDomain : true,
        data: {
            _token: "{{ csrf_token() }}",
            nama: nama,
            sales_id: sales_id,
            hp: hp,
            lahir: lahir,
            alamat: alamat,
            email: email,
            password: password,
        },
        beforeSend: function(){
            console.log("Sending Data");
        },
    })
    .done(function(data) {        
        $('#modal-register').modal('hide');
        if(data.status == "success"){
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                onClose: () => {
                    location.reload();
                }
            }).fire({
                type: data.status,
                title: data.message,            
            })
        }else{
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,                
            }).fire({
                type: data.status,
                title: data.message,            
            })
        }            
    });
}

function hapusData(sales_id){
    var s = sales_id;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            jQuery.ajax({
                method: 'POST',
                dataType: 'json',
                url: "{{UrlManagement::delete_user}}",
                crossDomain : true,
                data: {
                    _token: "{{ csrf_token() }}",
                    sales_id: s,
                },
                beforeSend: function(){
                    console.log("Sending Data");
                },
            })
            .done(function(data) {
                $('#modal-register').modal('hide');
                if(data.status == "success"){
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        onClose: () => {
                            location.reload();
                        }
                    }).fire({
                        type: data.status,
                        title: data.message,            
                    })
                }else{
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,                
                    }).fire({
                        type: data.status,
                        title: data.message,            
                    })
                }            
            });            
        }
    })

    var sales_id = $("#sales_id").val();
    
}

</script>
@endsection