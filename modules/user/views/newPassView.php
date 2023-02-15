

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiết lập mật khẩu mới</title>
    <link rel="stylesheet" href="./public/css/newpass.css">
</head>
<body>
    <div id="wp-form-reset">
        <form action="" method="POST" id="form-reset">
            <h2>Mật khẩu mới</h2>
            <input type="password" name="password" placeholder="Mật khẩu mới">
            <?php echo form_error('password')?>
            <input type="password" name="repassword" placeholder="Nhập lại mật khẩu mới">
            <?php echo form_error('repassword')?>
            <input type="submit" name="btn-new-pass" id="btn-new-pass" value="Cập nhật mật khẩu">
        </form>
    </div>
</body>
</html>