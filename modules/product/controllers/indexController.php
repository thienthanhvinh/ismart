
<?php
function construct() {
    load_model('index');

}

function listAction() {
    // $cat_id = (int) $_GET['cat_id'];
    $slug = $_GET['slug'];
    $page_data = get_page_data();
    $data['page_data'] = $page_data;
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    
    $cat_id = get_cat_id($list_cat, $slug);
    $data['cat_id'] = $cat_id;

    $cat_name = get_cat_name($cat_id);
    $data['cat_name'] = $cat_name;
    
     //Xử lý phân trang
     $num_product = get_num_product($cat_id);
     $num_child =  get_num_child($cat_id);
     $num_per_page = 3;
     $num_page = ceil($num_product / $num_per_page) OR $num_page = ($num_child / $num_per_page);
     
     // echo "Số trang là: {$num_page}";
     if(isset($_GET['page'])) {
         $page = (int) $_GET['page'];
     }else {
         $page = 1;
     }
 
     $start = ($page - 1) * $num_per_page;

    if(!empty($cat_id)) {
        $list_product =  get_product_by_cat_id($start, $num_per_page, $cat_id) OR $list_product = get_product_by_child_id($start, $num_per_page, $cat_id);
        $data['list_product'] = $list_product; 
   
    }


    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;
    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;

   
    // $list_product = get_list_product_paging($start, $num_per_page, $cat_id); 
    // $data['list_product'] = $list_product;
    $data['num_product'] = $num_product;
    $data['num_page'] = $num_page;
    $data['page'] = $page;


    load_view('list', $data);
}

function detailAction() {
    $slug = $_GET['slug'];
    $data['slug'] = $slug;
    $page_data = get_page_data();
    $data['page_data'] = $page_data;
    $product = get_product_by_slug($slug);
    $data['product'] = $product;
    $list_product = get_list_all_product();
    $id = get_product_id($list_product, $slug);
    $product_image = get_product_image($id);
    $data['product_image'] = $product_image;
    $list_color = get_list_color();
    $data['list_color'] = $list_color;
    $product_same = get_product_same_cat($product['cat_id'], $id);
    $data['product_same'] = $product_same;
    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    $cat_id = get_cat_id($list_cat, $slug);
    $data['cat_id'] = $cat_id;
    $cat_name = get_cat_name($cat_id);
    $data['cat_name'] = $cat_name;

    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;
    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;
    
    load_view('detail', $data);
}

function addAction() {
    $id = (int) $_GET['id'];
    add_cart($id);
    redirect("gio-hang");
}

function filterAjaxAction() {
    $price = strtoupper($_GET['price']);
    $list_cat = get_list_cat();
    $slug = $_GET['slug'];  
    $cat_id = get_cat_id($list_cat, $slug);
    $cat_name = get_cat_name($cat_id);
    
    $list_filter = filter_product_by_price($price, $cat_id);
    $data['list_filter'] = $list_filter;
    $list_filter_child = filter_product_child($price, $cat_id);
    $output = '';
    $op_paging = '';
    
    if(!empty($list_filter)) {
    foreach($list_filter as $item) {
        $output .= '
        <li>
        <a href="'. get_cat_name_index($list_cat, $item['cat_id']).'/'. $item['slug'] .'.html" title="" class="thumb">
            <img src="public/uploads/images/products/'. $item['thumb'] .'" class="img-index">
        </a>
        <a href="'.get_cat_name_index($list_cat, $item['cat_id']).'/'. $item['slug'] .'.html" title="" class="product-name">'. $item['name'] .'</a>
        <div class="price">
            <span class="new">'. currency_format ($item['price']) .'</span>
            <span class="old">'. print_old_price($item['old_price']) .'</span>
        </div>
        <div class="action clearfix">
        <button type = "submit" title="Thêm giỏ hàng" data-id = '. $item['product_id'] .' class="add-cart fl-left" data-toggle = "modal" data-target="#myModal">Thêm giỏ hàng</button>
            <a href="?mod=cart&action=buyNow&id='. $item['product_id'] .'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
        </div>
    </li>
        ';
    }
    }elseif(!empty($list_filter_child)) {
        foreach($list_filter_child as $item) {
            $output .= '
            <li>
            <a href="'.get_cat_name_index($list_cat, $item['cat_id']).'/'. $item['slug'] .'.html" title="" class="thumb">
                <img src="public/uploads/images/products/'. $item['thumb'] .'" class="img-index">
            </a>
            <a href="'.get_cat_name_index($list_cat, $item['cat_id']).'/'. $item['slug'] .'.html" title="" class="product-name">'. $item['name'] .'</a>
            <div class="price">
                <span class="new">'. currency_format ($item['price']) .'</span>
                <span class="old">'. print_old_price($item['old_price']) .'</span>
            </div>
            <div class="action clearfix">
                <button type = "submit" title="Thêm giỏ hàng" data-id='. $item['product_id'] .' class="add-cart fl-left" data-toggle = "modal" data-target="#myModal">Thêm giỏ hàng</button>
                <a href="mua-ngay-'. $item['product_id'] .'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
            </div>
        </li>
            ';
        }
    }

    else {
        $output .= '
            <p style="font-size: 16px; color: red; text-align: center;margin-top: 50px; margin-bottom: 40px">Không tìm thấy sản phẩm phù hợp. Bạn vui lòng chọn mức giá khác</p>
            <img src="public/images/filter-1.png" alt="" style= "width: 300px; height: auto">
        ';
        $op_paging .= '
        <div class="section-detail-paging"></div>
        ';
    }
    


    $data = array(
        'output' => $output,
        'op_paging' => $op_paging 
    );

    echo json_encode($data);
}

function searchAction() {

    if(!empty($_POST['search'])) {
        $keyword = $_POST['search'];
        $list_product = get_product_by_search($keyword);
        $num_product = get_num_product_by_search($keyword);
        $data['list_product'] = $list_product;
        $data['num_product'] = $num_product;
        $data['keyword'] = $keyword;
    
    }else {
        redirect("http://localhost/ismart.com/");
    }

        $page_data = get_page_data();
        $data['page_data'] = $page_data;
        $num_order_cart = get_num_order_cart();
        $data['num_order_cart'] = $num_order_cart;
        $list_cart = get_list_buy_cart();
        $data['list_cart'] = $list_cart;
        $total = get_total_cart();
        $data['total'] = $total;
        $list_cat = get_list_cat();
        $data['list_cat'] = $list_cat;
        


    load_view('search', $data);

}

function searchAjaxAction() {
    $keyword = $_GET['keyword'];
    $list_cat = get_list_cat();
    $list_product = get_product_by_search($keyword);
    $output = '';

    if(!empty($keyword)) {
    foreach(array_slice($list_product,0 ,3) as $item) {
        $output = '
        <ul class="list-result">
            <li>
                <a href="'. get_cat_name_index($list_cat, $item['cat_id']).'/'. $item['slug'] .'.html">
                    <div class="img-product">
                        <img src="public/uploads/images/products/'. $item['thumb'] .'">
                    </div>
                    <div class="info-product">
                        <p class="pr-name">'. $item['name'] .'</p>
                        <span class="new-price">'. currency_format ($item['price']) .'</span><span class="old-price">'. print_old_price ($item['old_price']) .'</span>
                        
                    </div>
                </a>    
            </li>
        </ul>
        ';
        echo $output;
    }
}

}

?>






