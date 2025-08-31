<?php
include('../app/config.php');

$id = $_POST['id'];
$name = $_POST['name'];
$id = $_POST['id'];
$coupon = $_POST['coupon'];
$query = $connect->query("SELECT * FROM Logo WHERE id = '$id'")->fetch_array();    
$tienphaitra = $query['price'];

if($id != $query['id']){
     echo json_api('Giao diện không tồn tại!','error');
} else if(!isset($_SESSION['users'])){
     echo json_api('Vui lòng đăng nhập để tiếp tục!','error');
} else if(empty($name)){
     echo json_api('Vui lòng nhập tên logo!','error');
} else if(!empty($coupon)){
     $checkcode = $connect->query("SELECT * FROM `MaGiamGia` WHERE `code` = '$coupon'")->fetch_array();
     if($checkcode['code'] != $coupon){
  	echo json_api('Mã giảm giá không tồn tại!','error');   
         $code = false;
    } else if($checkcode['service'] != 'Logo'){
        echo json_api('Mã giảm giá không dùng cho dịch vụ này!','error');
    } else if($checkcode['sold'] >= $checkcode['max']){
        echo json_api('Mã giảm giá đã hết hạn!','error');   
            $code = false;    } else {
            if($checkcode['type'] == 'money'){
                $tienphaitra = $tienphaitra - $checkcode['amount'];
            } else if($checkcode['type'] == 'perce'){
                $tienphaitra = checkGia($tienphaitra, $checkcode['amount']);
            }
            if($getUser['money'] < $tienphaitra){
                echo json_api('Số dư không đủ để thanh toán!','error');
            } else {
                 $inTrue = $connect->query("INSERT INTO `DanhSachLogo`(`id`, `username`, `name`, `status`, `theme`, `time`, `price`, `link`) VALUES (NULL,'".$getUser['username']."','".AntiXss($name)."','0','$id','".time()."','$tienphaitra','#')");
                if($inTrue){
                    $connect->query("UPDATE `MaGiamGia` SET `sold`=`sold` + '1' WHERE `code` = '$coupon'");
                    $connect->query("UPDATE `Logo` SET `sold`=`sold` + '1' WHERE `id` = '$id'");
                    $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    echo json_api('Tạo Logo thành công!, vui lòng chờ duyệt!','success');
                } else {
                    echo json_api('Không thể thanh toán!','error');
                }
            }
        }
        
} else {
         if($getUser['money'] < $tienphaitra){
                echo json_api('Số dư không đủ để thanh toán!','error');
            } else {
                 $inTrue = $connect->query("INSERT INTO `DanhSachLogo`(`id`, `username`, `name`, `status`, `theme`, `time`, `price`, `link`) VALUES (NULL,'".$getUser['username']."','".AntiXss($name)."','0','$id','".time()."','$tienphaitra','#')");
                if($inTrue){
                    $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    $connect->query("UPDATE `Logo` SET `sold`=`sold` + '1' WHERE `id` = '$id'");
                    echo json_api('Tạo Logo thành công, vui lòng chờ duyệt!','success');
                } else {
                    echo json_api('Không thể thanh toán!','error');
                }
            }
    }
?>