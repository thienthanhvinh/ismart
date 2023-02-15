
<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
}

function indexAction() {
    $page_data = get_page_data();
    $data['page_data'] = $page_data; 
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    $list_oustanding = get_product_outstanding();
    $data['list_outstanding'] = $list_oustanding;
    $list_discount = get_product_have_discount();
    $data['list_discount'] = $list_discount;
    $list_date = get_product_by_date();
    $data['list_date'] = $list_date;
    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;
    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;
    $list_best_sale = get_list_product();
    $data['list_best_sale'] = $list_best_sale;
    $list_slider = get_list_slider();
    $data['list_slider'] = $list_slider;
    

    load_view('index', $data);
    
   

}


?>