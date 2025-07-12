<?php 
$conn = mysqli_connect('localhost', 'root', 'Thanhvinh123', 'ismart');
if(!$conn){
    echo "Kết nối không thành công".mysqli_connect_error();
    die();
}
else{
    // echo "Kết nối thành công";
}
?>

<?php 

if(isset($_GET['province_id'])) {
    $province_id = $_GET['province_id'];
    // $sql_list_child = mysqli_query($conn,"SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$parent_id}'");
    $sql = "SELECT * FROM `tbl_quanhuyen` WHERE `matp` = '{$province_id}'";
    $result = mysqli_query($conn, $sql);
    $output = "<option>-- Chọn quận huyện --</option>";

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output.= '<option value = "'.$row['maqh'].'">'.$row['name'].'</option>';
        }
        echo $output;
    }else {
        echo "0 result";
    }  
  
}

if(isset($_GET['district_id'])) {
    $district_id = $_GET['district_id'];
    // $sql_list_child = mysqli_query($conn,"SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$parent_id}'");
    $sql = "SELECT * FROM `tbl_xaphuongthitran` WHERE `maqh` = '{$district_id}'";
    $result = mysqli_query($conn, $sql);
    $output = "<option>-- Chọn xã phường --</option>";

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output.= '<option value = "'.$row['xaid'].'">'.$row['name'].'</option>';
        }
        echo $output;
    }else {
        echo "0 result";
    }  
  
}



?>