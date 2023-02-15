
<?php
function construct() {
    load('lib', 'validation');
    load_model('index');
}

function loginAction() {
    // Validation form
    if(isset($_POST['btn-login'])) {
        global $error, $username, $password;
        $error= array();
        if(empty($_POST['username'])) {
            $error ['username'] = "Không được để trống tên đăng nhập";
        }else {
            if(!is_username($_POST['username'])) {
                $error ['username'] = "Tên đăng nhập từ 6 đến 32 ký tự, không bao gồm ký tự đặc biệt";
            }else {
                $username = $_POST['username'];
            }
        }

        if(empty($_POST['password'])) {
            $error ['password'] = "Không được để trống mật khẩu";
        }else {
            if(!is_password($_POST['password'])) {
                $error ['password'] = "Mật khẩu viết hoa ký tự đầu tiên và từ 8 đến 32 ký tự";
            }else {
                $password = md5($_POST['password']);
            }
        }

        if(empty($error)) {
            if(check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;


                redirect("?mod=dashboard&action=dashBoard");
            }else {
            $error ['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
        }
    }
    }
    load_view('login');
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}


function updateAction() {
    $username =  $_SESSION['user_login'];
    if(isset($_POST['btn-submit'])) {
        global $error, $email;
        $error = array();
        if(empty($_POST['displayname'])) {
            $error ['displayname'] = "Không được để trống trường này";
        }else {
            $displayname = $_POST['displayname'];
        }
        if(empty($_POST['email'])) {
            $error ['email'] = "Không được để trống trường này"; 
        }else {
            if(!is_email($_POST['email'])) {
                $error ['email'] = "Email từ 6 đến 32 ký tự và phải đúng định dạng. VD: thanhvinh@gmail.com";
            }
            else {
                $email = $_POST['email'];
            }
        }

        if(empty($_POST['phone'])) {
            $error ['phone'] = "Không được để trống trường này"; 
        }else {
            if(!is_phone($_POST['phone'])) {
                $error ['phone'] = "Số điện thoại 10 hoặc 11 chữ số";
            }
            else {
                $phone = $_POST['phone'];
            }
        }

        if(empty($_POST['address'])) {
            $error ['address'] = "Không được để trống trường này";
        }else {
            $address = $_POST['address'];
        }

        if(empty($error)) {
            $data = array(
                'displayname' => $displayname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            );
            update_info($data, $username);
            $error ['account'] = "Cập nhật tài khoản thành công";
        }
    }
    $info_user =  get_info_user($username);
    $data['info_user'] = $info_user;
    load_view('update', $data);
}


function changePassAction() {
    $username = $_SESSION['user_login'];
    if(isset($_POST['btn-submit'])) {
        global $error;
        $error = array();
        if(empty($_POST['pass-old'])) {
            $error ['pass-old'] = "Vui lòng nhập mật khẩu cũ của bạn";
        }else {
            if(!check_pass_old($username, md5($_POST['pass-old']))) {
                $error ['pass-old'] = "Mật khẩu cũ không đúng";
                echo $username;
            }else {
                if(empty($_POST['pass-new'])) {
                    $error ['pass-new'] = "Vui lòng nhập mật khẩu mới";
                }else {
                    if(!is_password($_POST['pass-new'])) {
                        $error ['pass-new'] = "Mật khẩu phải viết hoa chữ đầu và từ 8 đến 32 ký tự";
                    }else {
                        $pass_new = md5($_POST['pass-new']);
                    }
                }
                if(empty($_POST['confirm-pass'])) {
                    $error ['confirm-pass'] = "Vui lòng nhập lại mật khẩu mới";
                }else {
                    if($_POST['pass-new'] != $_POST['confirm-pass'] ) {
                        $error ['confirm-pass'] = "Xác nhận mật khẩu phải giống với mật khẩu mới";
                    }else {
                        $confirm_pass = ($_POST['confirm-pass']);
                    }
                }
            }
        }

        if(empty($error)) {
            $data = array(
                'password' => $pass_new
            );
            update_pass($data, $username);
            $error ['account'] = "Cập nhật mật khẩu thành công";
        }
    }

    load_view('changePass');
}



?>