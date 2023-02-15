<?php
    get_header();
    $temp = 0;
?>


<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?page=add_page" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=page&action=listPage">Tất cả <span class="count"><?php echo "($num_page)" ?></span></a> |</li>
                            <li class="publish"><a href="?mod=page&action=public">Công khai <span class="count"><?php echo "($num_page_public)" ?></span></a> |</li>
                            <li class="pending"><a href="?mod=page&action=wait">Chờ duyệt <span class="count"><?php echo "($num_page_wait)" ?></span> |</a></li>
                            <li class="trash"><a href="?mod=page&action=trash">Thùng rác <span class="count"><?php echo "($num_page_temporary)" ?></span></a></li>
                        </ul>
                       
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <form action="" method="POST">
                    <div class="actions">
                        <div class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="2">Xoá tạm thời</option>
                        
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <?php if(!empty($list_page)) { ?>
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($list_page as $page) { ?>
                                   <?php $temp++  ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $page['id'] ?>"></td>
                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left" style="width: 55%">
                                            <a href="" title=""><?php echo $page['title'] ?></a>
                                        </div>
                                        <ul class="list-operation fl-right" style="width: 45%">
                                            <li><a href="?mod=page&action=edit&id=<?php echo $page['id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                 
                                    <td><span class="tbody-text"><?php echo $page['status'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['created_by'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo date_formatt ($page['created_date']) ?></span></td>
                                </tr>   
                                <?php } ?>                             
                            </tbody>
                            <?php } ?>
                        </table>
                        </form>
                    </div>

                </div>
            </div>
        
        </div>
    </div>
</div>


<?php
    get_footer();
?>