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
                    <h3 id="index" class="fl-left">Danh sách bài viết chờ duyệt</h3>
                    <a href="?mod=post&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="post/list">Tất cả <span class="count">(<?php echo $num_restore?>)</span></a> |</li>
                            <li class="publish"><a href="post/public">Công khai <span class="count">(<?php echo $num_public?>)</span></a> |</li>
                            <li class="pending"><a href="post/wait">Chờ duyệt <span class="count">(<?php echo $num_wait?>)</span></a></li>
                            <li class="trash"><a href="post/trash">Thùng rác <span class="count">(<?php echo $num_trash?>)</span></a></li>
                        </ul>
                        <form action="post/list" method="POST"  class="form-s fl-right">
                            <input type="text" name="search">
                            <input type="submit" name="sm_s"  value="Tìm kiếm">
                        </form>
                    </div>
                    <form action="" method="POST">
                    <div class="actions">
                        <div class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="3">Xoá tạm thời</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <?php if(!empty($list_post)) { ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Ảnh</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list_post as $post) { 
                                    $temp++;
                                    ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $post['id'] ?>"></td>
                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                    <td><img style="width: 105px; height: 55px;" src="http://localhost/ismart.com/public/uploads/images/posts/<?php echo $post['image'] ?>" alt=""></td>

                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=post&action=edit&id=<?php echo $post['id'] ?>" title=""><?php echo $post['title'] ?></a>
                                        </div>
                                        <ul class="list-operation fl-right" style="width: 18%">
                                            <li><a href="?mod=post&action=edit&id=<?php echo $post['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=post&action=delete&id=<?php echo $post['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo print_cat_name($cat_name, $post['cat_id']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['public_wait'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['created_by'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $post['created_date'] ?></span></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                          
                        </table>
                        <?php }else { ?>

                        <p style= "color: red">
                        <?php
                            echo "Không tìm thấy bản ghi nào"; 
                            }
                        ?>
                        </p>
                    </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>

<?php
    get_footer();
?>

