<?php


function get_page_data() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục' AND `status` = 'Công khai'");
}

function get_page_data_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_pages` WHERE `id` = '{$id}'");
}

function get_page_data_by_slug($slug) {
    return db_fetch_row("SELECT * FROM `tbl_pages` WHERE `slug` = '{$slug}'");
}

function get_num_order_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return false;
}

function get_list_buy_cart() {
    if(isset($_SESSION['cart'])) {
        return $_SESSION['cart']['buy'];
    }
    return false;
}

function get_total_cart() {
    if(isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

?>