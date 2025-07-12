<?php 
    get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype = "multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product-name" id="product-name" value="<?php echo $product_info['name'] ?>">
                        <?php echo form_error('product-name')?>
                        <!-- <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code"> -->
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo $product_info['price'] ?>">
                        <?php echo form_error('price')?>
                        <label for="old-price">Giá gốc</label>     
                        <input type="text" name="old-price" id="old-price" value="<?php echo $product_info['old_price'] ?>" placeholder="Có thể bỏ trống">
                        <label for="desc">Mô tả sản phẩm</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $product_info['product_desc'] ?></textarea>
                        <?php echo form_error('desc')?>
                        <label for="desc">Chi tiết sản phẩm</label>
                        <textarea name="detail" id="detail" class="ckeditor"><?php echo $product_info['detail'] ?></textarea>
                        <?php echo form_error('detail')?>
                        <label style="margin-top: 20px;">Hình ảnh</label>
                        
                        <div id="uploadFile" style="padding-bottom: 15px">
                            <img src="http://localhost/ismart.com/public/uploads/images/products/<?php echo $product_info['thumb'] ?>" alt="" style="margin-bottom: 20px">
                            <input type = "file" name="file" id="upload-thumb">
                            <?php echo form_error('file')?>
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb"> -->
                            <!-- <img src="public/images/img-thumb.png"> -->
                        </div>
                        <label>Danh mục cha</label>
                        
                        <select name="list-parent" id = "list-parent">
                            <option value="">-- Chọn danh mục cha --</option>
                            <?php foreach($list_parent as $item) { ?>
                            <option value="<?php echo $item['cat_id'] ?>"><?php echo $item['cat_name'] ?></option>
                            <?php } ?>
                        </select>

                        <label>Danh mục con</label>
                        
                        <select name="list-child" id="list-child">
                            <option value="">-- Chọn danh mục con --</option>
                        </select>
                        <?php echo form_error('list-child')?>

                        <label for="">Sản phẩm nổi bật</label>
                        <div class="product-sale">
                            <label for="">Có</label>
                            <input type="radio" name="out-standing" value= "1" >
                            <label for="">Không</label>
                            <input type="radio" name="out-standing" value = "0" >
                        </div>
                       
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