<?php
    get_header();
    $temp = 0;
    // show_array($list_color);
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right" style="margin-bottom: 35px">
            <div class="row-1">
                <div class="col-md-4 add-color">
                    <h2 class="text-uppercase add-title text-danger">Thêm màu</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Tên màu</label>
                        <input type="text" name="color-name" id="color-name">
                        <label for="">Chọn màu</label>
                        <input type="color" name="color-sl" id="color-sl">
                        <?php echo form_error_color('color-sl')?>
                        <label for="">Mã màu</label>
                        <input type="text" name="color-code" id="color-code" readonly = "readonly">
                        <input type="submit" name="btn-add" value="Thêm mới" id="btn-color">
                        <?php echo form_error_color('notifi_color')?>
                    </form>

                </div>

                <div class="col-md-7 pr-color">
                    <h2 class="text-uppercase product-image">danh sách màu</h2>
                    <?php if(!empty($list_color)) { ?>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><p>STT</p></th>
                                <th><p>Tên màu</p></th>
                                <th><p>Mã màu</p></th>
                                <th><p>Hiển thị</p></th>
                                <th><p>Tác vụ</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list_color as $item) {
                                $temp++;
                                
                            ?>
                            <tr>
                                <td><p><?php echo $temp; ?></p></td>
                                <td><p><?php echo $item['color_name'] ?></p></td>
                                <td><p><?php echo $item['color_code'] ?></p></td>
                                <td><div class="color-contain" style="background-color: <?php echo $item['color_code'] ?>;"></div></td>
                                <td><p><a href="?mod=product&action=deleteColor&id=<?php echo $item['color_id'] ?>" title="Xoá"><i class="fa fa-trash dlt-img" aria-hidden="true"></a></p></td>
                            </tr>
                            <?php
                                }
                            ?>
                           
                        </tbody>
                    </table>
                    <?php } ?>
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


