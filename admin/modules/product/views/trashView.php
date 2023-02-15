
<?php
    get_header();
    // show_array($list_product);
    $temp = 0;
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm xoá tạm thời</h3>
                    <a href="?mod=product&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=product&action=list">Tất cả <span class="count">(<?php echo $num_restore ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=product&action=avai">Còn hàng <span class="count">(<?php echo $num_avai ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=product&action=soldOut">Hết hàng <span class="count">(<?php echo $num_sold_out ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=product&action=trash">Thùng rác<span class="count">(<?php echo $num_trash ?>)</span></a></li>
                        </ul>
                        <form action= "?mod=product&action=trash" method="POST" class="form-s fl-right">
                            <input type="text" name="search" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Khôi phục</option>
                                <option value="2">Xoá vĩnh viễn</option> 
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        
                    </div>
                    <div class="table-responsive">
                    <?php if(!empty($list_product)) { ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list_product as $item) { 
                                        $temp++;
                                    ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['product_id'] ?>"></td>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td>
                                        <div class="tbody-thumb" style="width: 120px; height: auto">
                                            <img src="http://localhost:8080/unitop.vn/back-end/Php/project/ismart.com/public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="" >
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=product&action=edit&id=<?php echo $item['product_id'] ?>" title=""><?php echo $item['name'] ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=product&action=edit&id=<?php echo $item['product_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=product&action=delete&id=<?php echo $item['product_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=product&action=addImage&id=<?php echo $item['product_id'] ?>" title="Thêm hình ảnh"><i class="fa-solid fa-plus"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo currency_format($item['price']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo print_cat_name($list_cat, $item['cat_id']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['created_by'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['created_date'] ?></span></td>
                                </tr>
                                <?php  } ?>
                            </tbody>            
                        </table>
                        <?php }else { ?>
                                <?php  echo "<p style='color: red;'>Không tồn tại bản ghi nào</p>"; ?>
                            <?php } ?>
                    </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                    <?php  echo get_paging($num_page, $page, "?mod=product&action=trash"); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
?>