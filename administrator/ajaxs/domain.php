<?php
include('ini.php');
$type = $_POST['type'];

if($type == 'them'){
    $inTrue = $connect->query("INSERT INTO `DomainPackages`(`id`, `name`, `price`, `image`, `value`) VALUES (NULL,'".$_POST['name']."','".$_POST['price']."','".$_POST['image']."','".$_POST['value']."')");
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Không Thể Lưu Dữ Liệu','error');
    }
} else if($type == 'edit'){
    $inTrue = $connect->query("UPDATE `DomainPackages` SET `name`='".$_POST['name']."',`price`='".$_POST['price']."',`image`='".$_POST['image']."',`value`='".$_POST['value']."' WHERE id = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Không Thể Lưu Dữ Liệu','error');
    }
} else if($type == 'loadDomain'){
    $query = $connect->query("SELECT * FROM Domain WHERE id = '".$_POST['id']."'")->fetch_array();
    if($_POST['id'] != $query['id']){
        echo json_api('Đơn Hàng Không Hợp Lệ','error');
    } else {
        $explode = explode(".", $query['domain']);
        echo json_encode(['domain' => $query['domain'], 'hsd' => $query['hsd'], 'username' => $query['username'], 'dns' => $query['ns'], 'time' => ToTime($query['time']).'/ '.ToTime($query['overtime']), 'status_btn' => StatusDomain($query['status']), 'name' => $explode[1]]);
    }
} else if($type == 'update_domain'){
    
    if($_POST['update_status'] == 4){
        $query = $connect->query("SELECT * FROM DomainPackages WHERE name = '".$_POST['name']."'")->fetch_array();
        $hoanTien = $connect->query("UPDATE Users SET money = money + '".$query['price']."' WHERE username = '".$_POST['username2']."'");
    }
    
    $inTrue = $connect->query("UPDATE Domain SET status = '".$_POST['update_status']."' WHERE id = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
}
?>