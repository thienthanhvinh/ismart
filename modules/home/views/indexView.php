
<?php
    get_header();
    // show_array($page_data);
    // show_array($list_outstanding);
    // show_array($list_date);
    // show_array($list_best_sale);
    // show_array($list_slider);
    
   
?>

<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <?php if(!empty($list_slider)) { ?>
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php foreach($list_slider as $item) { ?>
                    <div class="item">
                        <a href="<?php echo $item['link'] ?>">
                        <img style="height: 330px" src="public/uploads/images/sliders/<?php echo $item['thumb_slider'] ?>" alt="">
                        </a>
                        
                    </div>
                    <?php } ?>
                    <!-- <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div> -->
                </div>
            </div>
            <?php } ?>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <?php if(!empty($list_outstanding)) { 
                        shuffle($list_outstanding);     
                    ?>
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                    <!-- <span class="border-bottom-title"></span> -->
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach($list_outstanding as $item) { ?>
                        <li>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb">
                                <img class="img-index" src="public/uploads/images/products/<?php echo $item['thumb'] ?>">
                            </a>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo  currency_format($item['price']) ?></span>
                                <span class="old"><?php if ($item['old_price'] == null) { echo $item['old_price']; }else{ echo currency_format($item['old_price']);} ?></span>
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
            
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <?php if(!empty($list_discount)) { ?>
                    <h3 class="section-title">Sản phẩm giảm giá</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach($list_discount as $item) { 
                      
                        ?>
                        <li>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb">
                                <img class="img-index" src="public/uploads/images/products/<?php echo $item['thumb'] ?>">
                            </a>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format ($item['price']) ?></span>
                                <span class="old"><?php echo currency_format ($item['old_price']) ?></span>
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
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <?php if(!empty($list_date)) { ?>
                    <h3 class="section-title">Sản phẩm mới nhất</h3>
                </div>
                
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach(array_slice($list_date, 0, 6) as $item) { ?>
                        <li>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb">
                                <img class="img-index" src="public/uploads/images/products/<?php echo $item['thumb'] ?>">
                            </a>
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format ($item['price']) ?></span>
                                <span class="old"><?php if($item['old_price'] == null){ echo $item['old_price'];}else { echo currency_format ($item['old_price']);} ?></span>
                            </div>
                            <div class="action clearfix">
                                
                                <button type = "submit" title="Thêm giỏ hàng" data-id=<?php echo $item['product_id'] ?> class="add-cart fl-left" data-toggle = "modal" data-target="#myModal">Thêm giỏ hàng</button>
                                <!-- <button class="add-cart fl-left" data-id="<?php echo $item['product_id'] ?>">Thêm giỏ hàng</button> -->
                              
                           
                                <a href="mua-ngay-<?php echo $item['product_id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                </div>
             
            </div>      
                    <!-- <div class="model-contain">
                        <div class ="popup">
                                <img src="./public/images/ticker_1.png" alt="">
                                <h2>Thêm sản phẩm thành công !</h2>
                                <p>Bạn có muốn đi đến giỏ hàng ?</p>
                                <div class="btn-cart">
                                <a href="">Không</a>
                                <a href="?mod=cart&action=detail">Có</a>
                                </div>
                        </div>                     
                    </div> -->
                        <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog ">
            <div class="modal-content">                
                <img src="public/images/ticker_1.png" alt="">
                <h2>Thêm sản phẩm thành công !</h2>
                <p>Bạn có muốn đi đến giỏ hàng ?</p>
                <a class="btn-go-cart" href="gio-hang">Giỏ hàng</a>
                <a class="btn-close" href="" data-dismiss="modal">Ở lại trang này</a>

            </div>
        </div>
    </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.add-cart').click(function () {
                    $('.model-contain').css('transform', 'scale(1)');
            });
            });
        </script>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                    <?php echo data_tree($list_cat)?>
                    </ul>
                </div>
            </div>
          
            <div class="section" id="selling-wp">
                <?php if(!empty($list_best_sale)) {
                    shuffle($list_best_sale);    
                ?>
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        
                        <?php foreach(array_slice($list_best_sale, 0 ,7) as $item) { ?>
                        <li class="clearfix">
                            <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb fl-left">
                                <img class="img-sell" src="public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php  echo currency_format ($item['price']) ?></span>
                                    <span class="old"><?php echo print_old_price ($item['old_price']) ?></span>
                                </div>
                                <!-- <a href="" title="" class="buy-now">Mua ngay</a> -->
                                <a href="mua-ngay-<?php echo $item['product_id'] ?>" title="Mua ngay" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/samsung-banner.png" alt="" style="height: 200px; width: 95%; border-radius: 8px">
                    </a>

                    <a href="" title="" class="thumb">
                        <img src="public/images/apple-watch.png" alt="" style="height: 200px; width: 95%; border-radius: 8px; margin-top: 28px">
                    </a>

                    <a href="" title="" class="thumb">
                        <img src="public/images/sale-banner.jpg" alt="" style="height: 200px; width: 95%; border-radius: 8px; margin-top: 28px">
                    </a>
                    <a href="" title="" class="thumb">
                        <img src="public/images/lenovo-banner.png" alt="" style="height: 200px; width: 95%; border-radius: 8px; margin-top: 28px">
                    </a>
                </div>
            </div>
        </div>
    </div>



</div>

<?php
    get_footer();
?>
                    