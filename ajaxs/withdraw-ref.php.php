<?php
include('../app/config.php');

// Kiểm tra nếu yêu cầu đến từ phương thức POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ yêu cầu
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

    // Kiểm tra nếu thông tin đầy đủ
    if ($userId > 0 && $amount > 0) {
        // Kiểm tra số dư hiện tại của người dùng
        $stmt = $conn->prepare("SELECT balance FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($balance);
        $stmt->fetch();
        $stmt->close();

        if ($balance >= $amount) {
            // Tiến hành rút tiền
            $newBalance = $balance - $amount;
            $stmt = $conn->prepare("UPDATE users SET balance = ? WHERE id = ?");
            $stmt->bind_param("di", $newBalance, $userId);
            if ($stmt->execute()) {
                // Lưu thông tin vào bảng lịch sử rút tiền
                $transactionId = uniqid(); // Tạo mã giao dịch ngẫu nhiên
                $stmt = $conn->prepare("INSERT INTO withdrawal_history (transaction_id, user_id, amount, status, date) VALUES (?, ?, ?, 'Success', NOW())");
                $stmt->bind_param("siid", $transactionId, $userId, $amount);
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Rút tiền thành công']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Không thể lưu lịch sử giao dịch']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật số dư']);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Số dư không đủ']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Thông tin không hợp lệ']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ']);
}

$conn->close();
?>
