<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./public/css/reg.css">
</head>
<body>
    <div id="wp-form-reg">
        <form action="" method="POST" id="form-reg">
            <h2>Đăng ký tài khoản</h2>

            <input type="text" name="fullname" id="fullname" placeholder = "fullname" value="<?php echo set_value('fullname')?>">
            <?php echo form_error('fullname')?>

            <input type="email" name="email" id="email" placeholder = "email"  value="<?php echo set_value('email')?>">
            <?php echo form_error('email')?>

            <input type="text" name="username" id="username" placeholder = "username" value="<?php echo set_value('username')?>">
            <?php echo form_error('username')?>

            <input type="password" name="password" id="password" placeholder = "password">
            <?php echo form_error('password')?>

            <?php echo form_error('account') ?>

            <input type="submit" id="btn-reg" name="btn-reg" value="Đăng ký">

            <?php echo form_error('notifi') ?>
            
            <a href="?mod=user&controller=index&action=login" id="btn-login">Đăng nhập</a>
        </form>
    </div>
</body>
</html>