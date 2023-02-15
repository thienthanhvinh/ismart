
<?php
    get_header();
    // show_array($list_order);
    $temp = 0;
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=order&action=list">Tất cả <span class="count">(<?php echo $num_order ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=order&action=process">Đang xử lý <span class="count">(<?php echo $num_process ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=order&action=transport">Đang vận chuyển<span class="count">(<?php echo $num_transport ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=order&action=complete">Hoàn thành<span class="count">(<?php echo $num_complete ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=order&action=cancel">Đơn hàng huỷ<span class="count">(<?php echo $num_cancel ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=order&action=trash">Thùng rác<span class="count">(<?php echo $num_trash ?>)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Đang xử lý</option>
                                <option value="2">Đang vận chuyển </option>
                                <option value="3">Hoàn thành</option>
                                <option value="5">Xoá tạm thời</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        
                    </div>
                    <div class="table-responsive">
                        <?php if(!empty($list_order)) { ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Khách hàng</span></td>
                                 
                                    <td><span class="thead-text">Tổng tiền</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list_order as $item) { $temp++; ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['customer_id'] ?>"></td>
                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                    <td><a href = "?mod=order&action=detail&id=<?php echo $item['customer_id'] ?>"><?php echo $item['code'] ?></h3></a>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <span><?php echo $item['name'] ?></span>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <!-- <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li> -->
                                            <li><a href="?mod=order&action=delete&id=<?php echo $item['customer_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    
                                    <td><span class="tbody-text"><?php echo currency_format ($item['total']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['order_date'] ?></span></td>
                                    <td><a href="?mod=order&action=detail&id=<?php echo $item['customer_id'] ?>" title=""><i class="fa-solid fa-ellipsis"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </form>
                        </table>
                        <?php }else { ?> 
                            <p style="color: red">Không tồn tại đơn hàng nào</p>
                        <?php } ?>
                </div>
            </div>
            <?php if($num_page > 1) { ?>
            <div class="section" id="paging-wp" style="margin-top: 20px">
                <div class="section-detail clearfix">
                
                   <?php echo get_paging($num_page, $page, "?mod=order&action=cancel") ?> 
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
    get_footer();
?>