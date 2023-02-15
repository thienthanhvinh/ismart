<?php

function get_list_customer($start, $num_per_page) {
    return db_fetch_array("SELECT * FROM `tbl_customers` ORDER BY `edit_date` DESC, `order_date` DESC LIMIT {$start}, {$num_per_page}");
}

function get_num_customer() {
    return db_num_rows("SELECT * FROM `tbl_customers`");
}

function get_num_order_complete() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `status` = 'Hoàn thành'");
}

function get_num_order_process() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `status` = 'Đang xử lý'");
}

function get_num_order_transport() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `status` = 'Đang vận chuyển'");
}

function get_num_order_cancel() {
    return db_num_rows("SELECT * FROM `tbl_customers` WHERE `status` = 'Huỷ đơn'");
}

// Doanh số
function get_list_order_complete() {
    return db_fetch_array("SELECT * FROM `tbl_customers` WHERE `status` = 'Hoàn thành'");
}

function get_final_total($list_complete) {
    $final_total = 0;
    foreach($list_complete as $item) {
        $final_total = $final_total + $item['total'];
    }
    return $final_total;
}

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

?>