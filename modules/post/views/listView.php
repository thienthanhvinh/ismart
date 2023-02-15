
<?php
    get_header();
    // show_array($post_data);
    // show_array($list_cat);
?>

<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=post&action=list" title="">Tin tức</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Tin tức</h3>
                </div>
                <?php if(!empty($post_data)) { ?>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach($post_data as $data) { ?>
                        <li class="clearfix">
                            <a href="tin-tuc/<?php echo create_slug(get_cat_name($list_cat, $data['cat_id'])) ?>/<?php echo create_slug($data['title']) ?>.html" title="" class="thumb fl-left">
                                <img src="public/uploads/images/posts/<?php echo $data['image'] ?>" alt="">
                                
                            </a>
                            <div class="info fl-right">
                                <a href="tin-tuc/<?php echo create_slug(get_cat_name($list_cat, $data['cat_id'])) ?>/<?php echo create_slug($data['title'])?>.html" title="" class="title"><?php echo $data['title'] ?></a>
                                <span class="create-date"><?php echo $data['created_date'] ?></span>
                                <p class="desc"><?php echo $data['post_desc'] ?></p>
                                <p class="post-category"><?php echo get_cat_name($list_cat, $data['cat_id'])?></p>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php  } ?>
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
            <?php if(!empty($list_best_sale)) { 
                shuffle($list_best_sale)    
            ?>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach(array_slice($list_best_sale,0, 7) as $item) { ?>
                        <li class="clearfix">
                            <a href="san-pham/<?php echo $item['slug'] ?>.html" title="" class="thumb fl-left">
                                <img class="img-sell" src="public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="san-pham/<?php echo $item['slug'] ?>.html" title="" class="product-name"><?php echo $item['name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format ($item['price']) ?></span>
                                    <span class="old"><?php echo print_old_price($item['old_price']) ?></span>
                                </div>
                                <a href="mua-ngay-<?php echo $item['product_id'] ?>" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/iphone-banner.png" alt="" style="border-radius: 8px; margin-bottom: 20px; width: 95%; height: 150px;">
                    </a>
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/xiaomi-banner.png" alt="" style="border-radius: 8px; width: 95%; height: 150px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    get_footer();
?>