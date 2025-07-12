<?php
    get_header();
    $temp = 0;
    // show_array($list_color);
    // show_array($product_image);
    // show_array($product_info);
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right" style="margin-bottom: 35px">
            <div class="row-1">
                <div class="col-md-4 add-image">
                    <h2 class=" text-uppercase add-title">Thêm hình ảnh sản phẩm</h2>
                    <p class="pr-title"><?php echo $product_info['name'] ?></p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Thêm ảnh phụ</label>
                        <input type="file" name="image" id="">
                        <?php echo form_error_images('image') ?>
                        <label for="">Chọn màu đi kèm</label>
                        <select name="color-product" id="">
                            <option value="0">Chọn màu</option>
                            <?php foreach($list_color as $item) { ?>
                            <option value="<?php echo $item['color_id'] ?>"><?php echo $item['color_name'] ?></option>
                            <?php  } ?>
                        </select>
                        <input type="submit" name="btn-add" value="Thêm mới" id="btn-image">
                        <?php echo form_error_images('notifi') ?>
                    </form>

                </div>

                <div class="col-md-7 pr-list">
                    <h2 class=" product-image">danh sách hình ảnh phụ sản phẩm</h2>
                    <table class="table table-striped  text-center">
                        <thead>
                            <tr>
                                <th><p>STT</p></th>
                                <th><p>Hình ảnh</p></th>
                                <th><p>Tên màu đi kèm</p></th>
                                <th><p>Tác vụ</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($product_image as $item) {
                                $temp++;    
                            ?>
                            <tr>
                                <td><p style="margin-top: 25px"><?php echo $temp; ?></p></td>
                                <td><img src="http://localhost/ismart.com/public/uploads/images/products/<?php echo $item['image_name'] ?>" alt="" style="width: 100px; height: auto; margin-left: 170px"></td>
                                <td><p style="margin-top: 25px"><?php echo print_color_name($list_color, $item['color_id']) ?></p></td>
                                <td><a href="?mod=product&action=deleteImage&id=<?php echo $product_info['product_id']?>&image_id=<?php echo $item['image_id']?>" title="Xoá"><i class="fa fa-trash dlt-img" aria-hidden="true" style="margin-top: 30px"></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--row-->

        </div>
        <!--end content -->

    </div>

</div>


<?php
    get_footer();
?>