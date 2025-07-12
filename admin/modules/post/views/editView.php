
<?php
    get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype = "multipart/form-data">
                        <label for="title">Tiêu đề bài viết</label>
                        <input type="text" name="title" id="title" value="<?php echo $post['title'] ?>">
                        <?php echo form_error('title') ?>
                        <label for="desc">Mô tả bài viết</label>
                        <textarea name="desc" id="desc" cols="" rows=""><?php echo $post['post_desc'] ?></textarea>
                        <?php echo form_error('desc') ?>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo $post['content'] ?></textarea>
                        <?php echo form_error('content') ?>
                        <label style="margin-top: 20px">Hình ảnh</label>
                        <div id="uploadFile">
                            <img src="http://localhost/ismart.com/public/uploads/images/posts/<?php echo $post['image'] ?>" alt="" style="margin:0px; margin-bottom: 20px" name="file">
                            <input type="file" name="file" id="upload-thumb">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <!-- <img src="public/images/img-thumb.png"> -->
                        </div>
                        <?php echo form_error('file') ?>
                        <label>Danh mục bài viết</label>
                        <select name="cat-post">
                            <?php
                                foreach($list_cat_1 as $item) {
                            ?>
                            <option value="<?php echo $item['cat_id'] ?>" class=""><?php echo str_repeat('-', $item['level']).$item['cat_name'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                               
                        <button type="submit" name="btn-edit" id="btn-submit">Lưu chỉnh sửa</button>
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
