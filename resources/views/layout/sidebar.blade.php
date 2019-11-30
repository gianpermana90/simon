<?php
    use App\Providers\UrlManagement;
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <img src="assets/dist/img/logo-telkom.png" alt="SIMON" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">SIMON</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Session::get('user_data')->nama}}</a>
            </div>
        </div>
        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">                

                @if(Session::get('user_data')->role == "Admin")

                <li class="nav-header">Analytics</li>
                <li class="nav-item">
                    <a href="{{UrlManagement::admin_dashboard}}"
                        class="nav-link <?php if(strpos(url()->current(), UrlManagement::admin_dashboard)) echo "active"; ?> ">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{UrlManagement::user_list}}"
                        class="nav-link <?php if(strpos(url()->current(), UrlManagement::user_list) || strpos(url()->current(), UrlManagement::analytic_canvaser)) echo "active"; ?> ">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Canvaser
                        </p>
                    </a>
                </li>

                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="update_data_button">
                        <i class="nav-icon fas fa-sync"></i>
                        <p>
                            Update Data
                        </p>
                    </a>
                </li>

                @endif

                @if(Session::get('user_data')->role == "User")

                <li class="nav-header">User Data</li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#"
                        class="nav-link <?php if(strpos(url()->current(), UrlManagement::user_profile)) echo "active"; ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{UrlManagement::user_profile}}"
                                class="nav-link <?php if(strpos(url()->current(), UrlManagement::user_profile)) echo "active"; ?>">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Activity</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{UrlManagement::analytic_canvaser}}?sample=4"
                                class="nav-link <?php if(strpos(url()->current(), UrlManagement::analytic_canvaser)) echo "active"; ?>">
                                <i class="fas fa-chart-line nav-icon"></i>
                                <p>Analytic</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @endif

            </ul>
        </nav>

    </div>

</aside>