
<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
}


function detailAction() {
    $page_data = get_page_data();
    $data['page_data'] = $page_data;

    // $id = (int) $_GET['id'];
    // $data_by_id = get_page_data_by_id($id);
    // $data['data_by_id'] = $data_by_id;

    $slug = $_GET['slug'];
    $data_by_slug = get_page_data_by_slug($slug);
    $data['data_by_slug'] = $data_by_slug;

    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;
    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;

    load_view('detail', $data);
}
// function contactAction() {
//     load_view('contact');
// }


?>