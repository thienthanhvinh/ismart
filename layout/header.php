<?php
    // show_array($page_data);
    // show_array($list_cart);
    // show_array($list_cat);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ISMART STORE</title>
        <base href="<?php echo base_url();  ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="public/js/zoomsl.min.js"></script>
        <!-- <script src="public/js/zoom.js"></script>
        <script src="public/js/jquery.js"></script> -->
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="" title="">Trang chủ</a>
                                    </li>
                                    <!-- <li>
                                        <a href="?mod=product&action=list" title="">Sản phẩm</a>
                                    </li> -->
                                    <li>
                                        <a href="tin-tuc" title="">Tin tức</a>
                                    </li>
                                    <?php foreach($page_data as $data) { ?>
                                    <li>
                                        <a href="<?php echo $data['slug'] ?>.html" title=""><?php echo $data['title']?></a>
                                    </li>
                                    <?php  } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="logo" class="fl-left"><img src="public/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="tim-kiem">
                                    <input type="text" name="search" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" autocomplete="off">
                                    <button type="submit" name="sm-s" id="sm-s">Tìm kiếm</button>
                                </form>
                                <div class="search-result">
                                    <!-- <ul class="list-result">
                                        <li>
                                            <a href="">
                                                <div class="img-product">
                                                    <img src="public/images/test-thumb.jpg" alt="">
                                                </div>
                                                <div class="info-product">
                                                    <p class="pr-name">Iphone 13 Mini 512Gb</p>
                                                    <span class="new-price">8000000d</span><span class="old-price">12000000d</span>
                                                    
                                                </div>
                                            </a>    
                                        </li>

                                        <li>
                                            <a href="">
                                                <div class="img-product">
                                                    <img src="public/images/test-thumb.jpg" alt="">
                                                </div>
                                                <div class="info-product">
                                                    <p class="pr-name">Iphone 13 Mini 512Gb</p>
                                                    <span class="new-price">8000000d</span><span class="old-price">12000000d</span>
                                                    
                                                </div>
                                            </a>
                                            
                                        </li>
                                    </ul> -->
                                </div>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <!-- <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </a> -->
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <a href="gio-hang">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span id="num"><?php echo $num_order_cart ?></span>
                                        </a> 
                                    </div>
                                    <?php if(!empty($list_cart)) { ?>
                                    <div id="dropdown">
                                        <p class="desc">Có <span> <?php echo $num_order_cart ?> sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php foreach(array_slice ($list_cart, 0, 3) as $item) { ?>
                                            <li class="clearfix">
                                                <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="thumb fl-left">
                                                    <img src="public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="<?php echo get_cat_name_index($list_cat, $item['cat_id']) ?>/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                                                    <p class="price"><?php echo currency_format($item['price']) ?></p>
                                                    <p class="qty">Số lượng: <span><?php echo $item['qty'] ?></span></p>
                                                </div>
                                            </li>
                                           <?php } ?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="total-price fl-right"><?php echo currency_format($total) ?></p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="gio-hang" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="thanh-toan" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>