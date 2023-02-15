<?php

function get_page_data() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục' AND `status` = 'Công khai'");
}

function get_list_cat() {
    return db_fetch_array("SELECT * FROM `tbl_products_cat`");
}

// function data_tree($list_cat, $parent_id = 0) {
//     $str = '';
//     foreach($list_cat as $item) {  
//         if($item['parent_id'] == $parent_id) {
//             $str .= "<li><a href = '?mod=product&action=list&cat_id={$item['cat_id']}'>{$item['cat_name']}</a>";
//             $sub_menu = data_tree($list_cat, $item['cat_id']);
//             if(!empty($sub_menu)) {
//                 $str .= "<ul class='sub-menu'>{$sub_menu}</ul>"; 
//             }
//             $str .= "</li>";
//         }
//     }
//         return $str;
// }

function data_tree($list_cat, $parent_id = 0) {
    $str = '';
    foreach($list_cat as $item) {  
        if($item['parent_id'] == $parent_id) {
            $str .= "<li><a href = '{$item['slug']}'>{$item['cat_name']}</a>";
            $sub_menu = data_tree($list_cat, $item['cat_id']);
            if(!empty($sub_menu)) {
                $str .= "<ul class='sub-menu'>{$sub_menu}</ul>"; 
            }
            $str .= "</li>";
        }
    }
        return $str;
}

function get_product_outstanding() {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `outstanding` = 1 AND `restore_trash` = 'Khôi phục'");
}

function get_product_have_discount() {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục' AND `have_discount` = 1");
}

function get_product_by_date() {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục' ORDER BY `product_id` DESC");
}

function get_list_product() {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục'");
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

function get_product_by_search($keyword) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%'");
}

function print_old_price($old_price) {
    if($old_price != null) {
        return currency_format($old_price);
    }else {
        return $old_price = '';
    }
}

function get_list_slider() {
    return db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = 'Công khai'");
}

function get_cat_name_index($list_cat, $cat_id) {
    foreach($list_cat as $item) {
        if($item['cat_id'] == $cat_id) {
            return $item['slug'];
        }
    }  
}


?>