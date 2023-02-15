<?php

function get_page_data() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục' AND `status` = 'Công khai'");
}

function get_post_data() {
    return db_fetch_array("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Khôi phục' AND `public_wait` = 'Công khai'");
}

function get_post_data_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_posts` WHERE `id` = '{$id}' AND `restore_trash` = 'Khôi phục' AND `public_wait` = 'Công khai'");
}

function get_post_data_by_slug($slug) {
    return db_fetch_row("SELECT * FROM `tbl_posts` WHERE `slug` = '{$slug}' AND `restore_trash` = 'Khôi phục' AND `public_wait` = 'Công khai'");
}

function get_list_cat() {
    return db_fetch_array("SELECT * FROM `tbl_posts_cat`");
}

function get_cat_name($list_cat, $cat_id) {
    foreach($list_cat as $item) {
        if($item['cat_id'] == $cat_id) {
            return $item['cat_name'];
        }
    }
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

function get_list_product() {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục'");
}

function print_old_price($old_price) {
    if($old_price != null) {
        return currency_format($old_price);
    }else {
        return $old_price = '';
    }
}

?>