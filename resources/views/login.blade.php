<?php 
use App\Providers\UrlManagement;
?>

<!DOCTYPE html>
<html>

@include('layout.header')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>SIMON</b> <br> Sistem Monitoring
        </div>
        
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk memulai sesi anda</p>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">
                            <button type="submit" onclick="postLogin()" class="btn btn-primary btn-block btn-flat float-right">Sign In</button>
                        </div>
                    </div>                
                </p>
            </div>            
        </div>
    </div>    

    <script>

    function postLogin(){
        var email = $("#email").val();
        var password = $("#password").val();        
        jQuery.ajax({
            method: 'POST',
            dataType: 'json',
            url: "{{UrlManagement::login_process}}",
            crossDomain : true,
            data: {
                _token: "{{ csrf_token() }}",
                email: email,
                password: password
            },
            beforeSend: function(){
                console.log("Logging in ...");
            },
        })
        .done(function(data) {
            if(data.status == "success"){
                toastr.success(data.message);
                location.reload();
            }else{
                toastr.error(data.message);
            }            
        });
    }

    </script>

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <!-- <script src="assets/plugins/sparklines/sparkline.js"></script> -->
    <!-- JQVMap -->
    <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>

    <!-- Additional -->
    <script src="assets/dist/js/monthyearpicker.js"></script>

    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="assets/plugins/toastr/toastr.min.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="assets/dist/js/demo.js"></script>
    <!-- <script src="assets/dist/js/pages/dashboard3.js"></script> -->
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>

    <!-- jQuery Mapael -->
    <script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

    <script src="https://chartjs-plugin-datalabels.netlify.com/chartjs-plugin-datalabels.js"></script>        

</body>

</html>