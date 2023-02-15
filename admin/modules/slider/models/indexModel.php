
<?php

function add_slider($data) {
    return db_insert('tbl_sliders', $data);
}

function get_list_slider() {
    return db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = 'Công khai'");
}

function get_list_slider_wait() {
    return db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = 'Chờ duyệt'");
}

function get_num_slider_public() {
    return db_num_rows("SELECT * FROM `tbl_sliders` WHERE `status` = 'Công khai'");
}

function get_num_slider_wait() {
    return db_num_rows("SELECT * FROM `tbl_sliders` WHERE `status` = 'Chờ duyệt'");
}

function update_action($data, $id) {
    return db_update('tbl_sliders', $data, "`slider_id` IN ($id)");
}

function delete_action($id) {
    return db_delete('tbl_sliders', "`slider_id` IN ($id)");
}

?>