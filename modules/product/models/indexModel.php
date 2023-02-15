<?php

function get_page_data() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục' AND `status` = 'Công khai'");
}


function get_list_cat() {
    return db_fetch_array("SELECT * FROM `tbl_products_cat`");
}

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

function str_cat_id($list_cat, $cat_id) {
    $str = '';
    foreach($list_cat as $item) {
        if($item['parent_id'] ==  $cat_id) {
            $str .= ",{$item['cat_id']}";
        
        }
    }
    return $str;
}

function get_cat_id($list_cat, $slug) {
    foreach($list_cat as $item) {
        if($item['slug'] == $slug) {
            return $item['cat_id'];
        }
    }
}

function get_url_paging($list_cat, $parent_id = 0, $cat_id_url) {
    $url = '';
    foreach($list_cat as $item) {
        if($item['parent_id'] == $parent_id) {
            if($item['cat_id'] == $cat_id_url) {
            $url .=  "{$item['slug']}";
            // $url_child = get_url_paging($list_cat, $item['cat_id']);
           
        }
        $url_child = get_url_paging($list_cat, $item['cat_id'], $cat_id_url);
        $url .= $url_child;
    }   
    }
    return $url;
}

// fucntion get_url_product_cat($list_cat) {
//     $cat_id = (int) $_GET[cat_id];
//     $url = '';
//     foreach($list_cat as $item) {
//         $url .= "?mod=product&action=list&cat_id={$cat}"
//     }
// }




function get_paging($num_page, $page, $base_url = "") {
    $str_pagging = "<ul id='list-paging'>";

    // if($page = 1) {
       
    // }

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
                        
 
        // if($page = 1) {
        //     $hidden  = "class = 'hidden'";
        //     $str_pagging .= "<li $hidden><a href='{$base_url}&page={$i}'>{$i}</a></li>";
        // }
    }

    if($page < $num_page) {
        $next_page = $page + 1;
        $str_pagging .= "<li><a href='{$base_url}&page={$next_page}'>>></a></li>";
    }
    
    $str_pagging .= "</ul>";
    return $str_pagging;
}

// function get_product_by_cat_id($cat_id) {
//     return db_fetch_array("SELECT * FROM `tbl_products` WHERE `cat_id` = '{$cat_id}' AND `restore_trash` = 'Khôi phục' ");
// }

function get_product_by_cat_id($start, $num_per_page, $cat_id) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `cat_id` = '{$cat_id}' LIMIT {$start}, {$num_per_page}");
}

function get_product_by_child_id($start, $num_per_page, $cat_id) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `child_id` = '{$cat_id}' LIMIT {$start}, {$num_per_page}");
}



function get_list_all_product() {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `restore_trash` = 'Khôi phục'");
}

function get_product_id($list_product, $slug) {
    foreach($list_product as $item) {
        if($item['slug'] == $slug) {
            return $item['product_id'];
        }
    }
}

function get_cat_name($cat_id) {
    return db_fetch_row("SELECT `cat_name` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
}

function get_cat_name_index($list_cat, $cat_id) {
    foreach($list_cat as $item) {
        if($item['cat_id'] == $cat_id) {
            return $item['slug'];
        }
    }  
}

// function get_cat_name($list_cat, $id) {
//     foreach($list_cat as $item) {
//         if($item['cat_id'])
//     }
// }

function get_product_name($slug) {
    return db_fetch_row("SELECT `name` FROM `tbl_products` WHERE `slug` = '{$slug}'");
}

function get_product_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$id}'");
}

function get_product_by_slug($slug) {
    return db_fetch_row("SELECT * FROM `tbl_products` WHERE `slug` = '{$slug}'");
}

function get_product_same_cat($cat_id, $id) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `cat_id` = '{$cat_id}' AND `product_id` != '{$id}'");
}


function get_product_image($id) {
    return db_fetch_array("SELECT * FROM `tbl_images` WHERE `product_id` = '{$id}'");
}

function get_list_color() {
    return db_fetch_array("SELECT * FROM `tbl_colors`");
}

function get_color_name($list_color, $color_id) {
    foreach($list_color as $item) {
        if($item['color_id'] == $color_id) {
            return $item['color_name'];
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


function add_cart($id) {
    //Lấy thông tin của sản phẩm vừa click vào
    $add_cart = get_product_by_id($id);

    if(isset($_POST['btn-add-cart'])) {
    $qty = $_POST['num_order'];
    }

    if(isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + $_POST['num_order'];
    }

    //Tạo mảng session cart buy để lưu thông tin giỏ hàng
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $add_cart['product_id'],
        'thumb' => $add_cart['thumb'],
        'name' => $add_cart['name'],
        'price' => $add_cart['price'],
        'qty' => $qty,
        'sub_total' => $qty * $add_cart['price'],
        'cat_id' => $add_cart['cat_id'],
        'slug' => $add_cart['slug']
    );

    //Cập nhật tổng tiền và cập nhật tổng số lượng sản phẩm
    update_info_cart();
}
function update_info_cart() {
    if(isset($_SESSION['cart'])) {
        #Thêm thông tin tổng đơn hàng
        $num_order = 0;
        $total = 0;
        foreach($_SESSION['cart']['buy'] as $item) {
            $num_order = $num_order + $item['qty'];
            $total = $total + $item['sub_total'];
        }
        
        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total
        );
    }
}

function filter_product_by_price($price, $cat_id) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `price` BETWEEN {$price} AND `cat_id` = '{$cat_id}'");
}

function filter_product_child($price, $cat_id) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `price` BETWEEN {$price} AND `child_id` = '{$cat_id}'");
}




function print_old_price($old_price) {
    if($old_price != null) {
        return currency_format($old_price);
    }else {
        return $old_price = '';
    }
}

function get_product_by_search($keyword) {
    return db_fetch_array("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%'");
}

function get_num_product_by_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `name` LIKE '%$keyword%'");
}

function get_num_product($cat_id) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `cat_id` = '{$cat_id}'");
}

function get_num_child($cat_id) {
    return db_num_rows("SELECT * FROM `tbl_products` WHERE `child_id` = '{$cat_id}'");
}


?>