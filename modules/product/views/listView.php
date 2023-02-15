
<?php
    get_header();
    // show_array($list_product);
    // show_array($list_child);
    // $cat_id_url = (int) $_GET['cat_id'];
    // echo $cat_id_url;
   
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
                        <a href="<?php echo create_slug ($cat_name['cat_name']) ?>" title=""><?php echo $cat_name['cat_name'] ?></a>
                    </li>
                </ul>
        
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $cat_name['cat_name'] ?></h3>
                    <!-- <span class="border-bottom-title-list"></span> -->
                </div>
                <div class="section-detail">
                    <?php if(!empty($list_product)) { ?>
                    <ul class="list-item clearfix list-filter">
                        <?php foreach ($list_product as $item) { ?>
                        <li>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb">
                                <img src="public/uploads/images/products/<?php echo $item['thumb'] ?>" class="img-index">
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

            <div class="section" id="paging-wp">
                <?php if(!empty($list_product)) { ?>
                <div class="section-detail-paging">
                    <?php  
                    // $url = base_url("?mod=product&action=list&cat_id = {$cat_id}");
                    $url = get_url_paging($list_cat, 0, $cat_id);
                    // echo $url;
                    if($num_page > 1) {
                    echo get_paging($num_page, $page, $url);
                    }
                    ?>
                    <!-- <ul id='list-paging'>
                            <li><a href=""><<</a></li>
                            <li class="active"><a href=""></a>1</li>
                            <li><a href=""></a>2</li>
                            <li><a href=""></a>3</li>
                            <li><a href=""></a>4</li>
                            <li><a href=""></a>5</li>
                            <li><a href="">>></a></li>
                        </ul> -->
                </div>
                <?php } ?>
            </div>
            
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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" class="filter-price" value="0 and 1999999"></td>
                                    <td>Dưới 2 triệu</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="filter-price" value="2000000 and 4000000"></td>
                                    <td>Từ 2 - 4 triệu</td>
                                    <!-- <input type="hidden" id="two_mini_price" value="2000000">
                                    <input type="hidden" id="two_mini_price" value="4000000"> -->
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class=" filter-price" value="4000000 and 7000000"></td>
                                    <td>Từ 4 - 7 triệu</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="filter-price" value="7000000 and 13000000"></td>
                                    <td>Từ 7 đến 13 triệu</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="filter-price" value="13000001 and 9999999999"></td>
                                    <td>Trên 13 triệu</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="info-slug" style="display: none">
                            <input type="text" id="name-slug" value="<?php echo $_GET['slug'] ?>">
                        </div>
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