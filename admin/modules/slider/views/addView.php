<?php
    get_header();
?>

<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype = "multipart/form-data">
                        <!-- <label for="title">Tên slider</label>
                        <input type="text" name="title" id="title"> -->
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link">
                        <!-- <label for="title">Thứ tự</label>
                        <input type="text" name="num_order" id="num-order"> -->
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file_slider" id="file_slider">
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <?php echo form_error('file_slider'); ?>
                            <!-- <img src="public/images/img-thumb.png"> -->
                        </div>
                        <!-- <div class="upload-image" style="width: 180px; height: 90px; border: 1px solid #dee2e6; margin-bottom: 15px">

                        </div> -->
                        <label>Trạng thái</label>

                        <div class="slider-status">
                        <input type="radio" id="public" name="status" value="Công khai" checked>
                        <label for="public">Công khai</label>
                        <input type="radio" id="wait" name="status" value="Chờ duyệt">
                        <label for="wait">Chờ duyệt</label>
                        </div>

                        <button type="submit" name="btn-add" id="btn-submit">Thêm mới</button>
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