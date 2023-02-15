
<?php

function form_error($label_field) {
    global $error;
    if(!empty($error[$label_field])) {
        return "<p class='error'>{$error[$label_field]}</p>";
    }
} 

function set_value($label_field) {
    global $$label_field;
    if(!empty($$label_field)) {
        return $$label_field;
    }
}


function is_username($username) {
    $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($pattern, $username, $matchs)) {
        return false;
    }else {
        return true;
    }
}

function is_password($password) {
    $pattern = "/^([A-Z]+)([A-Za-z0-9_\.!@#$%^&*()]+){8,32}$/";
    if(!preg_match($pattern, $password, $matchs)) {
        return false;
    }else {
        return true;
    }
}

function is_email($email) {
    $pattern = "/^([A-Za-z0-9]+)([A-za-z0-9\.]+){6,32}@([a-z]{3,12})(\.[a-z]{2,12})+$/";
    if(!preg_match($pattern, $email, $matchs)) {
        return false;
    }else {
        return true;
    }

}
?>