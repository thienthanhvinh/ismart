<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
}

function listAction() {

    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Còn hàng"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Hết hàng"
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

    $num_restore = get_num_restore();
    $num_per_page = 5;
    $num_page = ceil($num_restore / $num_per_page);
    
    // echo "Số trang là: {$num_page}";
    if(isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    }else {
        $page = 1;
    }
    // Tính bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;
    
    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $num_search = get_num_search($keyword);
        $num_page = ceil($num_search / $num_per_page);
        $data['num_page'] = $num_page;
        $list_product = get_list_by_search($keyword, $start, $num_per_page);
        $data['list_product'] = $list_product;
    }else {
        // $list_product = get_list_product();
        // $data['list_product'] = $list_product;
        $list_product = get_list_product($start, $num_per_page); 
        $data['list_product'] = $list_product;
    }    
            
    
        $data['num_restore'] = $num_restore;
        $data['num_page'] = $num_page;
        $data['page'] = $page;

    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;

    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;
    $num_avai = get_num_avai();
    $data['num_avai'] = $num_avai;
    $num_sold_out = get_num_sold_out();
    $data['num_sold_out'] = $num_sold_out;  



    load_view('list', $data);
}

function addAction() {

    if(isset($_POST['btn-add'])) {
        global $error;
        $error = array();
        if(empty($_POST['product-name'])) {
            $error ['product-name'] = "Không được để trống tên sản phẩm";
        }else {
            $product_name = $_POST['product-name'];
        }
        if(empty($_POST['price'])) {
            $error ['price'] = "Không được để trống giá sản phẩm";
        }else {
            $price = $_POST['price'];
        }
        if(empty($_POST['desc'])) {
            $error ['desc'] = "Không được để trống mô tả sản phẩm";
        }else {
            $desc = $_POST['desc'];
        }
        if(empty($_POST['detail'])) {
            $error ['detail'] = "Không được để trống chi tiết sản phẩm";
        }else {
            $detail = $_POST['detail'];
        }

        if(empty($_POST['list-parent'])) {
            $error ['list-parent'] = "Xin hãy chọn danh mục cha";
        }else {
            $cat_id = $_POST['list-parent'];
        }

        if(empty($_POST['list-child'])) {
            $error ['list-child'] = "Xin hãy chọn danh mục con";
        }else {
            $child_id = ($_POST['list-child']);   
        }

        if(!empty($product_name)) {
            $slug = create_slug($product_name);
        }
    
        $out_standing = $_POST['out-standing'];
        $old_price = $_POST['old-price'];
        $status = $_POST['status'];
        $created_by = $_SESSION['user_login'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $created_date = date('Y-m-d H:i:s');

        

            $img_name = $_FILES['file']['name'];
            $upload_dir = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/products/';
            $upload_file = $upload_dir . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);

        if(!empty($img_name)) {
            if(empty($error)) {
            if(empty($old_price)) {
                $data = array(
                    'name' => $product_name,
                    'slug' => $slug,
                    'price' => $price,
                    'product_desc' => $desc,
                    'detail' => $detail,
                    'thumb' => $img_name,
                    'status' => $status,
                    'created_by' => $created_by,
                    'created_date' => $created_date,
                    'cat_id' => $cat_id,
                    'child_id' => $child_id,
                    'outstanding' => $out_standing,
                    'have_discount' => 0,
                    'old_price' => null
                );
                add_product($data);
                $error ['notifi'] = "Thêm sản phẩm thành công !";
            }else {
                $data = array(
                    'name' => $product_name,
                    'slug' => $slug,
                    'price' => $price,
                    'product_desc' => $desc,
                    'detail' => $detail,
                    'thumb' => $img_name,
                    'status' => $status,
                    'created_by' => $created_by,
                    'created_date' => $created_date,
                    'cat_id' => $cat_id,
                    'child_id' => $child_id,
                    'outstanding' => $out_standing,
                    'old_price' => $old_price,
                    'have_discount' => 1
                );
                add_product($data);
                $error ['notifi'] = "Thêm sản phẩm thành công !";
            }
                
            }
        }else {
            $error ['file'] = "Không được để trống hình ảnh";
        }
      
    }

    $list_parent = get_list_parent();
    $data['list_parent'] = $list_parent;

    load_view('add', $data);
}

function editAction() {
    $id = (int) $_GET['id'];

    if(isset($_POST['btn-edit'])) {
        global $error;
        $error = [];
        if(empty($_POST['product-name'])) {
            $error ['product-name'] = "Không được để trống tên sản phẩm";
        }else {
            $product_name = $_POST['product-name'];
        }
        if(empty($_POST['price'])) {
            $error ['price'] = "Không được để trống giá sản phẩm";
        }else {
            $price = $_POST['price'];
        }
        if(empty($_POST['desc'])) {
            $error ['desc'] = "Không được để trống mô tả sản phẩm";
        }else {
            $desc = $_POST['desc'];
        }
        if(empty($_POST['detail'])) {
            $error ['detail'] = "Không được để trống chi tiết sản phẩm";
        }else {
            $detail = $_POST['detail'];
        }
        if(empty($_POST['list-parent'])) {
            $error ['list-parent'] = "Xin hãy chọn danh mục cha";
        }else {
            $cat_id = $_POST['list-parent'];
        }
        if(empty($_POST['list-child'])) {
            $error ['list-child'] = "Xin hãy chọn danh mục con";
        }else {
            $child_id = $_POST['list-child'];
        }

        if(!empty($product_name)) {
            $slug = create_slug($product_name);
        }
        
        $img_name = $_FILES['file']['name'];
        $upload_dir = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/products/';
        $upload_file = $upload_dir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
        
        if(isset($_POST['out-standing'])) {
        $out_standing = $_POST['out-standing'];
        }
        $old_price = $_POST['old-price'];
        $edit_by = $_SESSION['user_login'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $edit_date = date('Y-m-d H:i:s');

        if(!empty($img_name)) {
            if(empty($error)) {
                if(empty($_POST['old-price'])) {
                    $data = array(
                        'name' => $product_name,
                        'slug' => $slug,
                        'price' => $price,
                        'product_desc' => $desc,
                        'detail' => $detail,
                        'thumb' => $img_name,
                        'cat_id' => $cat_id,
                        'child_id' => $child_id, 
                        'edit_by' => $edit_by,
                        'edit_date' => $edit_date,
                        'have_discount' => 0,
                        'outstanding' => $out_standing,
                        'old_price' => null
                    );
                    edit_product($data, $id);
                    $error['notifi'] = "Chỉnh sửa sản phẩm thành công !";
                }else {
                    $data = array(
                        'name' => $product_name,
                        'slug' => $slug,
                        'price' => $price,
                        'product_desc' => $desc,
                        'detail' => $detail,
                        'thumb' => $img_name,
                        'cat_id' => $cat_id,
                        'child_id' => $child_id, 
                        'edit_by' => $edit_by,
                        'edit_date' => $edit_date,
                        'have_discount' => 1,
                        'outstanding' => $out_standing,
                        'old_price' => $old_price
                    );
                    edit_product($data, $id);
                    $error['notifi'] = "Chỉnh sửa sản phẩm thành công !";
                }
                
            }
        }else {
            if(empty($error)) {
                if(empty($_POST['old-price'])) {
                    $data = array(
                        'name' => $product_name,
                        'slug' => $slug,
                        'price' => $price,
                        'product_desc' => $desc,
                        'detail' => $detail,
                        'cat_id' => $cat_id,
                        'child_id' => $child_id, 
                        'edit_by' => $edit_by,
                        'edit_date' => $edit_date,
                        'have_discount' => 0,
                        'outstanding' => $out_standing,
                        'old_price' => null
                    );
                    edit_product($data, $id);
                    $error['notifi'] = "Chỉnh sửa sản phẩm thành công !";
                }else {
                    $data = array(
                        'name' => $product_name,
                        'slug' => $slug,
                        'price' => $price,
                        'product_desc' => $desc,
                        'detail' => $detail,      
                        'cat_id' => $cat_id,
                        'child_id' => $child_id, 
                        'edit_by' => $edit_by,
                        'edit_date' => $edit_date,
                        'have_discount' => 1,
                        'outstanding' => $out_standing,
                        'old_price' => $old_price 
                    );
                    edit_product($data, $id);
                    $error['notifi'] = "Chỉnh sửa sản phẩm thành công !";
                }
            }
        }
    }

    $product_info = get_product_info($id);
    $data['product_info'] = $product_info;
    $list_parent = get_list_parent();
    $data['list_parent'] = $list_parent;
    load_view('edit', $data);
}

function deleteAction() {
    $id = (int) $_GET['id'];
    delete_product_have_foreign_key($id);
    delete_product($id);
    redirect("?mod=product&action=list");
}

function avaiAction() {
    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Hết hàng"
            );
            update_action($data, $id);
        }
        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    $num_avai = get_num_avai();   //Lấy số lượng bản ghi còn hàng
    $num_per_page = 5;
    $num_page = ceil($num_avai / $num_per_page);  // Tính tổng số trang 
    
    // echo "Số trang là: {$num_page}";
    if(isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    }else {
        $page = 1;
    }
    // Tính bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;
    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $num_search = get_num_search_avai($keyword);   //Lấy số lượng bản ghi tìm kiếm được
        $num_page = ceil($num_search / $num_per_page); //Tính tổng số trang 
        $data['num_page'] = $num_page;
        $list_product = get_list_search_avai($keyword, $start, $num_per_page);
        $data['list_product'] = $list_product;
    }else {
        // $list_product = get_list_product();
        // $data['list_product'] = $list_product;
        $list_product = get_list_avai($start, $num_per_page); //Lấy danh sách bản ghi còn hàng
        $data['list_product'] = $list_product;
    }

   


    $data['num_avai'] = $num_avai;
    $data['num_page'] = $num_page;
    $data['page'] = $page;


    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;

    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;
    $num_avai = get_num_avai();
    $data['num_avai'] = $num_avai;
    $num_sold_out = get_num_sold_out();
    $data['num_sold_out'] = $num_sold_out; 

    load_view('avai', $data);
}

function soldOutAction() {

    if(isset($_POST['sm_action'])) {
        if($_POST['actions'] == 1 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'status' => "Còn hàng"
            );
            update_action($data, $id);
        }

        if($_POST['actions'] == 2 && isset($_POST['checkItem'])) {
            $id = implode(',', $_POST['checkItem']);
            $data = array(
                'restore_trash' => "Xoá tạm thời"
            );
            update_action($data, $id);
        }
    }

    $num_sold_out = get_num_sold_out();
    $num_per_page = 5;
    $num_page = ceil($num_sold_out / $num_per_page);
    
    // echo "Số trang là: {$num_page}";
    if(isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    }else {
        $page = 1;
    }
    // Tính bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;
    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $num_search = get_num_search_sold_out($keyword);
        $num_page = ceil($num_search / $num_per_page);
        $data['num_page'] = $num_page;
        $list_product = get_list_search_sold_out($keyword, $start, $num_per_page);
        $data['list_product'] = $list_product;
    }else {
        // $list_product = get_list_product();
        // $data['list_product'] = $list_product;
        $list_product = get_list_sold_out($start, $num_per_page); 
        $data['list_product'] = $list_product;
    }
    
    $data['num_sold_out'] = $num_sold_out;
    $data['num_page'] = $num_page;
    $data['page'] = $page;

    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;

    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;
    $num_avai = get_num_avai();
    $data['num_avai'] = $num_avai;
    $num_sold_out = get_num_sold_out();
    $data['num_sold_out'] = $num_sold_out; 

    load_view('soldOut', $data);
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

    $num_trash = get_num_trash();   //Lấy số lượng bản ghi còn hàng
    $num_per_page = 5;
    $num_page = ceil($num_trash / $num_per_page);  // Tính tổng số trang 
    
    // echo "Số trang là: {$num_page}";
    if(isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    }else {
        $page = 1;
    }
    // Tính bản ghi bắt đầu
    $start = ($page - 1) * $num_per_page;
    if(isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $num_search = get_num_search_trash($keyword);   //Lấy số lượng bản ghi tìm kiếm được
        $num_page = ceil($num_search / $num_per_page); //Tính tổng số trang 
        $data['num_page'] = $num_page;
        $list_product = get_list_search_trash($keyword, $start, $num_per_page);
        $data['list_product'] = $list_product;
    }else {
        // $list_product = get_list_product();
        // $data['list_product'] = $list_product;
        $list_product = get_list_trash($start, $num_per_page); //Lấy danh sách bản ghi còn hàng
        $data['list_product'] = $list_product;
    }

    // $data['num_trash'] = $num_trash;
    $data['num_page'] = $num_page;
    $data['page'] = $page;

    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;

    $num_restore = get_num_restore();
    $data['num_restore'] = $num_restore;
    $num_trash = get_num_trash();
    $data['num_trash'] = $num_trash;
    $num_avai = get_num_avai();
    $data['num_avai'] = $num_avai;
    $num_sold_out = get_num_sold_out();
    $data['num_sold_out'] = $num_sold_out; 

    load_view('trash', $data);
}


function catAction () {
    
    $list_cat = get_list_cat();
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
        // if(empty($_POST['slug'])) {
        //     $error ['slug'] = "Không được để trống tên danh mục";
        // }else {
        //     $slug = $_POST['slug'];
        // }
        
        if(!empty($cat_name)) {
            $slug = create_slug($cat_name);
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
                $error ['notifi'] = "Thêm danh mục mới thành công";
           } 

    }

    $list_cat = get_list_cat();
    $data['list_cat'] = $list_cat;
    $list_cat_name = data_tree($list_cat, 0);
    $data['list_cat_name']  = $list_cat_name;


    load_view('addCat', $data);
}
 
function editCatAction() {
    $cat_id = (int) $_GET['cat_id'];
    if(isset($_POST['btn-edit'])) {
        global $error;
        $error = [];
        if(empty($_POST['cat-name'])) {
            $error ['cat-name'] = "Không được để trống tên danh mục";
        }else {
            $cat_name = $_POST['cat-name'];
        }
        
        if(!empty($cat_name)) {
            $slug = create_slug($cat_name);
        }

        $parent_id = $_POST['parent-Cat'];
        $edit_by = $_SESSION['user_login'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $edit_date = date('Y-m-d H:i:s'); 

        if(empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'slug' => $slug,
                'parent_id' => $parent_id,
                'edit_by' => $edit_by,
                'edit_date' => $edit_date
            );
            edit_cat($data, $cat_id);
            $error['notifi'] = "Chỉnh sửa danh mục thành công !";
        }
    }

    //Lấy thông tin của các trường như tên, slug
    $cat_info = get_cat_info($cat_id);
    $data['cat_info'] = $cat_info;

    //Lấy thông tin danh mục 
    $list_cat = get_list_cat();
    $list_cat_name = data_tree($list_cat, 0);
    $data['list_cat_name']  = $list_cat_name;

    load_view('editCat', $data);
}

function deleteCatAction() {
    $cat_id = (int) $_GET['cat_id'];
    // delete_cat_have_foreign_key($cat_id);
    delete_cat($cat_id);
    redirect("?mod=product&action=cat");   
}

function addImageAction() {
    $product_id = (int) $_GET['id'];
    if(isset($_POST['btn-add'])) {
        global $error_images;
        $error_images = array();
        
            $img_name = $_FILES['image']['name'];
            $upload_dir = 'E:/xampp/htdocs/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/products/';
            $upload_file = $upload_dir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_file);
        
        $color_id = $_POST['color-product'];

        if(!empty($img_name)) {
            if(empty($error_images)) {
                $data = array(
                    'image_name' => $img_name,
                    'color_id' => $color_id,
                    'product_id' => $product_id
                );
                add_image($data);
                $error_images ['notifi'] = "Thêm hình ảnh thành công !";
            }
        }else {
            $error_images ['image'] = "Không được để trống hình ảnh";
        }
       
    }
    
   
    $product_info = get_product_info($product_id);
    $data['product_info'] = $product_info;
    $list_color = get_list_color();
    $data['list_color'] = $list_color;
    $product_image = get_product_image($product_id);
    $data['product_image'] = $product_image;

    load_view('addImage', $data);
}

function deleteImageAction() {
    $product_id = (int) $_GET['id'];
    $image_id = (int) $_GET['image_id'];
    delete_image($image_id);
    redirect("?mod=product&action=addImage&id={$product_id}");
}

function listColorAction() {
    if(isset($_POST['btn-add'])) {
        global $error_color;
        $error_color = array();
        if(empty($_POST['color-name'])) {
            $error_color ['color-name'] = "Không được để trống tên màu";
        }else {
            $color_name = $_POST['color-name'];
        }

        if(empty($_POST['color-code'])) {
            $error_color ['color-sl'] = "Xin hãy chọn màu";
        }else {
            $color_code = $_POST['color-code'];
        }
        if(empty($error_color)) {
            $data = array(
                'color_name' => $color_name,
                'color_code' => $color_code
            );
            add_color($data);
            $error_color['notifi_color'] = "Thêm màu thành công !";
        }

    }
    $list_color = get_list_color();
    $data['list_color'] = $list_color;

    load_view('listColor', $data);
}

function deleteColorAction() {
    $color_id = (int) $_GET['id'];
    $data = array(
        'color_id' => 0
    );
    delete_color_have_foreign_key($data, $color_id);
    delete_color($color_id);
    redirect("?mod=product&action=listColor");
}




?>