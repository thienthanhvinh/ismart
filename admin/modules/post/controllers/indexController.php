
<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
}

function addAction() {
    if(isset($_POST['btn-add'])) {
        global $error;
        $error = array();
        if(empty($_POST['title'])) {
            $error ['title'] = "Không để trống tiêu đề bài viết";
        }else {
            $title = $_POST['title'];
        }

        if(empty($_POST['desc'])) {
            $error ['desc'] = "Không để trống mô tả bài viết";
        }else {
            $desc = $_POST['desc'];
        }

        if(empty($_POST['content'])) {
            $error ['content'] = "Không để trống nội dung bài viết";
        }else {
            $content = $_POST['content'];
        }
        
            $img_name = $_FILES['file']['name'];
            $upload_dir = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/posts/';
            $upload_file = $upload_dir . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);

            if(!empty($title)) {
                $slug = create_slug($title);
            }
            $created_by = $_SESSION['user_login'];
            $cat_id = $_POST['cat-post'];
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $created_date = date('Y-m-d H:i:s');
            $status = $_POST['status'];

            if(!empty($img_name)) {
                if(empty($error)) {    
                    $data = array(
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'post_desc' => $desc,
                        'created_date' => $created_date,
                        'cat_id' => $cat_id,
                        'image' => $img_name,
                        'public_wait' => $status,
                        'created_by' => $created_by
                    );
                    add_post($data);
                    $error ['notifi'] = "Thêm bài viết thành công !"; 
                }
            }else {
                    $error ['file'] = "Không để trống hình ảnh";
                }
                   
    }

    $list_cat = get_post_cat();
    $data['list_cat'] = $list_cat;
    $list_cat_1 = data_tree($list_cat, 0);
    $data['list_cat_1'] = $list_cat_1;

    load_view('add', $data);
}


function listAction() {
    if(isset($_POST['sm_action'])) {
        if( $_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'public_wait' => "Công khai"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id =implode(',', $_POST['checkItem']);
            $data = array(
                'public_wait' => "Chờ duyệt"
            );
            update_action($data, $id);
            
        }
        if($_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id =implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
            
        }
    }


    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $list_post = get_list_by_search($keyword);
        $data['list_post'] = $list_post;
    }else {
        $list_post = get_list_restore();
        $data['list_post'] = $list_post;
    }


    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_public = get_num_public();
    $data['num_public'] = $num_public;
    $num_wait = get_num_wait();
    $data['num_wait'] = $num_wait;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    // Lấy tên danh mục từ bảng tbl_posts_cat
    $cat_name = get_cat_name();
    $data['cat_name'] = $cat_name;

    load_view('list', $data);
}


function editAction() {
    $post_id = (int) $_GET['id'];
    
    if(isset($_POST['btn-edit'])) {
        global $error;
        $error = array();
        if(empty($_POST['title'])) {
            $error['title'] =  "Không để trống tiêu đề";
        }else {
            $title = $_POST['title'];
        }

        if(empty($_POST['desc'])) {
            $error ['desc'] = "Không để trống mô tả bài viết";
        }else {
            $desc = $_POST['desc'];
        }

        if(empty($_POST['content'])) {
            $error ['content'] = "Không để trống nội dung bài viết";
        }else {
            $content = $_POST['content'];
        }
        $img_name = $_FILES['file']['name'];
            $upload_dir = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/posts/';
            $upload_file = $upload_dir . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);

            if(!empty($title)) {
                $slug = create_slug($title);
            }
            
            $cat_id = $_POST['cat-post'];
            
            if(!empty($img_name)) {
                if(empty($error)) {
                    $data = array(
                        'title' => $title,
                        'slug' => $slug,
                        'post_desc' => $desc,
                        'content' => $content,
                        'cat_id' => $cat_id,
                        'image' => $img_name,
                    );
                    edit_post($data, $post_id);
                    $error ['notifi'] = "Chỉnh sửa bài viết thành công !"; 
                }
            }else {
                if(empty($error)) {
                $data = array(
                    'title' => $title,
                    'slug' => $slug,
                    'post_desc' => $desc,
                    'content' => $content,
                    'cat_id' => $cat_id
                );
                edit_post($data, $post_id);
                $error['notifi'] = "Chỉnh sửa bài viết thành công !";
                }
            }
    }
   
    $post = get_post_by_id($post_id);
    $data['post'] = $post;
    $list_cat = get_post_cat();
    $data['list_cat'] = $list_cat;
    $list_cat_1 = data_tree($list_cat, 0);
    $data['list_cat_1'] = $list_cat_1;
   
    load_view('edit', $data);
}


function publicAction() {

    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'public_wait' => "Chờ duyệt"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $list_post = get_list_by_search($keyword);
        $data['list_post'] = $list_post;
    }else {
        $list_post  = get_list_public();
        $data['list_post'] = $list_post;
    }

    

    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_public = get_num_public();
    $data['num_public'] = $num_public;
    $num_wait = get_num_wait();
    $data['num_wait'] = $num_wait;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;
    
    $cat_name = get_cat_name();
    $data['cat_name'] = $cat_name;

    
    
    load_view('public', $data);
}

function waitAction() {
    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'public_wait' => "Công khai"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 3 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $list_post = get_list_by_search($keyword);
        $data['list_post'] = $list_post;
    }else {
        $list_post  = get_list_wait();
        $data['list_post'] = $list_post;
    }
    
    

    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_public = get_num_public();
    $data['num_public'] = $num_public;
    $num_wait = get_num_wait();
    $data['num_wait'] = $num_wait;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    $cat_name = get_cat_name();
    $data['cat_name'] = $cat_name;

    load_view('wait', $data);
}

function trashAction() {
    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Khôi phục"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            delete_action($id);
        }
    }

    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $list_post = get_list_by_search($keyword);
        $data['list_post'] = $list_post;
    }else {
        $list_post  = get_list_trash();
        $data['list_post'] = $list_post;
    }

    

    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_public = get_num_public();
    $data['num_public'] = $num_public;
    $num_wait = get_num_wait();
    $data['num_wait'] = $num_wait;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;

    $cat_name = get_cat_name();
    $data['cat_name'] = $cat_name;

    load_view('trash', $data);
}

function deleteAction() {
    $post_id = (int) $_GET['id'];
    delete_post_by_id($post_id);
    redirect("?mod=post&action=list");
}


function catAction() {
    $list_cat = get_post_cat();
    $data['list_cat'] = $list_cat;
    $list_cat_name = data_tree($list_cat, 0);
    $data['list_cat_name'] = $list_cat_name;
    load_view('cat', $data);
}


function addCatAction() {

    if(isset($_POST['btn-add'])) {
        global $error;
        $error = array();
        if(empty($_POST['cat-name'])) {
            $error ['cat-name'] = "Không được để trống tên danh mục";
        }else {
            $cat_name = $_POST['cat-name'];
        }
        if(empty($_POST['slug'])) {
            $error ['slug'] = "Không được để trống slug";
        }else {
            $slug = $_POST['slug'];
        }
        
        $parent_id = $_POST['parent-Cat'];
        $created_by = $_SESSION['user_login'];

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $created_date = date('Y-m-d H:i:s');

        if(empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'slug' => $slug,
                'parent_id' => $parent_id,
                'created_by' => $created_by,
                'created_date' => $created_date
            );
            add_cat($data);
            $error['notifi'] = "Thêm danh mục thành công";
        }
    }

    $list_cat = get_post_cat();
    $data['list_cat'] = $list_cat;
    $list_cat_1 = data_tree($list_cat, 0);
    $data['list_cat_1'] = $list_cat_1;
    load_view('addCat', $data);
}

function deleteCatAction() {
    $cat_id = $_GET['cat_id'];
    delete_cat($cat_id);
    redirect("post/cat");
}


function editCatAction() {
    $cat_id = $_GET['cat_id'];
    
    if(isset($_POST['btn-edit'])) {
        global $error;
        $error = array();
        if(empty($_POST['cat-name'])) {
            $error ['cat-name'] = "Không để trống tên danh mục";
        }else {
            $cat_name = $_POST['cat-name'];
        }
        if(empty($_POST['slug'])) {
            $error ['slug'] = "Không để trống slug";
        }else {
            $slug = $_POST['slug'];
        }

        $parent_id = $_POST['parent-Cat'];

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $edit_date = date('Y-m-d H:i:s');
        $edit_by = $_SESSION['user_login'];

        if(empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'slug' => $slug,
                'parent_id' => $parent_id,
                'edit_date' => $edit_date,
                'edit_by' => $edit_by
            );
            edit_cat($data, $cat_id);
            $error ['notifi'] = "Chỉnh sửa danh mục thành công !";
        }
    }
    
    $cat = get_cat_by_cat_id($cat_id);
    $data['cat'] = $cat;
    $list_cat = get_post_cat();
    $data['list_cat'] = $list_cat;
    $list_cat_1 = data_tree($list_cat, 0);
    $data['list_cat_1'] = $list_cat_1;

    load_view('editCat', $data);
}
?>