
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
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
     
        <div class="section" id="info-cart-wp" >
            <div class="section-detail" style="margin-top: 30px"> 
                <h2 style="text-align: center; font-size: 26px; color:green; margin-bottom: 10px; letter-spacing: 2px">Đặt hàng thành công !</h2>
                <p style="text-align:center; font-size: 16px ">Cảm ơn quý khách đã đặt hàng tại hệ thống Ismart</p>
                <p style="text-align:center;  font-size: 16px">Nhân viên chăm sóc sẽ liên hệ tới quý khách sớm nhất</p>    
                <p style="text-align:center;  font-size: 16px; font-weight: bold; margin-top: 15px; font-size: 18px">Mã đơn hàng: <span><?php echo $order_by_id['code'] ?></span></p>
            </div>
        </div>
        
        <div class="section" id="action-cart-wp">
            <div class="section-detail table-responsive">
                <h2 style="font-size: 18px; font-weight: bold; margin-bottom: 6px">Thông tin khách hàng</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $order_by_id['name'] ?></td>
                            <td><?php echo $order_by_id['phone'] ?></td>
                            <td><?php echo $order_by_id['apartment_number']. ', ' .get_wards_name($list_wards, $order_by_id['xaid']). ', ' .get_district_name($list_district, $order_by_id['maqh']). ', '  .get_city_name($list_city, $order_by_id['matp']) ?></td>
                            <td><?php echo $order_by_id['email'] ?></td>
                            <td><?php echo $order_by_id['note'] ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <h2 style="font-size: 18px; font-weight: bold; margin-bottom: 6px; margin-top: 30px">Thông tin đơn hàng</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($order_detail as $item) { $temp++; ?>
                        <tr>
                            <td><?php echo $temp; ?></td>
                            <td><img src="public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="" style="width: 90px; height: auto;"></td>
                            <td><?php echo $item['product_name'] ?></td>
                            <td><?php echo currency_format ($item['price']) ?></td>
                            <td><?php echo $item['qty'] ?></td>
                            <td><?php echo currency_format ($item['sub_total']) ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="5" style="font-weight: bold; font-size: 15px">Giá trị đơn hàng</td>
                            
                            <td><?php echo currency_format ($order_by_id['total']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      
    </div>
</div>

<?php
    get_footer();
?>