<?php
include('../app/config.php');

$pin = ($_POST['pin']);
$serial = ($_POST['serial']);
$amount = ($_POST['amount']);
$type = ($_POST['type']);
$requestid = rand(1000000000,9000000000);

if(!isset($_SESSION['users'])){
    echo json_api('Vui Lòng Đăng Nhập Thể Giao Dịch!', 'error');
    echo redirect('/login');
} else if(empty($pin)){
    echo json_api('Vui Lòng Nhập Mã Thẻ!', 'error');
} else if(empty($serial)){
    echo json_api('Vui Lòng Nhập Serial Thẻ!', 'error');
} else if(empty($amount)){
    echo json_api('Vui Lòng Nhập Mệnh Giá!', 'error');
} else if(empty($type)){
    echo json_api('Vui Lòng Nhập Loại Thẻ!', 'error');
} else {
             
        $command = 'charging';  
        $url = 'https://doithe1s.vn/chargingws/v2';
        $partner_id = $system['partner_id'];
        $partner_key = $system['partner_key'];

        $dataPost = array();
        $dataPost['request_id'] = $requestid; 
        $dataPost['code'] = $pin;
        $dataPost['partner_id'] = $partner_id;
        $dataPost['serial'] = $serial;
        $dataPost['telco'] = $type;
        $dataPost['command'] = $command;
        ksort($dataPost);
        $sign = $partner_key;
        foreach ($dataPost as $item) {
            $sign .= $item;
        }
        
        $mysign = md5($sign);

        $dataPost['amount'] = $amount;
        $dataPost['sign'] = $mysign;

        $data = http_build_query($dataPost);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);
    
    
        if ($obj->status == 99) {
            $inTrue = $connect->query("INSERT INTO `DataCard`(`id`, `username`, `pin`, `serial`, `amount`, `type`, `status`, `time`, `requestid`, `date`) VALUES (NULL,'".$getUser['username']."','$pin','$serial','$amount','$type','0','".time()."','$requestid', '".date('d/m/Y')."')");
              if($inTrue){
                   echo json_api('Nạp Thẻ Thành Công, Vui Lòng Chờ Duyệt!', 'success');
              } else {
                   echo json_api('Không Thể Nạp Thẻ!', 'error');
              }
        } elseif ($obj->status == 2) {
            echo json_api('Sai Mệnh Giá, Mất Thẻ', 'error');
        } elseif ($obj->status == 3) {
            echo json_api('Thẻ Lỗi, Không Thể Gửi Đi', 'error');
        } elseif ($obj->status == 4) {
            echo json_api('Chức Năng Nạp Thẻ Đang Bảo Trì', 'error');
        } else {
           echo json_api('Không Thể Gửi Thẻ, Hãy Kiểm Tra Lại API KEY', 'error');
        }
}

?>