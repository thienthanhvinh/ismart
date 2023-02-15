
<?php
    get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype = "multipart/form-data">
                        <label for="title">Tiêu đề bài viết</label>
                        <input type="text" name="title" id="title">
                        <?php echo form_error('title') ?>
                        <label for="desc">Mô tả bài viết</label>
                        <textarea name="desc" id="desc" cols="" rows=""></textarea>
                        <?php echo form_error('desc') ?>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="content" id="content" class="ckeditor"></textarea>
                        <?php echo form_error('content') ?>
                        <label style="margin-top: 20px">Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" accept = "image/png, image/jpg, image/jpeg, image/gif">
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
                        <label for="">Trạng thái</label>
                        <div class="public-wait">
                            <input type="radio" name="status" id="wait" value="Chờ duyệt" checked>
                            <label for="wait">Chờ duyệt</label>
                            <input type="radio" name="status" id="public" value="Công khai">
                            <label for="public">Công khai</label>
                        </div>
                            
                
                        

                        <button type="submit" name="btn-add" id="btn-submit">Thêm bài viết</button>
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