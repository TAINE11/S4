<?php
include('../app/config.php');
    $id = $_POST['id'];
    $hsd = $_POST['hsd'];
    $query = $connect->query("SELECT * FROM DanhSachWeb WHERE id = '$id'")->fetch_array();
    $product = $connect->query("SELECT * FROM GiaoDien WHERE id = '".$query['theme']."'")->fetch_array();
    $tienphaitra = $product['price'] * $hsd;
    $timenew = $query['orvertime'] + 2592000 * $hsd;
    
    if($id != $query['id']){
        echo json_api('Đơn hàng không hợp lệ!','error');
    } else if($hsd < 1) {
        echo json_api('Hạn sử dụng không hợp lệ!','error');
    } else if($getUser['money'] < $tienphaitra) {
        echo json_api('Số dư không đủ để gia hạn!','error');
    } else {
        $inTrue = $connect->query("UPDATE DanhSachWeb SET orvertime = '$timenew' WHERE id = '$id'");
        if($inTrue){
            $connect->query("UPDATE `Users` SET `money`=`money` - '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
            $connect->query("UPDATE `Users` SET `remoney`=`remoney` + '$tienphaitra' WHERE `username` = '".$getUser['username']."'");
            echo json_api('Gia hạn thành công '.$hsd.' tháng','success');
        } else {
            echo json_api('Không thể gia hạn!','error');
        }
    }
?>