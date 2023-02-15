
<?php
function construct() {
    load('lib', 'validation');
    load_model('index');
    load('lib', 'email');
}

function regAction() {
    global $error, $fullname, $username, $password, $email;
    if(isset($_POST['btn-reg'])) {
        $error = array();
        if(empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        }else {
            $fullname = $_POST['fullname'];
        }

        // Kiểm tra username
        if(empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        }else {
            if(!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập từ 6 đến 32 ký tự, không bao gồm ký tự đặc biệt";
            }else {
                $username = $_POST['username'];
            }
        }

        if(empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        }else {
            if(!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu viết hoa ký tự đầu tiên và từ 8 đến 32 ký tự";
            }else {
                $password = md5 ($_POST['password']);
            }
        }

        if(empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        }else {
            if(!is_email($_POST['email'])) {
                $error['email'] = "Email phải đúng định dạng. Vd: xxxx@gmail.com";
            }else {
                $email = $_POST['email'];
            }
        }

        if(empty($error)) {
            if(!user_exists($username, $email)) {
                $active_token = md5($username.time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email'    => $email,
                    'password' => $password,
                    'active_token' => $active_token
                );
                add_user($data);
                $link_active = base_url("?mod=user&controller=index&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                            <p>Bạn vui lòng click vào đường link này để kích hoạt tài khoản: {$link_active}</p>
                            <p>Nếu không phải bạn đăng ký thì hãy bỏ qua email này</p>
                            <p>Team support Vbookstore.vn</p>";
                echo send_mail('nguyenthienthanhvinh@gmail.com', "Thành Vinh", "Kích hoạt tài khoản", $content);
                $error['notifi'] = "Tạo tài khoản thành công, vui lòng vào email để xác thực tài khoản";

            }else {
                $error['account'] = "Email hoặc username đã tồn tại trên hệ thống";
            }
        }

    }

    load_view('reg');
}


function loginAction() {
    global $username, $password, $error;
    if (isset($_POST['btn-login'])) {
        $error = array();

        if(empty($_POST['username'])) {
            $error ['username'] = "Không được để trống tên đăng nhập";
        }else {
            if(!is_username($_POST['username'])) {
                $error ['username'] = "Tên đăng nhập không hợp lệ";
            }else {
                $username = $_POST['username'];
            }  
        }

        if(empty($_POST['password'])) {
            $error ['password'] = "Không được để trống mật khẩu";
        }else {
            if(!is_password($_POST['password'])) {
            $error ['password'] = "Mật khẩu không hợp lệ";
        }else {
            $password =  md5($_POST['password']);
        }
    }

        // Kết luận
        if(empty($error)) {
            if(check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;

                // Xử lý cookie
                if (isset($_POST['remember-me'])) {
                    setcookie('is_login', true, time() + 60);
                    setcookie('user_login', $username, time() + 3600);
                }
                
                //Xử lý duy trì phiên đăng nhập
                if (!empty($_COOKIE['is_login'])) {
                    $_SESSION['is_login'] = $_COOKIE['is_login'];
                    $_SESSION['user_login'] = $_COOKIE['user_login'];
                }

            redirect("?mod=home&action=index");
            }else {
                $error['account'] = "Tên đăng nhập hoặc mậu khẩu không tồn tại";
        }
        }
    }
    load_view('login');
}


function activeAction() {
    $link_login = base_url("?mod=user&controller=index&action=login");
    $active_token = $_GET['active_token'];
    if (check_active_token($active_token)) {
        active_user($active_token);
        echo "Kích hoạt thành công. Bạn vui lòng click vào đường link sau để đi đến trang đăng nhập: <a href = '{$link_login}'>Đăng nhập</a>";
    }else {
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó. Bạn vui lòng click vào đường link sau để đi đến trang đăng nhập: <a href = '{$link_login}'>Đăng nhập</a>";
    }
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=user&controller=index&action=login");
}

function resetAction() {
    global $error, $fullname;
    if(isset($_POST['btn-reset-pass'])) {
        $error= array();
        if(empty($_POST['email'])) {
            $error ['account'] = "Không được để trống email";
        }else {
            if(!is_email($_POST['email'])) {
                $error['account'] = "Email không đúng định dạng";
            }else {
                $email = $_POST['email'];
            }
        }

        if(empty($error)) {
            if(check_email($email)) {
                $reset_pass_token = md5($email.time());
                $data = array(
                    'reset_pass_token' => $reset_pass_token
                );
                update_reset_token($data, $email);
                $link_reset = base_url("?mod=user&controller=index&action=newPass&reset_pass_token={$reset_pass_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                            <p>Bạn vui lòng click vào đường link này để lấy lại mật khẩu: {$link_reset}</p>
                            <p>Nếu không phải bạn đăng ký thì hãy bỏ qua email này</p>
                            <p>Team support Vbookstore.vn</p>";
                echo send_mail($email,"", "Lấy lại mật khẩu", $content);
            }else {
                $error ['account'] = "Email không tồn tại trong hệ thống";
            }
        }
    }
    load_view('reset');
}

function newPassAction() {
    $reset_pass_token = $_GET['reset_pass_token'];
    if(check_reset_pass_token($reset_pass_token)) {
        global $error, $password;
        if(isset($_POST['btn-new-pass'])) {
            $error= array();
            if(empty($_POST['password'])) {
                $error ['password'] = "Không được để trống mật khẩu";
            }else {
                if(!is_password($_POST['password'])) {
                    $error ['password'] = "Mật khẩu viết hoa ký tự đầu tiên và từ 8 đến 32 ký tự";
                }else {
                    $password = md5($_POST['password']);
                }
            }
            if(empty($_POST['repassword'])) {
                $error ['repassword'] = "Không được để trống mật khẩu nhập lại";
            }else {
                if(!is_password($_POST['repassword'])) {
                    $error ['repassword'] = "Mật khẩu viết hoa ký tự đầu tiên và từ 8 đến 32 ký tự";
                }
                if($_POST['password'] != $_POST['repassword']) {
                    $error['repassword'] = "Nhập lại mật khẩu không giống với mật khẩu mới";
                }else {
                    $repassword = md5($_POST['repassword']);
                }
            }

            if(empty($error)) {
                $data = array(
                    'password' => $password
                );
                update_pass($data, $reset_pass_token);
                redirect("?mod=user&controller=index&action=resetSuccess");
            }
        }
        load_view('newPass');
    }else {
        redirect("?mod=user&controller=index&action=reset");
    }
}

function resetSuccessAction() {
    load_view('resetSuccess');
}

?>

