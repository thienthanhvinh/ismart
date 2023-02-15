<?php 

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

function get_list_order($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
} 
function get_num_order() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục'");
}

function get_num_order_list_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục'");
}

function get_list_order_by_search($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_list_process($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Đang xử lý' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}
function get_num_process() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Đang xử lý'");
}

function get_list_process_by_search($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang xử lý' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang xử lý' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_order_process_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang xử lý' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang xử lý'");
}


function get_list_transport($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Đang vận chuyển' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_transport() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Đang vận chuyển'");
}

function get_list_transport_by_search($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang vận chuyển' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang vận chuyển' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}
function get_num_order_transport_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang vận chuyển' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Đang vận chuyển'");
}


function get_list_complete($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Hoàn thành' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_complete() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Hoàn thành'");
}

function get_list_complete_by_search($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Hoàn thành' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Hoàn thành' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_order_complete_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Hoàn thành' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Hoàn thành'");
}


function get_list_cancel($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Huỷ đơn' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_cancel() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Khôi phục' AND `status` = 'Huỷ đơn'");
}

function get_list_cancel_by_search($keyword, $start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Huỷ đơn' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Huỷ đơn' ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_order_cancel_search($keyword) {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `name` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Huỷ đơn' OR `code` LIKE '%$keyword%' AND `restore_trash` = 'Khôi phục' AND `status` = 'Huỷ đơn'");
}


function get_list_trash() {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Xoá tạm thời' ORDER BY `customer_id` DESC");
}

function get_num_trash() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `restore_trash` = 'Xoá tạm thời'");
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


//Cập nhật trạng thái đơn hàng
function update_status($data, $id) {
    return db_update('tbl_customers', $data, "`customer_id` IN ($id)");
}

function update_action($data, $id) {
    return db_update('tbl_customers', $data, "`customer_id` IN ($id)");
}

function delete_action($id) {
    if (db_delete('tbl_customers', "`customer_id` = '{$id}'")) {
        return db_delete('tbl_orders', "`order_id` = '{$id}'");
    }
}

function delete_action_many_order($id) {
    if (db_delete('tbl_customers', "`customer_id` IN ($id)")) {
        return db_delete('tbl_orders', "`order_id` IN ($id)");
    }
}

?>