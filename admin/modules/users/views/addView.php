<?php
    get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
            <h3 id="index" class="fl-left">Thêm tài khoản quản trị</h3>
            </div>
        </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>">
                        <?php echo form_error('fullname') ?>

                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="user_name" value="<?php echo set_value('username') ?>">
                        <?php echo form_error('username') ?>

                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password">
                        <?php echo form_error('password') ?>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo set_value('email')?>">
                        <?php echo form_error('email') ?>

                        <label for="phone">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo set_value('address')?></textarea>
                        <?php echo form_error('address') ?>

                        <button type="submit" name="btn-submit" id="btn-submit">Tạo tài khoản</button>
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