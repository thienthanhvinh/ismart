<?php
    get_header();
    // show_array($list_cart);
    // show_array($list_province);

?>

<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=cart&action=checkOut" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="" name="form-checkout">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname">
                            <?php echo form_error('fullname') ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                            <?php echo form_error('email') ?>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <!-- <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address">
                        </div> -->
                        <div class="form-col fl-left">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" style="display:inline-block; width: 556px;">
                            <?php echo form_error('phone') ?>
                        </div>
                    </div>

                    <div class="form-row">
                    <label for="address">Địa chỉ</label>
                    <div class="form-row-add">
                        <select name="province" id="province" class="">
                            <option value="">-- Chọn tỉnh thành phố --</option>
                            <?php foreach($list_province as $item) { ?>
                            <option value="<?php echo $item['matp'] ?>"><?php echo $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    <?php echo form_error('province') ?>       
                    </div>

                      <div class="form-row-add"> 
                        <select name="district" id="district" class="">
                            <option value="">-- Chọn quận huyện -- </option>
                        </select>
                        <?php echo form_error('district') ?>
                    </div>

                    <div  class="form-row-add">
                    <select name="wards" id="wards" class="">
                        <option value="">-- Chọn xã phường -- </option>
                    </select>
                    <?php echo form_error('wards') ?>
                            </div>
                    <div class="form-row-add">
                        <input type="text" class="" name="apart-num" placeholder="Số nhà, tên đường" >
                        <?php echo form_error('apart-num') ?>
                    </div>
                    
                    <div class="form-row" style="margin-top: 5px">
                        <div class="form-col">
                            <label for="notes">Ghi chú (không bắt buộc)</label>
                            <textarea name="note" cols = "74" rows="5"></textarea>
                        </div>
                    </div>
                    </div>
                
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($list_cart)) { ?>
                        <?php foreach ($list_cart as $item) { ?>
                        <tr class="cart-item">
                            <td class="product-name"><?php echo $item['name'] ?><strong class="product-quantity">x <?php echo $item['qty'] ?></strong></td>
                            <td class="product-total"><?php echo currency_format($item['sub_total']) ?></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price"><?php echo currency_format ($total) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <!-- <li>
                            <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li> -->
                        <li>
                            <input type="radio" id="payment-home" name="payment-method" value="payment-home" checked>
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                    </ul>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" id="order-now" name="btn-order" value="Đặt hàng">
                </div>
            </div>   
        </div>
        </form>
    </div>
</div>


<?php
    get_footer();
?>