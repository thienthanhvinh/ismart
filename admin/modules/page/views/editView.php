<?php
  get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo $page_by_id['title'] ?>">
                        <?php echo form_error('title') ?>

                        <label for="desc">Nội dung trang</label>
                        <textarea class="ckeditor" name="desc" id="desc" ><?php echo $page_by_id['content'] ?></textarea>
                        <button type="submit" name="btn-edit" id="btn-submit">Chỉnh sửa</button>
                        <?php echo form_error('notifi') ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
  get_footer();
?>