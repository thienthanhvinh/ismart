<?php

function add_cat($data) {
    return db_insert('tbl_products_cat', $data);
}

function get_list_cat() {
    return db_fetch_array("SELECT * FROM `tbl_products_cat`");
}

function data_tree($list_cat, $parent_id, $level = 0) {
    $result = [];
    foreach($list_cat as $item) {  
        $item['level'] = $level;
        if($item['parent_id'] == $parent_id) {
            $result [] = $item;
            $child = data_tree($list_cat, $item['cat_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
        return $result;
}


function get_list_parent() {
    return db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = 0");
}

function add_product($data) {
    return db_insert('tbl_products', $data);
}

function get_cat_info($cat_id) {
    return db_fetch_row("SELECT * FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
}

function edit_cat($data, $cat_id) {
    return db_update('tbl_products_cat', $data, "`cat_id` = '{$cat_id}'");
}
function delete_cat($cat_id) {
    return db_delete('tbl_products_cat', "`cat_id` = '{$cat_id}'");
}

function print_cat_name($list_cat, $cat_id) {
    foreach($list_cat as $item) {
        if($item['cat_id'] == $cat_id) {
            return $item['cat_name'];
        }
    }
}

function get_product_info($product_id) {
    return db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$product_id}'");

}

function edit_product($data, $id) {
    return db_update('tbl_products', $data, "`product_id` = '{$id}'");
}

function delete_product($id) {
    return db_delete('tbl_products', "`product_id` = '{$id}'");
}

function delete_product_have_foreign_key($id) {
    if(db_delete('tbl_images', "`product_id` = '{$id}'")) {
        return db_delete('tbl_products', "`product_id` = '{$id}'");
    }
}

function update_action($data, $id) {
    return db_update('tbl_products', $data, "`product_id` IN ($id)");
}

function delete_action($id) {
    return db_delete('tbl_products', "`product_id` IN ($id)");
}


// Của tất cả
function get_list_product($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục' LIMIT {$start}, {$num_per_page}");
}

function get_list_by_search($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' LIMIT {$start}, {$num_per_page}");
}
function get_num_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục'");
}

function get_num_restore() {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục'");
}


//Của trash

function get_list_search_trash($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Xoá tạm thời' LIMIT {$start}, {$num_per_page}");
}
function get_num_search_trash($keyword) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Xoá tạm thời'");
}
function get_list_trash($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Xoá tạm thời' LIMIT {$start}, {$num_per_page}");
}
function get_num_trash() {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Xoá tạm thời'");
}

// Của còn hàng

function get_list_search_avai($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `status` = 'Còn hàng' AND `restore_trash` = 'Khôi phục' LIMIT {$start}, {$num_per_page}");
}
function get_num_search_avai($keyword) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Còn hàng'");
}
function get_list_avai($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'Còn hàng' AND `restore_trash` = 'Khôi phục' LIMIT {$start}, {$num_per_page}");
}
function get_num_avai() {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `status` = 'Còn hàng' AND `restore_trash` = 'Khôi phục'");
}


//Của hết hàng 

function get_list_search_sold_out($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `status` = 'Hết hàng' AND `restore_trash` = 'Khôi phục' LIMIT {$start}, {$num_per_page}");
}
function get_num_search_sold_out($keyword) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Hết hàng'");
}
function get_list_sold_out($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'Hết hàng' AND `restore_trash` = 'Khôi phục' LIMIT {$start}, {$num_per_page}");
}
function get_num_sold_out() {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `status` = 'Hết hàng' AND `restore_trash` = 'Khôi phục'");
}


// Xử lý phân trang
function get_paging($num_page, $page, $base_url = "") {
    $str_pagging = "<ul id='list-paging'>";

    if($page > 1) {
        $pre_page = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$pre_page}\"><<</a></li>";      
    }

    for($i = 1; $i <= $num_page; $i++) {
        // $str_pagging .= "<li><a href='{$base_url}&page={$i}'>{$i}</a></li>";
        $active = "";
        if($i == $page) 
            $active = "class= 'active'";
            $str_pagging .= "<li $active><a href='{$base_url}&page={$i}'>{$i}</a></li>";
                        
    }

    if($page < $num_page) {
        $next_page = $page + 1;
        $str_pagging .= "<li><a href='{$base_url}&page={$next_page}'>>></a></li>";
    }
    
    $str_pagging .= "</ul>";
    return $str_pagging;
}

//Xử lý màu và thêm hình ảnh phụ sản phẩm

function add_color($data) {
    return db_insert('tbl_colors', $data);
}
 
function get_list_color() {
    return db_fetch_array("SELECT * FROM `tbl_colors` WHERE `color_id` != 0");
}

function add_image($data) {
    return db_insert('tbl_images', $data);
}
function get_product_image($product_id) {
    return db_fetch_array("SELECT * FROM `tbl_images` WHERE `product_id` = '{$product_id}'");
}

function print_color_name($list_color, $color_id) {
    foreach($list_color as $item) {
        if($item['color_id'] == $color_id) {
            return $item['color_name'];
        }
    }
}

function delete_image($image_id) {
    return db_delete('tbl_images', "`image_id` = '{$image_id}'");
}

// function delete_color_have_foreign_key($color_id) {
//     if(db_delete('tbl_images',"`color_id` = '{$color_id}'")) {
//         return db_delete('tbl_colors', "`color_id` = '{$color_id}'");
        
//     }
   
// }

function delete_color_have_foreign_key($data, $color_id) {
    if(db_update('tbl_images', $data, "`color_id` = '{$color_id}'")) {
        return db_delete('tbl_colors', "`color_id` = '{$color_id}'");
    }
}

function delete_color($color_id) {
    return db_delete('tbl_colors', "`color_id` = '{$color_id}'");
}

// function delete_color_2($color_id) {
//     if(db_delete('tbl_colors', "`color_id` = '{$color_id}'")) {
//         return db_delete('tbl_images', "`color_id` = '{$color_id}'");
//     }
// }



function get_outstanding_name($out_standing) {
    if($out_standing == 1) {
        echo "Có";
    }
    if($out_standing == 0) {
        echo "Không";
    }
}


?>