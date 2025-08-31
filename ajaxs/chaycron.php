<?php
include('../app/config.php');

$response = array('status' => 'error', 'message' => 'Có lỗi xảy ra.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = isset($_POST['server']) ? intval($_POST['server']) : 0;
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';
    $sogiay = isset($_POST['sogiay']) ? intval($_POST['sogiay']) : 0;

    if ($server > 0 && !empty($url) && $sogiay > 0) {
        session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            // Lấy dữ liệu máy chủ
            $stmt = $connect->prepare("SELECT * FROM `server_cron_auto` WHERE `id` = ?");
            $stmt->execute([$server]);
            $server_data = $stmt->fetch();

            if ($server_data) {
                // Thêm cron job vào cơ sở dữ liệu
                $stmt = $connect->prepare("INSERT INTO `list_cron` (`username`, `server_cron`, `url`, `interval_seconds`, `status`, `ngay_mua`, `ngay_het`) VALUES (?, ?, ?, ?, 'active', NOW(), DATE_ADD(NOW(), INTERVAL ? SECOND))");
                if ($stmt->execute([$username, $server, $url, $sogiay, $sogiay])) {
                    $response = array('status' => 'success', 'message' => 'Cron job đã được thuê thành công.');

                    // Thông báo qua Telegram
                    $message = "🔔 THÔNG BÁO\n📝 Nội dung: Có 1 Cron Job Đã Được Thuê Thành Công 👤\n• Tài khoản: $username\n• Link Cron: $url\n• Số giây: $sogiay\n• Máy chủ: " . $server_data['name'] . "\n🕒 Thời gian: " . date('d/m/Y - H:i:s');
                    $telegramUrl = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
                    file_get_contents($telegramUrl);
                } else {
                    $response = array('status' => 'error', 'message' => 'Lỗi khi thêm cron job vào cơ sở dữ liệu.');
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Máy chủ không tồn tại.');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Người dùng chưa đăng nhập.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Dữ liệu đầu vào không hợp lệ.');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Yêu cầu không hợp lệ.');
}

// Ghi thông tin lỗi vào log
error_log("Debug info: " . print_r($_POST, true), 3, "error_log.txt");

header('Content-Type: application/json');
echo json_encode($response);
?>
