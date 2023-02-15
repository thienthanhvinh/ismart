
<?php
    get_header();
    // show_array($list_cat_name);
    $temp = 0;
?>

<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
    <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="?mod=post&action=addCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên danh mục</span></td>
                                    <td><span class="thead-text">Slug</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <?php 
                                if(!empty($list_cat)) {
                                ?>
                            <tbody>
                                 <?php foreach($list_cat_name as $item) { 
                                    $temp++;
                                    ?>
                                <tr>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo str_repeat('-', $item['level']).$item['cat_name'] ?></a>
                                        </div> 
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=post&action=editCat&cat_id=<?php echo $item['cat_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=post&action=deleteCat&cat_id=<?php echo $item['cat_id']?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    
                                    <td><span class="tbody-text"><?php echo $item['slug'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['created_by'] ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['created_date'] ?></span></td>                                 
                                </tr>
                                <?php 
                                    }
                                    ?>
                            </tbody>
                            <?php
                                }
                                ?>
                        </table>
                    </div>
                    
                </div>
            </div>
          
        </div>
    </div>
</div>

<?php
    get_footer()
?>