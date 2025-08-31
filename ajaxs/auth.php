<?php
include('../app/config.php');
// Include PHPMailer classes

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../PHPMailer/src/Exception.php');
require('../PHPMailer/src/PHPMailer.php');
require('../PHPMailer/src/SMTP.php');

$type = $_POST['type'];

if ($_POST['type'] == 'login') {
    $username = AntiXss($_POST['username']);
    $password = AntiXss(md5($_POST['password']));
    $rememberMe = isset($_POST['remember']) ? true : false;

    // Truy vấn thông tin người dùng từ cơ sở dữ liệu
    $query = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
    $result = $connect->query($query);

    if ($rememberMe) {
     // Tạo cookie để lưu trạng thái đăng nhập
    setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 ngày
    setcookie('password', $password, time() + (86400 * 30), "/");
    }

    // Kiểm tra số lượng kết quả
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Kiểm tra trạng thái band
        if ($user['band'] == 'no') {
            echo json_api('Đăng nhập thành công!', 'success');
            $_SESSION['users'] = $username;
        } else {
            echo json_api('Tài khoản của bạn đã bị khóa!', 'error');
        }
    } else {
        echo json_api('Sai thông tin đăng nhập hoặc tài khoản không tồn tại!', 'error');
    }

} else if ($type == 'register') {
    $name = AntiXss($_POST['name']);
    $username = AntiXss($_POST['username']);
    $password = AntiXss($_POST['password']);
    $email = AntiXss($_POST['email']);
    $id_aff = AntiXss($_POST['id_aff']);
    
    // Nhận IP từ người dùng (nếu có), nếu không thì lấy IP thực từ request
    $ip = !empty($_POST['ip']) ? AntiXss($_POST['ip']) : $_SERVER['REMOTE_ADDR'];

    // Danh sách các tên người dùng không cho phép
    $restrictedUsernames = ['admin', 'quantrivien', 'admin123', 'ditme', 'ditmemay', 'demo', 'test', 'adminvip', 'adminvcl', '123456'];
    
    // Kiểm tra username or username đã đăng ký chưa
    $limitCheck = $connect->query("SELECT * FROM Users WHERE username = '$username' OR username = '$email'")->num_rows;

    // Kiểm tra IP đã đăng ký bao nhiêu lần
    $limitCheckIp = $connect->query("SELECT * FROM Users WHERE ip = '$ip'")->num_rows;

    if (empty($username)) {
        echo json_api('Vui lòng nhập tên đăng nhập!', 'error');
    } else if (in_array(strtolower($username), array_map('strtolower', $restrictedUsernames))) {
        echo json_api('Tên đăng nhập này không được phép sử dụng!', 'error');
    } else if (empty($password)) {
        echo json_api('Vui lòng nhập mật khẩu!', 'error');
    } else if (empty($email)) {
        echo json_api('Vui lòng nhập email!', 'error');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_api('Email không hợp lệ, vui lòng đổi email khác!', 'error');
    } else if ($limitCheck >= 1) {
        echo json_api('Thông tin đăng ký đã được sử dụng!', 'error');
    } else if ($limitCheckIp >= 5) {  // Giới hạn IP được đăng ký nhiều nhất 5 lần
        echo json_api('Địa chỉ IP đã đăng ký quá nhiều lần!', 'error');
    } else {
        // Câu lệnh SQL bao gồm trường Name
        $inTrue = $connect->query("INSERT INTO `Users`(`Name`, `username`, `password`, `email`, `money`, `money_aff`, `id_aff`, `ip`, `time`, `level`, `date_online`) VALUES ('$name', '$username', '".md5($password)."', '$email', '0', '0', '$id_aff', '$ip', '".time()."', 'member', NULL)");

        if ($inTrue) {
            echo json_api('Đăng ký tài khoản thành công!', 'success');
            $_SESSION['users'] = $username;
            $message = "🔔 THÔNG BÁO\n📝 Nội dung: Có 1 Thành Viên Đã Đăng Ký Tài Khoản Thành Công 👤\n• Họ và Tên: $name\n• Tên tài khoản: $username\n• Email: $email\n• ID Người giới thiệu: $id_aff\n• IP Người đăng ký: $ip\n🕒 Thời gian: ".ToTime(time())."";
            $url = "https://api.telegram.org/bot".$botToken."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
            file_get_contents($url);
        } else {
            echo json_api('Không thể lưu dữ liệu', 'error');
        }
    }

} else if ($type == 'forgotpassword') {
    $query = $connect->query("SELECT * FROM Users WHERE email = '".AntiXss($_POST['email'])."'");
    $checkUser = $query->num_rows;
    $fetch = $query->fetch_array();

    if ($_SESSION['counts'] >= 2) {
        echo json_api('Bạn Đã Yêu Cầu Mật Khẩu Mới Quá Số Lần Trong 1 Lúc', 'error');
    } else {
        if ($checkUser < 1) {
            echo json_api('Không Tìm Thấy Tài Khoản Liên Kết Với Email Này', 'error');
        } else {
            $newPassword = RandStrings(12);
            $connect->query("UPDATE Users SET password = '".md5($newPassword)."' WHERE username = '".$fetch['username']."'");

            $siteDomain = $_SERVER['HTTP_HOST'];
            $content = 'Xin Chào '.$fetch['name'].', Bạn Vừa Yêu Cầu Đặt Lại Mật Khẩu <br> 
            - Mật Khẩu Mới Của Bạn Là: '.$newPassword.'<br>
            - IP Yêu Cầu: '.$_SERVER['REMOTE_ADDR'].'<br>
            <strong style="color: red"> Cảnh Báo: Nếu Bạn Không Thực Hiện Thao Tác Này Hãy Kiểm Tra Lại Các Thông Tin Đăng Nhập Của Tài Khoản Ngay Bây Giờ </strong> <br>
            <strong style="color: blue"> '.inHoaString($siteDomain).' Hân Hạn Được Phục Vụ Quý Khách </strong>';
            
            $receiverName = 'Khoi Phuc Mat Khau - '.inHoaString($siteDomain);
            $receiverEmail = $fetch['email'];
            $subject = 'Khôi Phục Mật Khẩu - '.inHoaString($siteDomain);
            $bccEmail = 'smtpdichvuinfo@gmail.com'; // Thay bằng địa chỉ email hợp lệ
            $senderName = inHoaString($siteDomain);
            $smtpUsername = 'smtpdichvuinfo@gmail.com'; // Thay bằng thông tin SMTP của bạn
            $smtpPassword = 'fvvs hevn atay leln'; // Thay bằng mật khẩu SMTP của bạn
    
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Thay bằng host SMTP của bạn
                $mail->SMTPAuth   = true;
                $mail->Username   = $smtpUsername;
                $mail->Password   = $smtpPassword;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587; // Hoặc 465 cho SSL
    
                //Recipients
                $mail->setFrom('no-reply@example.com', $senderName);
                $mail->addAddress($receiverEmail, $receiverName);
                $mail->addBCC($bccEmail); // BCC là địa chỉ email hợp lệ
    
                //Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $content;
    
                $mail->send();
                echo json_api('Chúng Tôi Đã Gửi Email Đặt Lại Mật Khẩu Cho Bạn!', 'success');
                $_SESSION['counts'] += 1;
            } catch (Exception $e) {
                echo json_api('Không thể gửi email. Lỗi: '.$mail->ErrorInfo, 'error');
            }
        }
    }
} else if ($type == 'change-password') {
    $username = AntiXss($_SESSION['users']);
    $oldpass = AntiXss(md5($_POST['oldpass']));
    $newpass = AntiXss(md5($_POST['newpass']));
    $renewpass = AntiXss(md5($_POST['renewpass']));

    if (empty($_POST['oldpass'])) {
        echo json_api('Vui lòng nhập mật khẩu hiện tại!', 'error');
    } else if (empty($_POST['newpass'])) {
        echo json_api('Vui lòng nhập mật khẩu mới!', 'error');
    } else if (empty($_POST['renewpass'])) {
        echo json_api('Vui lòng nhập xác nhận mật khẩu mới!', 'error');
    } else if ($newpass !== $renewpass) {
        echo json_api('Mật khẩu mới và xác nhận mật khẩu không khớp!', 'error');
    } else {
        $query = $connect->query("SELECT * FROM Users WHERE username = '$username' AND password = '$oldpass'");
        if ($query->num_rows == 1) {
            $update_query = "UPDATE Users SET password = '$newpass' WHERE username = '$username'";
            if ($connect->query($update_query) === TRUE) {
                echo json_api('Mật khẩu đã được thay đổi thành công!', 'success');
            } else {
                echo json_api('Có lỗi xảy ra khi thay đổi mật khẩu. Vui lòng thử lại!', 'error');
            }
        } else {
            echo json_api('Mật khẩu hiện tại không chính xác!', 'error');
        }
    }
}
?>
