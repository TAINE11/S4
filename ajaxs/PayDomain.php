<?php
include('../app/config.php');

$explode = explode(".", $_POST['domain']);
$query = $connect->query("SELECT * FROM DomainPackages WHERE name = '".$explode[1]."'")->fetch_array();
$overtime = time()+(31536000 * $_POST['hsd']);
$tienphaitra = $query['price'] * $_POST['hsd'];
$checkLimit = $connect->query("SELECT * FROM Domain WHERE domain = '".$_POST['domain']."' AND status != '2'")->num_rows;

if(empty($_POST['domain'])){
    echo json_api('Không tìm thấy tên miền!','error');
} else if(!isset($_SESSION['users'])){
    echo json_api('Vui lòng đăng nhập để tiếp tục!','error');
} else if($_POST['hsd'] < 1 || $_POST['hsd'] > 10){
    echo json_api('Hạn đăng ký không hợp lệ!','error');
} else if(empty($_POST['ns'])){
    echo json_api('Vui lòng nhập Nameserver!','error');
} else if($explode[1] != $query['name']){
    echo json_api('Tên miền .'.inHoaString($explode[1]).' chúng tôi không cung cấp!','error');
} else if($getUser['money'] < $tienphaitra){
    echo json_api('Số dư không đủ để thanh toán!','error');
} else if($checkLimit >= 1){
    echo json_api('Tên miền đã tồn tại trên máy chủ!','error');
} else {
    $inTrue = $connect->query("INSERT INTO `Domain`(`id`, `username`, `domain`, `ns`, `hsd`, `status`, `time`, `overtime`, `timedelete`) VALUES (NULL,'".$getUser['username']."','".AntiXss($_POST['domain'])."','".AntiXss($_POST['ns'])."','".AntiXss($_POST['hsd'])."','0','".time()."','$overtime','0')");

    if($inTrue){
        $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE username = '".$getUser['username']."'");
        $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE username = '".$getUser['username']."'");
        echo json_api('Đăng ký tên miền thành công, vui lòng chờ tên miền kích hoạt','success');
        unset($_SESSION['domain']);
        
        // Thông báo trên Telegram
        $message = "🔔 THÔNG BÁO\n📝 Nội dung: Đã Có 1 Thành Viên Đăng Ký Tên Miền Mới 🛒\n• Tài Khoản: ".$getUser['username']."\n• Tên Miền: ".$_POST['domain']."\n• Thời Gian: ".ToTime(time())."\n• Số Tiền Thanh Toán: ".Price($tienphaitra)."đ.";
        $url = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
        file_get_contents($url);

    } else {
        echo json_api('Không thể thanh toán!','error');
    }
}
?>
