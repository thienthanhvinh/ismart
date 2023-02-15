
<?php
function construct() {
    load_model('index');
}

function listAction() {
    $page_data = get_page_data();
    $data['page_data'] = $page_data;
    $post_data = get_post_data();
    $data['post_data'] = $post_data;
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;
    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;
    $list_best_sale = get_list_product();
    $data['list_best_sale'] = $list_best_sale;

    load_view('list', $data);
}

function detailAction() {
    $page_data = get_page_data();
    $data['page_data'] = $page_data;
    // $id = (int) $_GET['id'];
    // $data_by_id = get_post_data_by_id($id);
    // $data['data_by_id'] = $data_by_id;
    $slug = $_GET['slug'];
    $data_by_slug = get_post_data_by_slug($slug);
    $data['data_by_slug'] = $data_by_slug;
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;

    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;
    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;

    load_view('detail', $data);
}

?>