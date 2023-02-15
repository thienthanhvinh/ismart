
<?php
function construct() {
    load_model('index');
    load('lib','validation');
}

function listAction() {


    if(isset($_POST['sm_action'])) {
        if( $_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);

            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang xử lý",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);

            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang vận chuyển",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Hoàn thành",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 4 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Huỷ đơn",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 5 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['s'])) {
        if(empty($_POST['s'])) {
            redirect("?mod=order&action=list");
        }else {
            if(isset($_GET['page'])) {
                $page = (int) $_GET['page'];
            }else {
                $page = 1;
            }

            $num_per_page = 8;
            // Tính bản ghi bắt đầu
            $start = ($page - 1) * $num_per_page;
            $keyword = $_POST['s'];
            $list_order = get_list_order_by_search($keyword, $start, $num_per_page);
            $data['list_order'] = $list_order;

            $num_order = get_num_order();
            $num_order_search = get_num_order_list_search($keyword);           
            $num_page = ceil($num_order_search / $num_per_page);
            
            $data['num_page'] = $num_page;
            $data['page'] = $page;
            
        }
    }else {
        if(isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }else {
            $page = 1;
        }
        $num_per_page = 8;
        $start = ($page - 1) * $num_per_page;
        $list_order = get_list_order($start, $num_per_page);
        $data['list_order'] = $list_order;
        $num_order = get_num_order();
        
        $num_page = ceil($num_order / $num_per_page);
        $data['num_page'] = $num_page;
        $data['page'] = $page;
    }

    // echo "Số trang là: {$num_page}";  
    $data['num_order'] = $num_order;  

    $num_process = get_num_process();
    $data['num_process'] = $num_process;

    $num_transport = get_num_transport();
    $data['num_transport'] = $num_transport;

    $num_complete = get_num_complete();
    $data['num_complete'] = $num_complete;

    $num_cancel = get_num_cancel();
    $data['num_cancel'] = $num_cancel;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    load_view('list', $data);
}

function customerAction() {
    load_view('customer');
}

function detailAction() {
    $id = (int) $_GET['id'];

    if(isset($_POST['btn-edit'])) {
        if($_POST['sl-status'] == 1) {
            $data = array(
                'status' => 'Đang xử lý'
            );
            update_status($data, $id);
        }
        if($_POST['sl-status'] == 2) {
            $data = array(
                'status' => 'Đang vận chuyển'
            );
            update_status($data, $id);
        }
        if($_POST['sl-status'] == 3) {
            $data = array(
                'status' => 'Hoàn thành'
            );
            update_status($data, $id);
        }
        if($_POST['sl-status'] == 4) {
            $data = array(
                'status' => 'Huỷ đơn'
            );
            update_status($data, $id);
        }
    }

    $order_by_id = get_order_by_id($id);
    $data['order_by_id'] = $order_by_id;
    $order_detail = get_order_detail_by_id($id);
    $data['order_detail'] = $order_detail;
    $list_city = get_list_city();
    $data['list_city'] = $list_city;
    $list_district = get_list_district();
    $data['list_district'] = $list_district;
    $list_wards = get_list_wards();
    $data['list_wards'] = $list_wards;

 

    load_view('detail', $data);
}



function deleteAction() {
    $id = (int) $_GET['id'];
    $page = (int) $_GET['page'];
    if(!empty($_GET['page'])) {
        delete_action($id);
        redirect("?mod=order&action=list&page={$page}");
    }else {
        delete_action($id);
         redirect("?mod=order&action=list");
    }
}

function processAction() {

    if(isset($_POST['sm_action'])) {

        if( $_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang vận chuyển",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Hoàn thành",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 4 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Huỷ đơn",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 5 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['s'])) {
        if(empty($_POST['s'])) {
            redirect("?mod=order&action=process");
        }else {
            if(isset($_GET['page'])) {
                $page = (int) $_GET['page'];
            }else {
                $page = 1;
            }

            $num_per_page = 8;
            // Tính bản ghi bắt đầu
            $start = ($page - 1) * $num_per_page;
            $keyword = $_POST['s'];
            $list_order = get_list_process_by_search($keyword, $start, $num_per_page);
            $data['list_order'] = $list_order;

            $num_order = get_num_process();
            $num_order_search = get_num_order_process_search($keyword);           
            $num_page = ceil($num_order_search / $num_per_page);
            
            $data['num_page'] = $num_page;
            $data['page'] = $page;
            
        }
    }else {
        if(isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }else {
            $page = 1;
        }
        $num_per_page = 8;
        $start = ($page - 1) * $num_per_page;
        $list_order = get_list_process($start, $num_per_page);
        $data['list_order'] = $list_order;
        $num_order = get_num_process();
        
        $num_page = ceil($num_order / $num_per_page);
        $data['num_page'] = $num_page;
        $data['page'] = $page;
    }

    // echo "Số trang là: {$num_page}";  
    $data['num_order'] = $num_order; 

    $num_process = get_num_process();
    $data['num_process'] = $num_process;

    $num_transport = get_num_transport();
    $data['num_transport'] = $num_transport;

    $num_complete = get_num_complete();
    $data['num_complete'] = $num_complete;

    $num_cancel = get_num_cancel();
    $data['num_cancel'] = $num_cancel;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    

    load_view('process', $data);
}

function transportAction() {

    if(isset($_POST['sm_action'])) {
        if( $_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang xử lý",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
           
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Hoàn thành",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 4 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Huỷ đơn",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 5 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['s'])) {
        if(empty($_POST['s'])) {
            redirect("?mod=order&action=transport");
        }else {
            if(isset($_GET['page'])) {
                $page = (int) $_GET['page'];
            }else {
                $page = 1;
            }

            $num_per_page = 8;
            // Tính bản ghi bắt đầu
            $start = ($page - 1) * $num_per_page;
            $keyword = $_POST['s'];
            $list_order = get_list_transport_by_search($keyword, $start, $num_per_page);
            $data['list_order'] = $list_order;

            $num_order = get_num_transport();
            $num_order_search = get_num_order_transport_search($keyword);           
            $num_page = ceil($num_order_search / $num_per_page);
            
            $data['num_page'] = $num_page;
            $data['page'] = $page;
            
        }
    }else {
        if(isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }else {
            $page = 1;
        }
        $num_per_page = 8;
        $start = ($page - 1) * $num_per_page;
        $list_order = get_list_transport($start, $num_per_page);
        $data['list_order'] = $list_order;
        $num_order = get_num_transport();
        
        $num_page = ceil($num_order / $num_per_page);

        $data['num_page'] = $num_page;
        $data['page'] = $page;
    }

    $data['num_order'] = $num_order; 



    $num_order = get_num_order();
    $data['num_order'] = $num_order;

    $num_process = get_num_process();
    $data['num_process'] = $num_process;

    $num_transport = get_num_transport();
    $data['num_transport'] = $num_transport;

    $num_complete = get_num_complete();
    $data['num_complete'] = $num_complete;

    $num_cancel = get_num_cancel();
    $data['num_cancel'] = $num_cancel;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    load_view('transport', $data);
}

function completeAction() {
    if(isset($_POST['sm_action'])) {
        if( $_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
           
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang xử lý",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang vận chuyển",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
       
        if( $_POST['actions'] == 4 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Huỷ đơn",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 5 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['s'])) {
        if(empty($_POST['s'])) {
            redirect("?mod=order&action=complete");
        }else {
            if(isset($_GET['page'])) {
                $page = (int) $_GET['page'];
            }else {
                $page = 1;
            }

            $num_per_page = 8;
            // Tính bản ghi bắt đầu
            $start = ($page - 1) * $num_per_page;
            $keyword = $_POST['s'];
            $list_order = get_list_complete_by_search($keyword, $start, $num_per_page);
            $data['list_order'] = $list_order;

            $num_order = get_num_complete();
            $num_order_search = get_num_order_complete_search($keyword);           
            $num_page = ceil($num_order_search / $num_per_page);
            
            $data['num_page'] = $num_page;
            $data['page'] = $page;
            
        }
    }else {
        if(isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }else {
            $page = 1;
        }
        $num_per_page = 8;
        $start = ($page - 1) * $num_per_page;
        $list_order = get_list_complete($start, $num_per_page);
        $data['list_order'] = $list_order;
        $num_order = get_num_complete();
        
        $num_page = ceil($num_order / $num_per_page);
        
        $data['num_page'] = $num_page;
        $data['page'] = $page;
    }

    // echo "Số trang là: {$num_page}";  
    $data['num_order'] = $num_order; 

    $num_process = get_num_process();
    $data['num_process'] = $num_process;

    $num_transport = get_num_transport();
    $data['num_transport'] = $num_transport;

    $num_complete = get_num_complete();
    $data['num_complete'] = $num_complete;

    $num_cancel = get_num_cancel();
    $data['num_cancel'] = $num_cancel;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    load_view('complete', $data);
}

function cancelAction() {

    if(isset($_POST['sm_action'])) {
        if( $_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang xử lý",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Đang vận chuyển",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
        if( $_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $edit_date = date('Y-m-d H:i:s');
            
            $data = array(
                'status' => "Hoàn thành",
                'edit_date' => $edit_date
            );
            update_status($data, $id);
        }
      
        if( $_POST['actions'] == 5 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['s'])) {
        if(empty($_POST['s'])) {
            redirect("?mod=order&action=cancel");
        }else {
            if(isset($_GET['page'])) {
                $page = (int) $_GET['page'];
            }else {
                $page = 1;
            }

            $num_per_page = 8;
            // Tính bản ghi bắt đầu
            $start = ($page - 1) * $num_per_page;
            $keyword = $_POST['s'];
            $list_order = get_list_cancel_by_search($keyword, $start, $num_per_page);
            $data['list_order'] = $list_order;

            $num_order = get_num_cancel();
            $num_order_search = get_num_order_cancel_search($keyword);           
            $num_page = ceil($num_order_search / $num_per_page);
            
            $data['num_page'] = $num_page;
            $data['page'] = $page;
            
        }
    }else {
        if(isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }else {
            $page = 1;
        }
        $num_per_page = 8;
        $start = ($page - 1) * $num_per_page;
        $list_order = get_list_cancel($start, $num_per_page);
        $data['list_order'] = $list_order;
        $num_order = get_num_cancel();
        
        $num_page = ceil($num_order / $num_per_page);
        
        $data['num_page'] = $num_page;
        $data['page'] = $page;
    }

    // echo "Số trang là: {$num_page}";  
    $data['num_order'] = $num_order; 

    $num_process = get_num_process();
    $data['num_process'] = $num_process;

    $num_transport = get_num_transport();
    $data['num_transport'] = $num_transport;

    $num_complete = get_num_complete();
    $data['num_complete'] = $num_complete;

    $num_cancel = get_num_cancel();
    $data['num_cancel'] = $num_cancel;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    load_view('cancel', $data);
}

function trashAction() {
    if(isset($_POST['sm_action'])) {
        if( $_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Khôi phục"
            );
            update_action($data, $id);
        }
        if( $_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
           
            delete_action_many_order($id);
        }
    }

    $list_order = get_list_trash();
    $data['list_order'] = $list_order;

    $num_order = get_num_order();
    $data['num_order'] = $num_order;

    $num_process = get_num_process();
    $data['num_process'] = $num_process;

    $num_transport = get_num_transport();
    $data['num_transport'] = $num_transport;

    $num_complete = get_num_complete();
    $data['num_complete'] = $num_complete;

    $num_cancel = get_num_cancel();
    $data['num_cancel'] = $num_cancel;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    load_view('trash', $data);
}



?>