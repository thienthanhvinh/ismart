
<?php
function construct() {
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

// function indexAction() {

// }


function addAction() {
    $id = (int) $_GET['id'];
    add_cart($id);
    redirect("gio-hang");
    
}

function addAjaxAction() {
    $id = $_GET['id'];
    add_cart($id);
    $num_order_cart = get_num_order_cart();
    $list_cart = get_list_buy_cart();
    $total = get_total_cart();
    $op_total = '';
    $output = '';

    foreach(array_slice($list_cart, 0, 1 ) as $item) {        
        $output .= '
        <div id="btn-cart">
        <a href="?mod=cart&action=detail">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span id="num">'. $num_order_cart .'</span>
        </a> 
    </div>
        <div id="dropdown">
        <p class="desc">Có <span> '. $num_order_cart .' sản phẩm</span> trong giỏ hàng</p>
        <ul class="list-cart">
            <li class="clearfix">
                <a href="?mod=product&action=detail&id='. $item['id'] .'" title="" class="thumb fl-left">
                    <img src="public/uploads/images/products/'. $item['thumb'].'" alt="">
                </a>
                <div class="info fl-right">
                <a href="?mod=product&action=detail&id='. $item['id'] .'" title="" class="product-name">'. $item['name'].'</a>
                    <p class="price">'. currency_format($item['price']) .'</p>
                    <p class="qty">Số lượng: <span>'. $item['qty'] .'</span></p>
                </div>
            </li>
            
                </ul>
            <div class="total-price clearfix">
                <p class="title fl-left">Tổng:</p>
                <p class="total-price fl-right">'. currency_format($total) .'</p>
            </div>
            <div class="action-cart clearfix">
                <a href="?mod=cart&action=detail" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                <a href="?mod=cart&action=checkOut" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
            </div>
        </div
        
        ';
    }
        echo $output;
    

    // $op_total = '
    // <p class="total-price fl-right">'. currency_format($total) .'</p>

    // ';

    // $data = array(
    //     // 'num_order_cart' => $num_order_cart,
    //     // 'list_cart' => $list_cart,
    //     // 'total' => $op_total,
    //     'output' => $output,
        
    // );

    // echo json_encode($data);

}

// function updateAction() {
//     if(isset($_POST['btn-update'])) {
//         $qty = $_POST['qty'];
//         update_cart($qty);
//         redirect("?mod=cart&action=detail");
//     }
   
// }

function buyNowAction() {
    $id = (int) $_GET['id'];
    add_cart($id);
    redirect("thanh-toan");
}

function detailAction() {
    $page_data = get_page_data();
    $data['page_data'] = $page_data;

    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    $total = get_total_cart();
    $data['total'] = $total;
    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;

    load_view('detail', $data);
}

function deleteAction() {
    $id = (int) $_GET['id'];
    delete_cart($id);
    redirect("?mod=cart&action=detail");
}

function deleteAllAction() {
    delete_all_cart();
    redirect("?mod=cart&action=detail");
}

function checkOutAction() {
    $conn = mysqli_connect('localhost', 'root', 'Thanhvinh123', 'ismart');
    if(!$conn){
        echo "Kết nối không thành công".mysqli_connect_error();
        die();
    }

    $list_cart = get_list_buy_cart();
    $data['list_cart'] = $list_cart;
    // show_array($list_cart);
    $page_data = get_page_data();
    $data['page_data'] = $page_data;

    
    $total = get_total_cart();
    $data['total'] = $total;
    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;

    $list_province = get_list_province();
    $data['list_province'] = $list_province;
    $list_city = get_list_city();
   
    $list_district = get_list_district();
    
    $list_wards = get_list_wards();
    


    if(isset($_POST['btn-order'])) {
        global $error;
        $error = array();

        $content = '';

        if(empty($_POST['fullname'])) {
            $error ['fullname'] = "Vui lòng nhập họ và tên";
        }else {
            $fullname = $_POST['fullname'];
        }
        if(empty($_POST['email'])) {
            $error ['email'] = "Vui lòng nhập email";
        }else {
            $email = $_POST['email'];
        }
        if(empty($_POST['phone'])) {
            $error ['phone'] = "Vui lòng nhập số điện thoại";
        }else {
            $phone = $_POST['phone'];
        }


        if(empty($_POST['province'])) {
            $error ['province'] = "Vui lòng chọn tỉnh thành phố";
        }else {
            $province = $_POST['province'];
        }
        if(empty($_POST['district'])) {
            $error ['district'] = "Vui lòng chọn quận huyện";
        }else {
            $district = $_POST['district'];
        }
        if(empty($_POST['wards'])) {
            $error ['wards'] = "Vui lòng chọn xã phường";
        }else {
            $wards = $_POST['wards'];
        }
        if(empty($_POST['apart-num'])) {
            $error ['apart-num'] = "Vui lòng nhập số nhà, tên đường";
        }else {
            $apart_num = $_POST['apart-num'];
        }

        
        
        $string_code = '0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
        $first_part = "ISM-";
        $second_part = substr(str_shuffle ($string_code), 0, 9);
        $code =  $first_part.$second_part;
        $note = $_POST['note'];

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $order_date = date('Y-m-d H:i:s');
        $edit_date = $order_date;
        
       
       
        if(!empty($note)) {
        if(empty($error)) {
            $content .= '
            <div id="form-mail" style="background-color: #dfe6e9; width: 650px; font-size: 13px; padding-bottom: 5px; margin: 0px auto">
            <div class="mail-header" style="margin: 0px 15px; padding-top: 5px; border-bottom: 1px solid #b2bec3; padding-bottom: 5px">
                <h2 style="font-size: 17px; color: #444; margin-bottom: 12px; ">Chào '. $fullname .'. Đơn hàng của bạn đã đặt thành công !</h2>
                <p style="padding: 0px; margin:0px">Chúng tôi đang chuẩn bị hàng để bàn giao cho đơn vị vận chuyển</p>
                <p style="margin:0px; padding-top: 10px;  color: #0984e3; font-weight: bold">Mã đơn hàng: '. $code .'</p>
                <p style="margin:0px; padding-top: 5px;  color: #0984e3; font-weight: bold">Ngày đặt: '. $order_date .'</p>
            </div>
            <div class="mail-body" style=" padding-top: 5px; margin: 0 15px">
                <div class="info-address" style="display: flex;">
                    <div class="info" style="margin-right: 140px">
                        <p style="color: #444; font-weight: bold; margin-top: 9px; margin-bottom: 9px; font-size: 14px">Thông tin khách hàng</p>
                        <p style="margin: 0px; margin-bottom: 8px">'. $fullname .'</p>
                        <p style="margin: 0px; margin-bottom: 8px">'. $email .'</p>
                        <p style="margin: 0px">'. $phone .'</p>
                    </div>
                    <div class="address">
                        <p style="color: #444; font-weight: bold; margin-top: 9px; margin-bottom: 9px; font-size: 14px">Địa chỉ giao hàng</p>
                        <p style="margin: 0px">'. get_address_name($apart_num, $wards, $district, $province, $list_wards, $list_district, $list_city) .'</p>
                    </div>
                </div>
                <!-- end info-address -->
                <p style="color: #444; font-weight: bold; margin-top: 25px; margin-bottom: 9px; font-size: 14px">Thông tin đơn hàng</p>
                <table style=" width: 100%; ">
                    <thead style="background-color: #ff191a; color: #ecf0f1; margin: 0px; font-size: 14px; text-align: center;">
                        <tr style="font-size: 13px">
                            <th style="padding: 6px 0px; ">TÊN SẢN PHẨM</th>
                            <th style="padding: 6px 0px;">GIÁ</th>
                            <th style="padding: 6px 0px;">SỐ LƯỢNG</th>
                            <th style="padding: 6px 0px;">THÀNH TIỀN</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;padding-top: 5px; ">
                    ';
                    foreach($list_cart as $item) {
                    $content .= '<tr style="font-size: 14px">
                            <td  style="color: #444; font-weight: bold; width: 25%">'. $item['name'] .'</td>
                            <td style="width: 25%">'. currency_format($item['price']) .'</td>
                            <td style="width: 25%">'. $item['qty'] .'</td>
                            <td style="width: 25%">'. currency_format($item['sub_total']) .'</td>
                        </tr>
                        ';
                    };
    
                    $content .= '
                        <tr>
                            <td colspan="3" style="text-align: left; color: black; font-weight: bold; padding: 6px 0px; text-transform: uppercase; font-size: 14px; ">Giá trị đơn hàng:</td>
                            <td style="padding: 6px; 0pxl color: black; font-weight: bold; font-size: 14px">'. currency_format($total).'</td>
                        </tr>
                    </tbody>
                </table>
                <p style="">Quý khách vui lòng giữ lại hoá đơn, hộp sản phẩm và phiếu bảo hành để đổi trả hàng hoặc bảo hành khi cần thiết. Thời gian đổi trả hàng dưới 15 ngày kể từ ngày nhận hàng</p>
                <p style=" font-weight: bold">Liên hệ Hotline: <span style="font-weight: normal"> 036989154 nếu quý khách có bất kì thắc mắc nào hoặc <span style="color: red">nếu không phải quý khách đặt hàng</span></span></p>
                <p style="font-weight: bold">Ismart V xin trân thành cảm ơn quý khách đã đặt hàng !</p>
            </div>
        </div>
        ';  
    
                $query1 = "INSERT INTO `tbl_customers` (`code`, `name`, `phone`, `email`, `total`, `num_order`, `order_date`, `edit_date`, `note`, `matp`, `maqh`, `xaid`, `apartment_number` ) VALUES ('$code', '$fullname', '$phone', '$email', '$total', '$num_order_cart', '$order_date', '$edit_date', '$note', '$province', '$district', '$wards', '$apart_num')";
                if (mysqli_query($conn, $query1)) {
                        // echo 'done';
                        $order_id = mysqli_insert_id($conn);
                        foreach($list_cart as $item) {
                            $product_name = $item['name'];
                            $thumb = $item['thumb'];
                            $qty = $item['qty'];
                            $price = $item['price'];
                            $sub_total = $item['sub_total'];

                            $query2 = "INSERT INTO `tbl_orders` (`order_id`, `product_name`, `thumb`, `qty`, `price`, `sub_total`) VALUES ('$order_id', '$product_name', '$thumb', '$qty', '$price', '$sub_total')";
                            mysqli_query($conn, $query2);
                            echo send_mail($email, $fullname, "[Ismart V] Thông báo đặt hàng thành công", $content);
                            redirect("dat-hang-thanh-cong-{$order_id}");
                            unset($_SESSION['cart']);                
                        }
                       
                }else {
                    echo "Fail connect";
                }
            }
            
        }else {
            if(empty($error)) {
                $content .= '
                <div id="form-mail" style="background-color: #dfe6e9; width: 650px; font-size: 13px; padding-bottom: 5px; margin: 0px auto">
                <div class="mail-header" style="margin: 0px 15px; padding-top: 5px; border-bottom: 1px solid #b2bec3; padding-bottom: 5px">
                    <h2 style="font-size: 17px; color: #444; margin-bottom: 12px; ">Chào '. $fullname .'. Đơn hàng của bạn đã đặt thành công !</h2>
                    <p style="padding: 0px; margin:0px">Chúng tôi đang chuẩn bị hàng để bàn giao cho đơn vị vận chuyển</p>
                    <p style="margin:0px; padding-top: 10px;  color: #0984e3; font-weight: bold">Mã đơn hàng: '. $code .'</p>
                    <p style="margin:0px; padding-top: 5px;  color: #0984e3; font-weight: bold">Ngày đặt: '. $order_date .'</p>
                </div>
                <div class="mail-body" style=" padding-top: 5px; margin: 0 15px">
                    <div class="info-address" style="display: flex;">
                        <div class="info" style="margin-right: 140px">
                            <p style="color: #444; font-weight: bold; margin-top: 9px; margin-bottom: 9px; font-size: 14px">Thông tin khách hàng</p>
                            <p style="margin: 0px; margin-bottom: 8px">'. $fullname .'</p>
                            <p style="margin: 0px; margin-bottom: 8px">'. $email .'</p>
                            <p style="margin: 0px">'. $phone .'</p>
                        </div>
                        <div class="address">
                            <p style="color: #444; font-weight: bold; margin-top: 9px; margin-bottom: 9px; font-size: 14px">Địa chỉ giao hàng</p>
                            <p style="margin: 0px">'. get_address_name($apart_num, $wards, $district, $province, $list_wards, $list_district, $list_city) .'</p>
                        </div>
                    </div>
                    <!-- end info-address -->
                    <p style="color: #444; font-weight: bold; margin-top: 25px; margin-bottom: 9px; font-size: 14px">Thông tin đơn hàng</p>
                    <table style=" width: 100%; ">
                        <thead style="background-color: #ff191a; color: #ecf0f1; margin: 0px; font-size: 14px; text-align: center;">
                            <tr style="font-size: 13px">
                                <th style="padding: 6px 0px; ">TÊN SẢN PHẨM</th>
                                <th style="padding: 6px 0px;">GIÁ</th>
                                <th style="padding: 6px 0px;">SỐ LƯỢNG</th>
                                <th style="padding: 6px 0px;">THÀNH TIỀN</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;padding-top: 5px; ">
                        ';
                        foreach($list_cart as $item) {
                        $content .= '<tr style="font-size: 14px">
                                <td  style="color: #444; font-weight: bold; width: 25%">'. $item['name'] .'</td>
                                <td style="width: 25%">'. currency_format($item['price']) .'</td>
                                <td style="width: 25%">'. $item['qty'] .'</td>
                                <td style="width: 25%">'. currency_format($item['sub_total']) .'</td>
                            </tr>
                            ';
                        };
        
                        $content .= '
                            <tr>
                                <td colspan="3" style="text-align: left; color: black; font-weight: bold; padding: 6px 0px; text-transform: uppercase; font-size: 14px; ">Giá trị đơn hàng:</td>
                                <td style="padding: 6px; 0pxl color: black; font-weight: bold; font-size: 14px">'. currency_format($total).'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="">Quý khách vui lòng giữ lại hoá đơn, hộp sản phẩm và phiếu bảo hành để đổi trả hàng hoặc bảo hành khi cần thiết. Thời gian đổi trả hàng dưới 15 ngày kể từ ngày nhận hàng</p>
                    <p style=" font-weight: bold">Liên hệ Hotline: <span style="font-weight: normal"> 036989154 nếu quý khách có bất kì thắc mắc nào hoặc <span style="color: red">nếu không phải quý khách đặt hàng</span></span></p>
                    <p style="font-weight: bold">Ismart V xin trân thành cảm ơn quý khách đã đặt hàng !</p>
                </div>
            </div>
            ';  
        
                $query1 = "INSERT INTO `tbl_customers` (`code`, `name`, `phone`, `email`, `total`, `num_order`, `order_date`, `edit_date`, `matp`, `maqh`, `xaid`, `apartment_number` ) VALUES ('$code', '$fullname', '$phone', '$email', '$total', '$num_order_cart', '$order_date', '$edit_date', '$province', '$district', '$wards', '$apart_num')";
                if (mysqli_query($conn, $query1)) {
                        // echo 'done';
                        $order_id = mysqli_insert_id($conn);
                        foreach($list_cart as $item) {
                            $product_name = $item['name'];
                            $thumb = $item['thumb'];
                            $qty = $item['qty'];
                            $price = $item['price'];
                            $sub_total = $item['sub_total'];

                            $query2 = "INSERT INTO `tbl_orders` (`order_id`, `product_name`, `thumb`, `qty`, `price`, `sub_total`) VALUES ('$order_id', '$product_name', '$thumb', '$qty', '$price', '$sub_total')";
                            mysqli_query($conn, $query2);
                            echo send_mail($email, $fullname, "[Ismart V] Thông báo đặt hàng thành công", $content);
                            redirect("dat-hang-thanh-cong-{$order_id}");
                            unset($_SESSION['cart']);             
                        }
                       
                }else {
                    echo "Fail connect";
                }
            
            }
        }
        
    }
    
    load_view('checkOut', $data);
}

function orderSuccessAction() {
    $id = (int) $_GET['id'];

    $page_data = get_page_data();
    $data['page_data'] = $page_data;
    $num_order_cart = get_num_order_cart();
    $data['num_order_cart'] = $num_order_cart;

    $order_by_id = get_order_by_id($id);
    $data['order_by_id'] = $order_by_id;
    $order_detail = get_order_detail_by_id($id);
    $data['order_detail'] = $order_detail;
    
    $list_city = get_list_city();
    $data['list_city'] = $list_city;
    $list_district = get_list_district();
    $data['list_district'] = $list_district;
    $list_wards = get_list_wards();
    $data['list_wards'] = $list_wards;

    load_view('orderSuccess', $data);
}

function updateAjaxAction() {
    $id = $_GET['id'];
    $qty = $_GET['qty'];

    //Lấy thông tin sản phẩm
    $add_cart = get_product_by_id($id);

    if(isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        // Cập nhật số lượng
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;

        //Cập nhật tổng tiền
        foreach($_SESSION['cart']['buy'] as $item) {
            $sub_total = $qty * $item['price'];
            $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;
        }   
        

        //Cập nhật toàn bộ giỏ hàng
        update_info_cart();

        // Lấy tổng giá trị giỏ hàng
        $total = get_total_cart();

        //Xuất giá trị trả về
        $data = array(
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($total)
        );

        echo json_encode($data);
    }

}



?>