<?php

function get_user() {
    $list_user = db_fetch_array("SELECT * FROM `tbl_users`");
    return $list_user;
}

//Hàm kiểm tra dữ liệu trùng trên db
function user_exists($username, $email) {
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if($check_user > 0) {
        return true;
    }else {
        return false;
    }
}


//Hàm thêm dữ liệu vào db
function add_user($data) {
    return db_insert('tbl_users', $data);
}

function check_active_token($active_token) {
    $check_active = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
    if($check_active > 0) {
        return true;
    }else {
        return false;
    }
}

function active_user($active_token) {
    return db_update('tbl_users', array('is_active' => 1), "`active_token` = '{$active_token}'");
}


function check_login($username, $password) {
    $check_login = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if($check_login > 0) {
        return true;
    }else {
        return false;
    }
}

function check_email($email) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    if($check > 0) {
        return true;
    }else {
        return false;
    }
}

function update_reset_token($data, $email) {
   return db_update('tbl_users', $data, "`email` = '{$email}'");
}

function check_reset_pass_token($reset_pass_token) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_pass_token` = '{$reset_pass_token}'");
    if($check > 0) {
        return true;
    }else {
        return false;
    }
}

function update_pass($data, $reset_pass_token) {
    return db_update('tbl_users', $data, "`reset_pass_token` = '{$reset_pass_token}'");
}

?>