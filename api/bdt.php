<?php
include('../app/config.php');

$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

function sendMessage($chatId, $message) {
    global $botToken;
    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($url);
}
function sbWeb($status) {
    switch ($status) {
        case '0':
            return 'Đang xử lý (0)';
        case '1':
            return 'Hoạt động (1)';
        case '2':
            return 'Chờ gia hạn (2)';
        case '3':
            return 'Hết hạn (3)';
        case '4':
            return 'Bị hủy (4)';
        case '5':
            return 'Đang xét duyệt (5)';
        default:
            return 'Không xác định';
    }
}

if (strpos($message, "/band ") === 0) {
    $id = intval(substr($message, 6));
    $query = $connect->query("DELETE FROM Users WHERE id = $id");
    if ($connect->affected_rows > 0) {
        $response = "Đã xoá người dùng #$id thành công";
    } else {
        $response = "Không tìm thấy người dùng với ID $id để xóa";
    }
    sendMessage($chatId, $response);
}
if ($message === "/start") {
    $response = "Nhập lệnh /help để xem các lệnh khác.";
    sendMessage($chatId, $response);
}
if ($message === "/help") {
    $response = "- Các lệnh hỗ trợ -\n\n";
    $response .= "/+money <id_user> <amount> - Cộng tiền thành viên\n";
    $response .= "/-money <id_user> <amount> - Trừ tiền thành viên\n";
    $response .= "/band <id_user> - Xoá thành viên\n";
    $response .= "/listWeb - Danh sách đơn tạo Website\n";
    $response .= "/setWeb <status> - Duyệt đơn (status từ 0 -> 5)\n\n";
    $response .= "Code Mod By : @BuiDucThanh\n";
    sendMessage($chatId, $response);
}
if (strpos($message, "/+money ") === 0) {
    $params = explode(' ', substr($message, 8), 2);
    if (count($params) == 2) {
        $id = intval($params[0]);
        $amount = intval($params[1]);
        if (is_numeric($amount) && (int)$amount == $amount) {
            $query = $connect->query("UPDATE Users SET money = money + $amount WHERE id = $id");
            if ($connect->affected_rows > 0) {
                $response = "Đã cộng ".Price($amount)."đ vào tài khoản của người dùng $id";
            } else {
                $response = "Không tìm thấy người dùng với ID $id";
            }
        } else {
            $response = "Mệnh giá phải là số nguyên!";
        }
    } else {
        $response = "Lệnh không hợp lệ. Đúng định dạng là: /+money <id_user> <amount>";
    }
    sendMessage($chatId, $response);
}
if (strpos($message, "/-money ") === 0) {
    $params = explode(' ', substr($message, 8), 2);
    if (count($params) == 2) {
        $id = intval($params[0]);
        $amount = intval($params[1]);
        if (is_numeric($amount) && (int)$amount == $amount) {
            $query = $connect->query("UPDATE Users SET money = money - $amount WHERE id = $id AND money >= $amount");
            if ($connect->affected_rows > 0) {
                $response = "Đã trừ ".Price($amount)."đ trong tài khoản của người dùng $id";
            } else {
                $response = "Không tìm thấy người dùng với ID $id hoặc số dư không đủ";
            }
        } else {
            $response = "Mệnh giá phải là số nguyên!";
        }
    } else {
        $response = "Lệnh không hợp lệ. Đúng định dạng là: /-money <id_user> <amount>";
    }
    sendMessage($chatId, $response);
}
if ($message == '/listWeb') {
    $response = '';
    $sql = "SELECT * FROM DanhSachWeb";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response .= "ID: ".$row['id']." (Mẫu ".$row['theme'].")\n";
            $response .= "Tên miền: ".$row['domain']."\n";
            $response .= "Chủ sở hữu: ".$row['username']."\n";
            $response .= "Trạng thái: ".sbWeb($row['status'])."\n";
            $response .= "______________\n";
        }
    } else {
        $response = "Không có dữ liệu.";
    }
    sendMessage($chatId, $response);
}
if (strpos($message, "/setWeb ") === 0) {
    $params = explode(' ', substr($message, 8), 2);
    if (count($params) == 2) {
        $id = intval($params[0]);
        $status = intval($params[1]);
        if (is_numeric($status) && (int)$status == $status) {
            $query = $connect->query("UPDATE DanhSachWeb SET status = $status WHERE id = $id");
            if ($connect->affected_rows > 0) {
                $response = "Đã cập nhật Website có ID: ".$id." với trạng thái: ".sbWeb($status)."";
            } else {
                $response = "Không tìm thấy Website với ID $id";
            }
        } else {
            $response = "Trạng thái phải là số nguyên từ 0 -> 5";
        }
    } else {
        $response = "Lệnh không hợp lệ. Đúng định dạng là: /setWeb <id> <status>";
    }
    sendMessage($chatId, $response);
}