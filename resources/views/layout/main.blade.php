<!DOCTYPE html>
<html lang="end">
@include('layout.header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layout.navbar')
        @include('layout.sidebar')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                @yield('content-header')
                            </h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                @yield('modals')
            </section>
        </div>

        @include('layout.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

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

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="assets/dist/js/pages/dashboard.js"></script> -->

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

    <!-- DataTables -->
    <script src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="assets/dist/js/demo.js"></script>    

    <!-- jQuery Mapael -->
    <script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

    <!-- <script src="https://chartjs-plugin-datalabels.netlify.com/chartjs-plugin-datalabels.js"></script> -->
    <script src="assets/plugins/chart.js/Chart.plugin.js"></script>

    <script>

    function popUp(status,message){        
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,            
        }).fire({
            type: status,
            title: message,            
        })
    }
    
    </script>

    @yield('additional-script')

</body>

</html>