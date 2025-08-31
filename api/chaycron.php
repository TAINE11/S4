<?php
include('../app/config.php');
$now = time();
if (!isset($_GET['code'])) {
    die("Hệ thống cronjobs");
}
if (isset($_GET['code'])) {
    $code = strip_tags($_GET['code']); // Nhận thông tin server
    // Tiến hành lấy danh sách đơn cron theo server
    foreach ($connect->query("SELECT * FROM `list_cron` WHERE `server_cron` = '$code' AND `status` = 'ON' ") as $row) {
        if ($row['ngay_het'] < time()) {
            
            $create = $connect->query("UPDATE `list_cron` SET `status` = 'hethan',`last_cron` = '".$now."' WHERE `id` = '".$row['id']."' ");
        }
        if (time() - $row['interval_seconds'] >= $row['last_cron']) { // Tính thời gian cron gần nhất để tiếp tục cron
            $url = $row['url'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $httpcode = $info["http_code"]; //Tách http code
    $timeout = $info['total_time']; // Tách thời gian chờ kết nối
    if($timeout > 30) // Kiểm tra thời gian lớn hơn 30s thì set đơn cron lỗi
    {
        $create = $connect->query("UPDATE `list_cron` SET `response` = 522,`status` = 'loi',`last_cron` = '".$now."' WHERE `id` = '".$row['id']."' ");
}
            $results[] = array(
                'username' => $row['username'],
                'interval_seconds' => $row['interval_seconds'],
                'url' => $url,
                'response' => $httpcode,
                'time_out' => $timeout
            );
            if ($httpcode == 200) { // Kiểm tra http code trả về 200 thì set đơn cron hoạt động

                $create = $connect->query("UPDATE `list_cron` SET `response` = $httpcode,`status` = 'ON',`last_cron` = '".$now."' WHERE `id` = '".$row['id']."' ");
            }
            if ($httpcode != 200) { // Kiểm tra http code trả về khác 200 thì set đơn cron lỗi
                
                $create = $connect->query("UPDATE `list_cron` SET `response` = $httpcode,`status` = 'ON',`last_cron` = '".$now."' WHERE `id` = '".$row['id']."' ");
            }
        }
    }
    echo json_api($results,'error');
}