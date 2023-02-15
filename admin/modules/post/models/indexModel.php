
<?php

function add_post($data) {
    return db_insert('tbl_posts', $data);
}

function get_list_restore() {
    return db_fetch_array("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Khôi phục'");
}

function get_post_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_posts` WHERE `id` = '{$id}'");
}

function edit_post($data, $id) {
    return db_update('tbl_posts', $data, "`id` = '{$id}'");
}

function delete_post_by_id($id) {
    return db_delete('tbl_posts', "`id` = '{$id}'");
}

function update_action($data, $id) {
    return db_update('tbl_posts', $data, "`id` IN ($id) ");
}

function get_list_public() {
    return db_fetch_array("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Khôi phục' AND `public_wait` = 'Công khai'");
}

function get_list_wait() {
    return db_fetch_array("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Khôi phục' AND `public_wait` = 'Chờ duyệt'");
}

function get_list_trash() {
    return db_fetch_array("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Xoá tạm thời'");
}
function delete_action($id) {
    return db_delete('tbl_posts', "`id` IN ($id)");
}


function get_num_restore() {
    return db_num_rows("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Khôi phục'");
}

function get_num_public() {
    return db_num_rows("SELECT * FROM `tbl_posts` WHERE `public_wait` = 'Công khai' AND `restore_trash` = 'Khôi phục'");
}

function get_num_wait() {
    return db_num_rows("SELECT * FROM `tbl_posts` WHERE `public_wait` = 'Chờ duyệt' AND `restore_trash` = 'Khôi phục'");
}

function get_num_trash() {
    return db_num_rows("SELECT * FROM `tbl_posts` WHERE `restore_trash` = 'Xoá tạm thời'");
}

function get_list_by_search($keyword) {
    return db_fetch_array("SELECT * FROM `tbl_posts` WHERE `title` LIKE '%$keyword%'");
}

function get_post_cat() {
    return db_fetch_array("SELECT * FROM `tbl_posts_cat`");
}

function data_tree($data, $parent_id, $level = 0 ) {
    $result = [];
    foreach($data as $item) {
        $item['level'] = $level;
        if($item['parent_id'] == $parent_id) {
            $result [] = $item;
            $child = data_tree($data, $item['cat_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

function add_cat($data) {
    return db_insert('tbl_posts_cat', $data);
}

function get_cat_name() {
    return db_fetch_array("SELECT  `tbl_posts_cat`.`cat_name`, `tbl_posts_cat`.`cat_id`   FROM `tbl_posts_cat` RIGHT JOIN `tbl_posts` ON `tbl_posts_cat`. `cat_id` = `tbl_posts`.`cat_id`");
}

function print_cat_name($cat_name, $cat_id) {
    foreach($cat_name as $item) {
        if($item['cat_id'] == $cat_id) {
            return $item['cat_name'];
        }
    }
}

function delete_cat( $cat_id) {
    return db_delete('tbl_posts_cat', "`cat_id` = '{$cat_id}'");
}

function get_cat_by_cat_id($cat_id) {
    return db_fetch_row("SELECT * FROM `tbl_posts_cat` WHERE `cat_id` = '{$cat_id}'");
}

function edit_cat($data, $cat_id) {
    return db_update('tbl_posts_cat', $data, "`cat_id` = '{$cat_id}'");
}


?>