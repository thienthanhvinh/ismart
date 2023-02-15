<?php 
    get_header();
    // show_array($list_customer);
   
    
?>
<style>
    #list-dard {
        display: flex;
        justify-content: space-between;
        margin: 0px 2px;
        margin-top: 12px;
    }
    #list-dard .item-dard {
        border-radius: 4px;
        color: #fff;
        padding: 10px 20px;
        width: 19.4%;
    }
    .item-dard .title-dard {
        padding-top: 5px;
        padding-bottom: 8px;
        border-bottom: 1px solid #bdc3c7;
        
    }
    .item-dard .title-dard h2 {
        font-size: 16px;
        text-transform: uppercase;
    }
    .item-dard .sale-dard {
        margin-top: 10px;
        font-size: 14px;
    }
    .item-dard .sale-dard p {
        margin-bottom: 8px;
    }
    #tb-dash tr th {
        padding-top: 12px;
        padding-bottom: 12px;
    }
    #tb-dash tr td {
        padding-top: 13px;
        padding-bottom: 13px;
    }

</style>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <!-- <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div> -->
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <ul id="list-dard">
                        <li class="item-dard" style="background-color: #007bff;">
                            <div class="title-dard">
                                <h2>Đơn hàng thành công</h2>
                            </div>
                            <div class="sale-dard">
                                <p style="font-size: 15px"><?php echo $num_complete ?></p>
                                <p>Đơn hàng giao dịch thành công</p>
                            </div>         
                        </li>
                        <li class="item-dard" style="background-color: #dc3545;">
                            <div class="title-dard">
                                <h2>Đang xử lý</h2>
                            </div>
                            <div class="sale-dard">
                                <p style="font-size: 15px"><?php echo $num_process ?></p>
                                <p>Đơn hàng đang xử lý</p>
                            </div>         
                        </li>
                        <li class="item-dard" style="background-color: #17a2b8;">
                            <div class="title-dard">
                                <h2>Đang vận chuyển</h2>
                            </div>
                            <div class="sale-dard">
                                <p style="font-size: 15px"><?php echo $num_transport ?></p>
                                <p>Đơn hàng đang vận chuyển</p>
                            </div>         
                        </li>
                        <li class="item-dard" style="background-color: #28a745;">
                            <div class="title-dard">
                                <h2>Doanh số</h2>
                            </div>
                            <div class="sale-dard">
                                <p style="font-size: 15px"><?php echo currency_format ($final_total) ?></p>
                                <p>Doanh số hệ thống</p>
                            </div>         
                        </li>
                        <li class="item-dard" style="background-color: #6c757d;">
                            <div class="title-dard">
                                <h2>Đơn hàng huỷ</h2>
                            </div>
                            <div class="sale-dard">
                                <p style="font-size: 15px"><?php echo $num_cancel ?></p>
                                <p>Đơn hàng bị huỷ</p>
                            </div>         
                        </li>
                       
                    </ul>
                </div>
                <?php if(!empty($list_customer)) {  $temp = 0; ?>
                <h3 style="margin-top: 27px; font-size: 16px; font-weight: bold; margin-left: 5px; margin-bottom: 7px">ĐƠN HÀNG MỚI</h3>
                <table class="table table-hover" id="tb-dash">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list_customer as $item) { $temp++; ?>
                        <tr>
                            <td><?php echo $temp; ?></td>
                            <td><?php echo $item['code'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo currency_format ($item['total']) ?></td>
                            <td><?php echo $item['status'] ?></td>
                            <td><?php echo $item['order_date'] ?></td>
                            <td><a href="?mod=order&action=detail&id=<?php echo $item['customer_id'] ?>" title=""><i class="fa-solid fa-ellipsis"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
            
            <?php if($page > 1) { ?>
            <div class="section" id="paging-wp" style="margin-top: 25px">
                <div class="section-detail clearfix">
                  <?php echo get_paging($num_page, $page, "?mod=dashboard&action=dashBoard") ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
    get_footer();
?>