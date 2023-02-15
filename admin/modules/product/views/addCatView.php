<?php
    get_header();
    // show_array($list_cat_name);
?>


<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="cat-name">Tên danh mục</label>
                        <input type="text" name="cat-name" id="cat-name">
                        <?php echo form_error('cat-name') ?>
                        <!-- <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug"> -->
                         <!-- <?php echo form_error('slug') ?> -->
                
                        <label>Danh mục cha</label>
                        <select name="parent-Cat">
                            <option value="0">Không có danh mục cha</option>
                            <?php  foreach($list_cat_name as $item) {  ?>
                            <option value="<?php echo $item['cat_id'] ?>"><?php echo str_repeat('-', $item['level']).$item['cat_name'] ?></option>
                            <?php } ?>
                        </select>
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