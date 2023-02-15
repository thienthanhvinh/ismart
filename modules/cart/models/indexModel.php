<?php

function get_page_data() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục' AND `status` = 'Công khai'");
}

function get_product_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$id}'");
}

function add_cart($id) {
    //Lấy thông tin của sản phẩm vừa click vào
    $add_cart = get_product_by_id($id);

    $qty = 1;
    if(isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
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


function get_list_buy_cart() {
    if(isset($_SESSION['cart'])) {
        return $_SESSION['cart']['buy'];
    }
    return false;
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

function get_num_order_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return false;
}

function get_total_cart() {
    if(isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function update_cart($qty) {
    foreach($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $new_qty * $_SESSION['cart']['buy'][$id]['price'];
    }
    update_info_cart();
}

//Xoá sản phẩm trong giỏ hàng
function delete_cart($id) {
    if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']['buy'][$id]);
            update_info_cart();
    }
}

function delete_all_cart() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

function get_list_province() {
    return db_fetch_array("SELECT * FROM `tbl_tinhthanhpho`");
}

function get_order_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_customers` WHERE `customer_id` = '{$id}'");
}

function get_order_detail_by_id($id) {
    return db_fetch_array("SELECT * FROM `tbl_orders` WHERE `order_id` = '{$id}'");
}

function get_list_city() {
    return db_fetch_array("SELECT * FROM `tbl_tinhthanhpho`");
}

function get_city_name($list_city, $city_id) {
    foreach($list_city as $item) {
        if($item['matp'] == $city_id) {
            return $item['name'];
        }
    }
}

function get_list_district() {
    return db_fetch_array("SELECT * FROM `tbl_quanhuyen`");
}

function get_district_name($list_district, $district_id) {
    foreach($list_district as $item) {
        if($item['maqh'] == $district_id) {
            return $item['name'];
        }
    }
}

function get_list_wards() {
    return db_fetch_array("SELECT * FROM `tbl_xaphuongthitran`");
}

function get_wards_name($list_wards, $wards_id) {
    foreach($list_wards as $item) {
        if($item['xaid'] == $wards_id) {
            return $item['name'];
        }
    }
}

//Xử lý in tên địa chỉ, phường, thành phố trên một hàm
function get_address_name($apart_number, $wards, $district, $province, $list_wards, $list_district, $list_city) {
    if(!empty($apart_number)) {
        return $apart_number. ', ' .get_wards_name($list_wards, $wards). ', ' .get_district_name($list_district, $district). ', ' .get_city_name($list_city, $province);
    }
}

function get_cat_name_index($list_cat, $cat_id) {
    foreach($list_cat as $item) {
        if($item['cat_id'] == $cat_id) {
            return $item['slug'];
        }
    }  
}



?>