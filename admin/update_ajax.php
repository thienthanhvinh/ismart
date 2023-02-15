<?php 
$conn = mysqli_connect('localhost', 'root', '', 'ismart');
if(!$conn){
    echo "Kết nối không thành công".mysqli_connect_error();
    die();
}
else{
    // echo "Kết nối thành công";
}


?>

<?php 

if(isset($_GET['parent_id'])) {
    $parent_id = $_GET['parent_id'];
    // $sql_list_child = mysqli_query($conn,"SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$parent_id}'");
    $sql = "SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$parent_id}'";
    $result = mysqli_query($conn, $sql);
    $output = "<option>-- Chọn danh mục con --</option>";

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output.= '<option value = "'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
        }
        echo $output;
    }else {
        echo "0 result";
    }  
  
}



?>