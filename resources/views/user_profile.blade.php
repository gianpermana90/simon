<?php
    use App\Providers\UrlManagement;
?>

@extends('layout.main')

@section('content-header')
Profile Canvaser
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="assets/dist/img/user/user1.jpg"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$data->nama}}</h3>

                <p class="text-muted text-center">Witel {{$data->id_witel}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Sales Bulan {{date('F')}}</b> <a class="float-right">3</a>
                    </li>
                    <li class="list-group-item">
                        <b>BC Bulan {{date('F')}}</b> <a class="float-right">2</a>
                    </li>
                    <li class="list-group-item">
                        <b>Total Sales {{date('Y')}}</b> <a class="float-right">14</a>
                    </li>
                    <li class="list-group-item">
                        <b>Total BC {{date('Y')}}</b> <a class="float-right">12</a>
                    </li>
                </ul>

                <a href="{{UrlManagement::analytic_canvaser}}" class="btn btn-primary btn-block"><b>Detail Progress</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">About {{$data->nama}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                <p class="text-muted">
                    {{$data->email}}
                </p>

                <hr>

                <strong><i class="fas fa-mobile-alt mr-1"></i> HP</strong>

                <p class="text-muted">
                    {{$data->hp}}
                </p>

                <hr>

                <strong><i class="fas fa-birthday-cake mr-1"></i> Lahir</strong>

                <p class="text-muted">
                    {{$data->lahir}}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                <p class="text-muted">
                    {{$data->alamat}}
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Pengaturan</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane" id="activity">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Laporan Aktivitas</h3>
                            </div>

                            <div class="card-body row">
                                <div class="col-md-12">
                                    <textarea style="margin-bottom:20px;" class="form-control" rows="3"
                                        placeholder="Tuliskan sesuatu ..."></textarea>
                                </div>

                                <div class="col-md-6">
                                    <div style="margin-bottom:20px;" class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih file (Opsional)</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control">
                                        <option>-- Pilih Jenis Aktivitas --</option>
                                        <option>Laporan</option>
                                        <option>Informasi</option>
                                        <option>Keluhan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right">Kirim</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="active tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">

                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-info">
                                    7 Nov. 2019
                                </span>
                            </div>
                            <!-- /.timeline-label -->

                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-bullhorn bg-danger"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 08:00</span>

                                    <h3 class="timeline-header"><a href="#">Pak Jayadi</a> Mengirimkan konten baru
                                    </h3>

                                    <div class="timeline-body">
                                        Mohon untuk disebarkan kepada seluruh masing-masing audience social media yang
                                        dimiliki
                                        <img src="assets/dist/img/content-timeline/content1.jpg" width="97%" alt="...">
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-info">
                                    6 Nov. 2019
                                </span>
                            </div>
                            <!-- /.timeline-label -->

                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 11:54</span>

                                    <h3 class="timeline-header"><a href="#">{{$data->nama}}</a> mengunggah foto baru
                                    </h3>

                                    <div class="timeline-body">
                                        Giat lapangan gangguan pelanggan
                                        <img src="assets/dist/img/content-timeline/evidence1.jpg" width="97%" alt="...">
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-info">
                                    5 Nov. 2019
                                </span>
                            </div>
                            <!-- /.timeline-label -->

                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-exclamation-triangle bg-warning"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 11:54</span>

                                    <h3 class="timeline-header"><a href="#">{{$data->nama}}</a> melaporkan sesuatu</h3>

                                    <div class="timeline-body">
                                        Terdapat kendala menghadapi calon pelanggan karena keterbatasan pengetahuan
                                        produk
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-shoe-prints bg-gray"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Nomor HP">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Tgl. Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger float-right">Perbarui Informasi
                                        Akun</button>
                                </div>
                            </div>
                        </form>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan login</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Katasandi
                                            Lama</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword3"
                                                placeholder="Masukkan Katasandi Lama...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Katasandi
                                            Baru</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword3"
                                                placeholder="Masukkan Katasandi Baru...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Konfirmasi
                                            Katasandi</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword3"
                                                placeholder="Konfirmasi Katasandi Baru...">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success float-right">Perbarui Password</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>

@endsection