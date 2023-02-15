<?php
    get_header();
//    show_array($product_one_image);
//    show_array($product);
    // $cat_id = (int) $_GET['cat_id'];
    // $id = (int) $_GET['id'];
    $product_name = get_product_name($slug);
    $cat_name = get_cat_name($product['cat_id']);

?>

<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo create_slug($cat_name['cat_name']) ?>"><?php echo $cat_name['cat_name'] ?></a>
                    </li>
                    <li>
                        <a href="?mod=product&action=detail&cat_id=<?php echo $cat_id ?>&id=<?php echo $id ?>"><?php echo $product_name['name'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <?php foreach(array_slice($product_image, 0, 1) as $item) { ?>
                        <a href="" title="" id="main-thumb" >                         
                            <img id="main-img" src="public/uploads/images/products/<?php echo $item['image_name'] ?>" >
                        </a>
                        <?php } ?>
            
                        <div id="list-thumb">
                        <?php foreach($product_image as $item) { ?>
                            <div class="">
                                  <a  data-image="public/uploads/images/products/<?php echo $item['image_name'] ?>" >
                                  <img src="public/uploads/images/products/<?php echo $item['image_name'] ?>" class="small-img"  />
                                  </a>      
                                  <p style="text-align: center; margin-top: 5px; font-size: 13px; line-height: 1.2"><?php echo get_color_name($list_color ,$item['color_id']) ?></p>
                            </div>            
                            <?php
                                } 
                            ?>
                        </div>
                        
                    </div>
                    
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['name'] ?></h3>
                        <div class="desc">
                            <p><?php echo $product['product_desc'] ?></p>
                           
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php echo $product['status'] ?></span>
                        </div>
                        <p class="price"><?php echo currency_format ($product['price']) ?></p>
                        <form action="?mod=product&action=add&id=<?php echo $product['product_id'] ?>" method="POST">
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" min="1" max= "10" name= "num_order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <!-- <a href="?mod=cart&action=add&id=<?php echo $product['product_id'] ?>" title="Thêm giỏ hàng" class="add-cart-detail">Thêm giỏ hàng</a> -->
                        <input type="submit" class="add-cart-detail" value="Thêm giỏ hàng" name="btn-add-cart"></input>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p><?php echo $product['detail'] ?></p>
                </div>
                <div class="bg-article"></div>
                <button id="view-more">Xem thêm</button>
            </div>
            <script>
    var mainImg = document.getElementById('main-img');
    var smallImg = document.getElementsByClassName('small-img');  
smallImg[0].onclick = function() {
    mainImg.src = smallImg[0].src;
}  
smallImg[1].onclick = function() {
    mainImg.src = smallImg[1].src;
}  
smallImg[2].onclick = function() {
    mainImg.src = smallImg[2].src;
} 
smallImg[3].onclick = function() {
    mainImg.src = smallImg[3].src;
}
smallImg[4].onclick = function() {
    mainImg.src = smallImg[4].src;
}
smallImg[5].onclick = function() {
    mainImg.src = smallImg[5].src;
}
smallImg[6].onclick = function() {
    mainImg.src = smallImg[6].src;
}
smallImg[7].onclick = function() {
    mainImg.src = smallImg[7].src;
}
</script>
            <?php if(!empty($product_same)) { shuffle($product_same) ?>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                      <?php  foreach($product_same as $item) { ?>
                        <li>
                            <a href="san-pham/<?php echo $item['slug'] ?>.html" title="" class="thumb">
                                <img class="img-index" src="public/uploads/images/products/<?php echo $item['thumb'] ?>" style="width: 120px">
                            </a>
                            <a href="san-pham/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price'])?></span>
                                <span class="old"><?php if ($item['old_price'] == null) { echo $item['old_price']; }else{ echo currency_format($item['old_price']);} ?></span>
                            </div>
                            <div class="action clearfix">
                                <button type = "submit" title="Thêm giỏ hàng" data-id=<?php echo $item['product_id'] ?> class="add-cart fl-left" data-toggle = "modal" data-target="#myModal">Thêm giỏ hàng</button>
                                <a href="?mod=cart&action=buyNow&id=<?php echo $item['product_id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog ">
                        <div class="modal-content">                
                            <img src="./public/images/ticker_1.png" alt="">
                            <h2>Thêm sản phẩm thành công !</h2>
                            <p>Bạn có muốn đi đến giỏ hàng ?</p>
                            <a class="btn-go-cart" href="?mod=cart&action=detail">Giỏ hàng</a>
                            <a class="btn-close" href="" data-dismiss="modal">Ở lại trang này</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
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
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
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



