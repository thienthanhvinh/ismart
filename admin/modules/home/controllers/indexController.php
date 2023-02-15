

<?php
function construct() {
    load_model('index');
}

function indexAction() {

    $num_customer = get_num_customer();
    $num_per_page = 6;
    $num_page = ceil($num_customer / $num_per_page);
    
    // echo "Số trang là: {$num_page}";
    if(isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    }else {
        $page = 1;
    }
    // Tính bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;

    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $list_customer = get_list_customer($start, $num_per_page);
    $data['list_customer']= $list_customer;
    $num_complete = get_num_order_complete();
    $data['num_complete'] = $num_complete;
    $num_process = get_num_order_process();
    $data['num_process'] = $num_process;
    $num_transport = get_num_order_transport();
    $data['num_transport'] = $num_transport;
    $num_cancel = get_num_order_cancel();
    $data['num_cancel'] = $num_cancel;
    $list_complete = get_list_order_complete();
    $final_total = get_final_total($list_complete);
    $data['final_total'] = $final_total;
    
    load_view('index', $data);
}


?>