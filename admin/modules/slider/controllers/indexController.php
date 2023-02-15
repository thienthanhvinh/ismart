
<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
}


function addAction() {
    if(isset($_POST['btn-add'])) {
        global $error;
        $error = array();
        $link = $_POST['link'];
        
        $img_name = $_FILES['file_slider']['name'];
        $upload_dir = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/sliders/';
        $upload_file = $upload_dir . basename($_FILES['file_slider']['name']);
        move_uploaded_file($_FILES['file_slider']['tmp_name'], $upload_file);
        $status = $_POST['status'];
        $created_by = $_SESSION['user_login'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $created_date = date('Y-m-d H:i:s');


        if(!empty($img_name)) {
            if(empty($error)) {
                $data = array(
                    'link' => $link,
                    'thumb_slider' => $img_name,
                    'status' => $status,
                    'created_by' => $created_by,
                    'created_date' => $created_date
                );
                add_slider($data);
                $error['notifi'] = "Thêm mới slider thành công";
            };
         
        }else {
            $error['file_slider'] = "Không được để trống hình ảnh";
        }


    }
    load_view('add');
}

function listPublicAction() {

    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Chờ duyệt"
            );

            update_action($data, $id);
        }
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            delete_action($id);
        }
    }

    $list_slider = get_list_slider();
    $data['list_slider'] = $list_slider;
    $num_public = get_num_slider_public();
    $data['num_public'] = $num_public;
    $num_wait = get_num_slider_wait();
    $data['num_wait'] = $num_wait;

    

    load_view('listPublic', $data);
}

function listWaitAction() {
    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Công khai"
            );

            update_action($data, $id);
        }
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            delete_action($id);
        }
    }

    $list_slider = get_list_slider_wait();
    $data['list_slider'] = $list_slider;
    $num_public = get_num_slider_public();
    $data['num_public'] = $num_public;
    $num_wait = get_num_slider_wait();
    $data['num_wait'] = $num_wait;
    
    load_view('listWait', $data);
}

// function imageAjaxAction() {

//     $img_name = $_GET['image_name'];
//     if(!empty($img_name)) {
//         $test = explode(".", $img_name);
//         $extension = end($test);
//         $name = rand(100, 999) . '.' .$extension;
//         $location = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/sliders_ajax/' .$name;
//         move_uploaded_file($_FILES["file_slider"]["tmp_name"], $location);
//         echo '<img src = "'. $location .'" />';
//     }
// }

?>