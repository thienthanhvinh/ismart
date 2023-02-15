<?php
get_header();
$username = $_SESSION['user_login'];

?>

<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="displayname" id="displayname" value="<?php echo $info_user['displayname']?>">
                        <?php echo form_error('displayname')?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" value="<?php echo $info_user['username'] ?>" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $info_user['email'] ?>">
                        <?php echo form_error('email')?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="phone" id="phone" value="<?php echo $info_user['phone']?>">
                        <?php echo form_error('phone') ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $info_user['address']?></textarea>
                        <?php echo form_error('address') ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        <?php echo form_error('account') ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>