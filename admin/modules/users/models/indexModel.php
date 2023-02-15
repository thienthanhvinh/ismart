
<?php
function check_login($username, $password) {
    $check_user = db_num_rows("SELECT * FROM `tbl_admin_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if($check_user > 0) {
        return true;
    }else {
        return false;
    }
}

function get_display_name($username) {
    return db_fetch_row("SELECT `displayname` FROM `tbl_admin_users` WHERE `username` = '{$username}'");
}

function check_user($username) {
    $check_user = db_num_rows("SELECT * FROM `tbl_admin_users` WHERE `username` = '{$username}'");
    if($check_user > 0) {
        return true;
    }else {
        return false;
    }
}

function get_info_user($username) {
    return $info_user = db_fetch_row("SELECT * FROM `tbl_admin_users` WHERE `username` = '{$username}'");
}

function update_info($data, $username) {
    return db_update('tbl_admin_users', $data, "`username` = '{$username}'");
}

function check_pass_old($username, $password) {
    $check = db_num_rows("SELECT * FROM `tbl_admin_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if($check > 0) {
        return true;
    }else {
        return false;
    }
}

function update_pass($data, $username) {
    return db_update('tbl_admin_users', $data, "`username` = '{$username}'");
}

function user_exists($username, $email) {
    $check = db_num_rows("SELECT * FROM `tbl_admin_users` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if($check > 0) {
        return true;
    }else {
        return false;
    }
}

function add_admin_user($data) {
    return db_insert('tbl_admin_users', $data);
}

?>