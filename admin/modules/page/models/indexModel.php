<?php

function get_page_by_id($id) {
    $page = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `id` = $id");
    return $page;
}

function add_page($data) {
    return db_insert('tbl_pages', $data);
}

function get_list_page() {
    return db_fetch_array("SELECT * FROM `tbl_pages`");
}


function get_num_page() {
    return db_num_rows("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục'");
}

function get_num_page_temporary() {
    return db_num_rows("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Xoá tạm thời'");
}

function get_num_page_public() {
    return db_num_rows("SELECT * FROM `tbl_pages` WHERE `status` = 'Công khai' AND `trash_status` = 'Khôi phục'");
}

function get_num_page_wait() {
    return db_num_rows("SELECT * FROM `tbl_pages` WHERE `status` = 'Chờ duyệt' AND `trash_status` = 'Khôi phục'");
}

function edit_db($data, $id) {
    return db_update('tbl_pages', $data, "`id` = '{$id}'");
}

function update_action($data, $id) {
    return db_update('tbl_pages', $data, "`id` IN ($id)");
}

function delete_action($id) {
    return db_delete('tbl_pages', "`id` IN ($id)");
}

function get_list_page_restore() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Khôi phục'");
}

function get_list_page_temporary() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `trash_status` = 'Xoá tạm thời'");

}

function get_list_page_public() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `status` = 'Công khai' AND `trash_status` = 'Khôi phục'");

}

function get_list_page_wait() {
    return db_fetch_array("SELECT * FROM `tbl_pages` WHERE `status` = 'Chờ duyệt' AND `trash_status` = 'Khôi phục'");

}



?>