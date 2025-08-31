<?php
include('../app/config.php');

session_start();
if (!isset($_SESSION['users'])) {
    echo json_encode(['message' => 'Vui lòng đăng nhập để tiếp tục!', 'status' => 'error']);
    exit;
}

$id = $_POST['id'];
$getUser = $_SESSION['users'];

$query = $connect->query("SELECT * FROM MaNguon WHERE id = '$id'")->fetch_array();
$tienphaitra = $query['price'];

if($id != $query['id']){
    echo json_encode(['message' => 'ID không tồn tại!', 'status' => 'error']);
} else if($getUser['money'] < $tienphaitra) {
    echo json_encode(['message' => 'Số dư không đủ để thanh toán!', 'status' => 'error']);
} else {
    $inTrue = $connect->query("INSERT INTO `DanhSachCode`(`id`, `username`, `name`, `theme`, `time`, `price`) VALUES (NULL, '".$getUser['username']."', '".$query['name']."', '".$query['id']."', '".time()."', '$tienphaitra')");
    if($inTrue){
        // Cập nhật số tiền của người dùng và mã nguồn
        $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
        $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
        $connect->query("UPDATE `MaNguon` SET `sold`=`sold` + '1' WHERE `id` = '".$query['id']."'");
        
        // Gửi thông báo qua Telegram
        $message = "🔔 THÔNG BÁO\n📝 Nội dung: Đã Có 1 Thành Viên Mua Mã Nguồn 🛒\n• Tài Khoản: ".$getUser['username']."\n• Mã Nguồn #".$id." - ".$query['name']."\n• Thành Công Với Giá ".Price($tienphaitra)."đ.\n🕒 Thời gian: ".ToTime(time())."";
        $url = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
        
        file_get_contents($url); // Không kiểm tra kết quả của file_get_contents

        echo json_encode(['message' => 'Mua mã nguồn thành công', 'status' => 'success']);
    } else {
        echo json_encode(['message' => 'Không thể thanh toán!', 'status' => 'error']);
    }
}
?>
