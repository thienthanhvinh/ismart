<?php
    get_header();
    // show_array($page_data);
    // $id = (int) $_GET['id'];

?>

<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <?php if($data_by_slug['title'] == "Giới thiệu") { ?>
                        <li>
                        <a href="<?php echo create_slug ($data_by_slug['title']) ?>.html" title="">Giới thiệu</a>
                        </li>
                    <?php } ?>
                    <?php if($data_by_slug['title'] == "Liên hệ") { ?>
                        <li>
                        <a href="?mod=page&action=detail&id=<?php echo $id ?>" title="">Liên hệ</a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
        <div class="main-content" style="width: 100% ">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    
                    <h3 class="section-title" style="text-align: center; font-size: 28px; font-weight: bold"><?php echo $data_by_slug['title'] ?></h3>
                </div>
                <div class="section-detail">
                    <!-- <span class="create-date"><?php echo $data_by_slug['created_date']?></span> -->
                    <div class="detail">
                        <p style="padding: 20px"><?php echo $data_by_slug['content'] ?></p>
                        
                        <!-- <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>
                        <p>Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn</p>
                        <p style="text-align: center;">
                            <img src="public/images/img-detail.jpg" alt="">
                        </p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời. Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn.</p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời. Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn.</p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p> -->
                    </div>
                </div>
              
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
       
    </div>
</div>

<?php
    get_footer();
?>