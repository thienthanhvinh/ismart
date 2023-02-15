

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
    <div id="wp-form-login">
        <form action="" method="POST" id="form-login">
            <h2>Email của bạn</h2>
            <input type="email" name="email" id="email" placeholder="Email" value="<?php echo set_value('email') ?>">
            <?php echo form_error('account') ?>
            <input type="submit" name="btn-reset-pass" id="btn-reset-pass" value="Lấy lại mật khẩu">
            <a href="?mod=user&controller=index&action=login" id="bt-login">Đăng nhập</a> | <a href="?mod=user&controller=index&action=reg" id="bt-login">Đăng ký</a>
        </form>
        
    </div>
</body>
</html>