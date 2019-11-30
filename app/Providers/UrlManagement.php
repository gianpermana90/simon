<?php

namespace App\Providers;

class UrlManagement{
    const index = "/";

    const register_user = "/register";
    const register_process = "/register_process";
    const delete_user = "/delete_user";

    const login = "/login";
    const logout = "/logout";
    const login_process = "/login_process";

    const admin_dashboard = "/admin_dashboard";

    const user_list = "/user_list";
    const user_profile = "/user_profile";

    const analytic_canvaser = "/canvaser_analytics";

    const insert_extracted_data = "/insert_extracted_data";

    const set_target_canvaser = "/set_target_canvaser";
    const set_target_current_month = "/set_target_current_month";
}

?>