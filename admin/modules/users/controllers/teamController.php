<?php 
function construct() {
    load_model('index');
    load('lib', 'validation');
}

function indexAction() {
   load_view('teamIndex');
}

function addAction() {
    if(isset($_POST['btn-submit'])) {
        global $error, $fullname, $username, $email, $address;
        $error = array();
        if(empty($_POST['fullname'])) {
            $error ['fullname'] = "Vui lòng nhập trường này"; 
        }else {
            $fullname = $_POST['fullname'];
        }

        if(empty($_POST['username'])) {
            $error ['username'] = "Vui lòng nhập trường này";
        }else {
            if(!is_username($_POST['username'])) {
                $error ['username'] = "Tên đăng nhập từ 6 đến 32 ký tự và không bao gồm ký tự đặc biệt";
            }else {
                $username = $_POST['username'];
            }
        }

        if(empty($_POST['password'])) {
            $error ['password'] = "Vui lòng nhập trường này";
        }else {
            if(!is_password($_POST['password'])) {
                $error ['password'] = "Mật khẩu phải viết hoa chữ cái đầu tiên và từ 8 đến 32 ký tự";
            }else {
                $password = md5($_POST['password']);
            }
        }

        if(empty($_POST['email'])) {
            $error ['email'] = "Vui lòng nhập trường này";
        }else {
            if(!is_email($_POST['email'])) {
                $error ['email'] = "Email phải đúng định dạng. Vd: vinhnguyen@gmail.com";
            }else {
                $email = $_POST['email'];
            }
        }

        if(empty($_POST['address'])) {
            $error ['address'] = "Vui lòng nhập trường này";
        }else {
                $address = $_POST['address'];
        }
      
        if(empty($error)) {
            if(user_exists($username, $email)) {
                $error ['account'] = "Tên đăng nhập hoặc email đã tồn tại trên hệ thống. Vui lòng thử lại tên khác";
            }else {
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email'    => $email,
                    'address'  => $address
                );
                add_admin_user($data);
                $error ['account'] = "Tạo tài khoản thành công !";
            }
        }
    }
    
    load_view('add');
}

?>