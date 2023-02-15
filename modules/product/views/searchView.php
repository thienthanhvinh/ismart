
<?php
    get_header();
    // show_array($list_product);
    // show_array($list_child);
    
   
?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <!-- <h3 class="section-title fl-left"><?php echo $cat_name['cat_name'] ?></h3> -->
                   <?php if(!empty($list_product)) { ?>
                    <h3 class="section-title fl-left" style="margin-top: 3px; font-size: 17px">Tìm thấy <?php echo $num_product ?> kết quả với từ khoá <?php echo $keyword ?></h3>
                    <?php } ?>
                    <!-- <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="section-detail">
                    <?php if(!empty($list_product)) { ?>
                    <ul class="list-item clearfix list-filter">
                        <?php foreach ($list_product as $item) { ?>
                        <li>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb">
                                <img class="img-index" src="public/uploads/images/products/<?php echo $item['thumb'] ?>">
                            </a>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format ($item['price']) ?></span>
                                <span class="old"><?php echo print_old_price($item['old_price']) ?></span>
                            </div>
                            <div class="action clearfix">
                                <button type = "submit" title="Thêm giỏ hàng" data-id=<?php echo $item['product_id'] ?> class="add-cart fl-left" data-toggle = "modal" data-target="#myModal">Thêm giỏ hàng</button>
                                <a href="mua-ngay-<?php echo $item['product_id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php } ?>
                        
                    </ul>
                    <?php }else { ?>
                        <p style="text-align: center; margin-top: 10px; margin-bottom: 30px; font-size: 18px">Không tìm thấy sản phẩm nào với từ khoá <span style="color: red"><?php if(!empty($keyword)) { echo $keyword;} ?></span>. Bạn vui lòng nhập từ khoá khác</p>
                        <img src="./public/images/search-found.png" alt="" style="width: 300px; height: auto;">
                    
                    <?php } ?>
                </div>
            </div>
            <div class="modal fade" id="myModal">
        <div class="modal-dialog ">
            <div class="modal-content">                
                <img src="./public/images/ticker_1.png" alt="">
                <h2>Thêm sản phẩm thành công !</h2>
                <p>Bạn có muốn đi đến giỏ hàng ?</p>
                <a class="btn-go-cart" href="gio-hang">Giỏ hàng</a>
                <a class="btn-close" href="" data-dismiss="modal">Ở lại trang này</a>

            </div>
        </div>
    </div>
            <!-- <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <?php echo data_tree($list_cat) ?>
                    
                        <!-- <li>
                            <a href="?page=category_product" title="">Điện thoại</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=category_product" title="">Iphone</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Samsung</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Xiaomi</a>
                                </li>
                              
                            </ul>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Máy tính bảng</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Laptop</a>
                        </li> -->
                    </ul>
                </div>
            </div>
            
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
?>