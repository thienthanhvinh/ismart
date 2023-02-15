
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./public/css/import/login.css">
</head>

<body>
    <div id="wp-form-login">
        <form action="" method="POST" id="form-login">
            <h2 class="text-head">Đăng nhập Admin</h2>
    
            <input type="username" name="username" id="username" placeholder="username" value="<?php echo set_value('username') ?>">
            <?php echo form_error('username'); ?>

            <input type="password" name="password" id="password" placeholder="password">
            <?php echo form_error('password'); ?>

            <input type="submit" name="btn-login" id="btn-login" value="Đăng nhập">
            <?php echo form_error('account') ?>
            <!-- <a href="?mod=user&action=reset" id="forget-pass" name="forget-pass">Quên mật khẩu</a> | <a href="?mod=user&controller=index&action=reg" id="regis">Đăng ký</a> -->
        </form>
    </div>

</body>

</html>