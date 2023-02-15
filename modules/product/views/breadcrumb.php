<?php 
    $cat_id = (int) $_GET['cat_id'];
    $url = "?mod=product&action=list&cat_id=$cat_id";
    // echo $url;
?>

<ul class="list-item clearfix">
    <?php 
    echo basename($_SERVER["PHP_SELF"]);
        switch (basename($_SERVER["PHP_SELF"])) {
            case "$url":
                echo "<li><a href='?'>Trang sức</a></li>";
                break;

            default:
                echo  "<li><a href='?'>Trang chủ</a></li>
                       <li><a href='?'>Trang chủ</a></li>        
                    ";
                break;
        }
    
    
    ?>
</ul>