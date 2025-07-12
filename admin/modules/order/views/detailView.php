<?php
    get_header();
    // show_array($order_by_id);
    // show_array($order_detail);
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <h2 class="order-title">thông tin khách hàng</h2>
            <table class="table table-bordered" id="tbl-info">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><p><?php echo $order_by_id['code'] ?></p></td>
                        <td><p><?php echo $order_by_id['name'] ?></p></td>
                        <td><p><?php echo $order_by_id['phone'] ?></p></td>
                        <td><p><?php echo $order_by_id['email'] ?></p></td>
                        <td><p><?php echo $order_by_id['apartment_number']. ', ' .get_wards_name($list_wards, $order_by_id['xaid']). ', ' .get_district_name($list_district, $order_by_id['maqh']). ', '  .get_city_name($list_city, $order_by_id['matp']) ?></p></td>
                
                        <td><p><?php echo $order_by_id['order_date'] ?></p></td>
                        <td><p><?php echo $order_by_id['note'] ?></p></td>
                    </tr>
                </tbody>
            </table>
            <div id="order-status">
                <div class="status">
                    <p>Trạng thái đơn hàng: <span><?php echo $order_by_id['status'] ?></span></p>
                    <form action="" method="POST">
                    <select name="sl-status" id="">
                        <option value=""><?php echo $order_by_id['status'] ?></option>
                        <option value="1">Đang xử lý</option>
                        <option value="2">Đang vận chuyển</option>
                        <option value="3">Hoàn thành</option>
                        <option value="4">Huỷ đơn</option>
                    </select>
                    <input type="submit" name="btn-edit" value="Cập nhật">
                    </form>
                </div>
                <table class="table table-bordered" id="tbl-num">
                    <thead>
                        <tr>
                            <th>Số sản phẩm</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $order_by_id['num_order'] ?></td>
                            <td><?php echo currency_format ($order_by_id['total']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div> <!--end order-status -->

            <div id="order-detail">
                <h2>Chi tiết đơn hàng</h2>
                <table class="table table-hover" id="tbl-detail">
                    <thead>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </thead>
                    <tbody>
                        <?php foreach($order_detail as $item) { ?>
                    <tr>    
                        <td><img src="http://localhost/ismart.com/public/uploads/images/products/<?php echo $item['thumb'] ?>" alt="" style="width: 90px; height: auto; margin: auto"></td>
                        <td><p style="display: inine-block; margin-top: 15px"><?php echo $item['product_name'] ?></p></td>
                        <td><p style="display: inine-block; margin-top: 15px"><?php echo $item['qty'] ?></p></td>
                        <td><p style="display: inine-block; margin-top: 15px"><?php echo currency_format ($item['price']) ?></p></td>
                        <td><p style="display: inine-block; margin-top: 15px"><?php echo currency_format ($item['sub_total']) ?></p></td>
                    </tr>
                    <?php } ?>
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
    get_footer();
?>