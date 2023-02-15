
<?php
    get_header();
    // show_array($list_cart);
    $temp = 0;

?>


<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="gio-hang" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix" style="min-height: 300px">
        <?php if(!empty($list_cart)) { ?>
        <div class="section" id="info-cart-wp" >
            <div class="section-detail table-responsive"> 
            
                <form action="?mod=cart&action=update" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Thành tiền</td>
                            <td>Tác vụ</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list_cart as $item) {  $temp++; ?>
                        <tr>
                            <td><?php echo $temp; ?></td>
                            <td>
                                <a href="?mod=product&action=detail&id=<?php echo $item['id'] ?>" title="" class="thumb">
                                    <img src="public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="?mod=product&action=detail&id=<?php echo $item['id'] ?>" title="" class="name-product"><?php echo $item['name'] ?></a>
                            </td>
                            <td><?php echo currency_format($item['price']) ?></td>
                            <td>
                                <input type="number" min="1", max= "20" data-id=<?php echo $item['id'] ?> name="qty[<?php echo $item['id'];?>]" value="<?php echo $item['qty'] ?>" class="num-order">
                            </td>
                            <td><span id="sub-total-<?php echo $item['id'] ?>"><?php echo currency_format ($item['sub_total']) ?></span></td>
                            <td>
                                <a href="?mod=cart&action=delete&id=<?php echo $item['id'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format ($total) ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <!-- <input type="submit" name="btn-update" id="update-cart" value="Cập nhật giỏ hàng"> -->
                                        <a href="thanh-toan" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </form>
                
            </div>
        </div>
        
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=cart&action=deleteAll" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
        <?php }else { ?>
            <p style="text-align: center; font-size: 17px; margin-top: 50px">Không có sản phẩm nào trong giỏ hàng. Click <a href="?">vào đây</a> để tiếp tục mua hàng</p>
        <?php } ?>
    </div>
</div>

<?php
    get_footer();
?>