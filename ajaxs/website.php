<?php
include('../app/config.php');

$id = $_POST['id'];
$domain = $_POST['domain'];
$dot = $_POST['dot'];
$ddomain = $domain.'.'.$dot;
$useradmin = inThuongString('admincsv'.RandStrings(4));
$password = RandStrings(8);
$id = $_POST['id'];
$hsd = $_POST['hsd'];
$coupon = $_POST['coupon'];
$query = $connect->query("SELECT * FROM GiaoDien WHERE id = '$id'")->fetch_array();    
$dots = $connect->query("SELECT * FROM Dots WHERE dot = '$dot'")->fetch_array();
$checkLimit = $connect->query("SELECT * FROM `DanhSachWeb` WHERE `domain` = '$ddomain' AND (status = '0' OR status = '1')")->num_rows;
$orvertime = time()+(2592000 * $hsd);
$expo = $query['price'] * $hsd;
$tienphaitra = $expo + $dots['price'];

if($id != $query['id']){
     echo json_api('Giao diện không tồn tại!','error');
} else if(!isset($_SESSION['users'])){
     echo json_api('Vui lòng đăng nhập để tiếp tục!','error');
} else if(empty($domain)){
     echo json_api('Vui lòng nhập tên miền!','error');
} else if(empty($dot)){
    echo json_api('Đuôi miền không hợp lệ!','error');
} else if($hsd < 1){
   echo json_api('Hạn sử dụng không hợp lệ!','error');
} else if($checkLimit >= 1){
   echo json_api('Tên miền đã được sử dụng!','error');
} else if(!empty($coupon)){
     $checkcode = $connect->query("SELECT * FROM `MaGiamGia` WHERE `code` = '$coupon'")->fetch_array();
    if($checkcode['code'] != $coupon){
  echo json_api('Mã giảm giá không tồn tại!','error');   
         $code = false;
    } else if($checkcode['service'] != 'Website'){
      echo json_api('Mã giảm giá không dùng cho dịch vụ này!','error');
    } else if($checkcode['sold'] >= $checkcode['max']){
      echo json_api('Mã giảm giá đã hết hạn!','error');   
            $code = false;
    } else {
            if($checkcode['type'] == 'money'){
                $tienphaitra = $tienphaitra - $checkcode['amount'];
            } else if($checkcode['type'] == 'perce'){
                $tienphaitra = checkGia($tienphaitra, $checkcode['amount']);
            }
            if($getUser['money'] < $tienphaitra){
                echo json_api('Số dư không đủ để thanh toán!','error');
            } else {
                 $inTrue = $connect->query("INSERT INTO `DanhSachWeb`(`id`, `username`, `domain`, `useradmin`, `password`, `status`, `theme`, `time`, `orvertime`, `price`, `exprice`, `timesuspended`) VALUES (NULL,'".$getUser['username']."','".AntiXss($domain.'.'.$dot)."','".$useradmin."','".$password."','0','$id','".time()."','$orvertime','$tienphaitra','".AntiXss($query['exprice'])."',NULL)");
                if($inTrue){
                    $connect->query("UPDATE `MaGiamGia` SET `sold`=`sold` + '1' WHERE `code` = '$coupon'");
                    $connect->query("UPDATE `GiaoDien` SET `sold`=`sold` + '1' WHERE `id` = '$id'");
                    $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    echo json_api('Thanh toán thành công, vui lòng chờ duyệt!','success');
                    $message = "🔔 THÔNG BÁO\n📝 Nội dung: Đã Có 1 Thành Viên Thuê Website 🛒\n• Tài Khoản: ".$getUser['username']."\n• Đã Thuê Mẫu #".$id."\n• Tên Miền: ".$ddomain."\n• Thành Công Với Giá ".Price($tienphaitra)."đ.\n🕒 Thời gian: ".ToTime(time())."";
                    $url = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
                      file_get_contents($url);
                } else {
                    echo json_api('Không thể thanh toán!','error');
                }
            }
        }
        
} else {
         if($getUser['money'] < $tienphaitra){
                echo json_api('Số dư không đủ để thanh toán!','error');
            } else {
                 $inTrue = $connect->query("INSERT INTO `DanhSachWeb`(`id`, `username`, `domain`, `useradmin`, `password`, `status`, `theme`, `time`, `orvertime`, `price`, `exprice`, `timesuspended`) VALUES (NULL,'".$getUser['username']."','".AntiXss($domain.'.'.$dot)."','".$useradmin."','".$password."','0','$id','".time()."','$orvertime','$tienphaitra','".AntiXss($query['exprice'])."',NULL)");
                if($inTrue){
                    $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
                    $connect->query("UPDATE `GiaoDien` SET `sold`=`sold` + '1' WHERE `id` = '$id'");
                    echo json_api('Thanh toán thành công, vui lòng chờ duyệt!','success');
                    $message = "🔔 THÔNG BÁO\n📝 Nội dung: Đã Có 1 Thành Viên Thuê Website 🛒\n• Tài Khoản: ".$getUser['username']."\n• Đã Thuê Mẫu #".$id."\n• Tên Miền: ".$ddomain."\n• Thành Công Với Giá ".Price($tienphaitra)."đ.\n🕒 Thời gian: ".ToTime(time())."";
                    $url = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
                      file_get_contents($url);
                } else {
                    echo json_api('Không thể thanh toán!','error');
                }
            }
    }
?>