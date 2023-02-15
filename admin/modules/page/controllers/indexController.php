
<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
}


function addAction() {
    if(isset($_POST['btn-add'])) {
        global $error;
        if(empty($_POST['title'])) {
            $error ['title'] = "Không để trống tiêu đề";
        }else {
            $title = $_POST['title'];
        }

        if(empty($_POST['desc'])) {
            $error ['desc'] = "Không để trống nội dung trang";
        }else {
            $desc = $_POST['desc'];
        }

        if(!empty($title)) {
            $slug = create_slug($title);
        }

        $created_by = $_SESSION['user_login'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        // $timestamp = time();
        $created_date = date('Y-m-d H:i:s');
        if(empty($error)) {
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $desc,
                'created_date' => $created_date,
                'created_by' => $created_by
            );
            add_page($data);
            $error ['notifi'] = "Thêm trang thành công !";
        }
    }
    load_view('add');
}


function listPageAction() {

    if(isset($_POST['sm_action'])) {
       if(isset($_POST['actions'])) {
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Công khai"
            );
            update_action($data, $id);
        }

        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Chờ duyệt"
            );
            update_action($data, $id);
           }

        if($_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'trash_status' => "Xoá tạm thời" 
            );
            update_action($data, $id);
        }
       }
       
         
   }


   $list_page = get_list_page_restore();
   $num_page = get_num_page();
   $num_page_public = get_num_page_public();
   $num_page_wait = get_num_page_wait();

   $data['list_page'] = $list_page;
   $data['num_page'] = $num_page;
   $data['num_page_public'] = $num_page_public;
   $data['num_page_wait'] = $num_page_wait;

   $num_page_temporary = get_num_page_temporary();
   $data['num_page_temporary'] = $num_page_temporary;

    load_view('listPage', $data);
}




function editAction() {
    $id = (int) $_GET['id'];
    $list_page = get_list_page();

    if(isset($_POST['btn-edit'])) {
        global $error;
        if(empty($_POST['title'])) {
            $error ['title'] = "Không để trống tiêu đề";
        }else {
            $title = $_POST['title'];
        }

        if(empty($_POST['desc'])) {
            $error ['desc'] = "Không để trống nội dung trang";
        }else {
            $desc = $_POST['desc'];
        }
       
        if(!empty($title)) {
            $slug = create_slug($title);
        }

        if(empty($error)) {
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $desc
            );
            edit_db($data, $id);
            $error ['notifi'] = "Chỉnh sửa trang thành công !";
        }
    }
    $page_by_id = get_page_by_id($id);
    $data['page_by_id'] = $page_by_id;

    load_view('edit', $data);
}

function deleteAction() {
    $list_page = get_list_page();

    $id = (int) $_GET ['id'];
    delete_action($id);
    redirect("?mod=page&action=listPage");
    
}

function trashAction() {

    if(isset($_POST['sm_action'])) {
        if(isset($_POST['actions'])) {
         if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'trash_status' => "Khôi phục"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            
           delete_action($id);
        }
    }

}
    $list_page = get_list_page_temporary();
    $num_page = get_num_page();
    $num_page_temporary = get_num_page_temporary();
    $num_page_public = get_num_page_public();
    $num_page_wait = get_num_page_wait();

    $data['list_page'] = $list_page;
    $data['num_page'] = $num_page;
    $data['num_page_temporary'] = $num_page_temporary;
    $data['num_page_public'] = $num_page_public;
    $data['num_page_wait'] = $num_page_wait;

    load_view('trash', $data);
}

function publicAction() {

    if(isset($_POST['sm_action'])) {
        if(isset($_POST['actions'])) {
         if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Chờ duyệt"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'trash_status' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

}

    $list_page = get_list_page_public();
    $num_page = get_num_page();
    $num_page_public = get_num_page_public();
    $num_page_wait = get_num_page_wait();
    $num_page_temporary = get_num_page_temporary();

    $data['list_page'] = $list_page;
    $data['num_page'] = $num_page;
    $data['num_page_public'] = $num_page_public;
    $data['num_page_wait'] = $num_page_wait;
    $data['num_page_temporary'] = $num_page_temporary;

    load_view('public', $data);
}

function waitAction() {

    if(isset($_POST['sm_action'])) {
        if(isset($_POST['actions'])) {
         if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Công khai"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'trash_status' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

}

    $list_page = get_list_page_wait();
    $num_page = get_num_page();
    $num_page_public = get_num_page_public();
    $num_page_wait = get_num_page_wait();
    $num_page_temporary = get_num_page_temporary();

    $data['list_page'] = $list_page;

    $data['num_page'] = $num_page;
    $data['num_page_public'] = $num_page_public;
    $data['num_page_wait'] = $num_page_wait;
    $data['num_page_temporary'] = $num_page_temporary;

    load_view('wait', $data);
}

?>