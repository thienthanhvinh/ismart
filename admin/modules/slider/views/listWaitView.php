
<?php
    get_header();
    // show_array($list_slider);
    $temp = 0;
?>

<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="?mod=slider&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <!-- <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li> -->
                            <li class="publish"><a href="?mod=slider&action=listPublic">Công khai <span class="count">(<?php echo $num_public ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=slider&action=listWait">Chờ duyệt <span class="count">(<?php echo $num_wait ?>)</span></a></li>
                            <!-- <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li> -->
                        </ul>
                        <!-- <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form> -->
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <!-- <option value="1">Công khai</option> -->
                                <option value="2">Công khai</option>
                                <option value="1">Xoá vĩnh viễn</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                      
                    </div>
                    <?php if(!empty($list_slider)) { ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Hình ảnh slider</span></td>
                                    <td><span class="thead-text">Link</span></td>         
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list_slider as $item) { 
                                    $temp++;    
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['slider_id'] ?>"></td>
                                    <td style="width: 10%;"><span class="tbody-text" style="margin-left: 15px"><?php echo $temp; ?></span></td>
                                    <td style="width: 18%">
                                        <div class="tbody-thumb" style="width: 120px; height: auto">
                                            <img src="http://localhost/ismart.com/public/uploads/images/sliders/<?php echo $item['thumb_slider'] ?>" alt=""  >
                                        </div>
                                    </td>
                                    <td style="width: 25%">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['link'] ?></a>
                                        </div>
                                        
                                    </td>
                                   
                                    <td style="width: 18%"><span class="tbody-text"><?php echo $item['status'] ?></span></td>
                                    <td style="width: 18%"><span class="tbody-text"><?php echo $item['created_by'] ?></span></td>
                                    <td style="width: 18%"><span class="tbody-text"><?php echo $item['created_date'] ?></span></td>
                                </tr>
                                <?php } ?>
                            </tbody>        
                        </table>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <!-- <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p> -->
                    <!-- <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
?>