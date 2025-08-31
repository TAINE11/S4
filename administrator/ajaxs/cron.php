<?php
include('ini.php');

$type = $_POST['type'];

if($type == 'add-server'){
    $inTrue = $connect->query("INSERT INTO `server_cron_auto`(`id`, `name`, `count`, `rate`, `limit`) VALUES (NULL,'".$_POST['name']."','0','".$_POST['rate']."','".$_POST['limit']."')");
    
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
} else if($type == 'edit-server'){
    $id = $_POST['id'];
    $inTrue = $connect->query("UPDATE `Server` SET `name`='".$_POST['name']."',`uname`='".inThuongString($_POST['uname'])."',`hostname`='".$_POST['hostname']."',`whmusername`='".$_POST['whmusername']."',`whmpassword`='".$_POST['whmpassword']."',`ip`='".$_POST['ip']."',`nameserver1`='".$_POST['nameserver1']."',`nameserver2`='".$_POST['nameserver2']."',`value`='".$_POST['value']."',`ghichu`='".$_POST['ghichu']."', `ssl_key`='".$_POST['ssl_key']."', `backup`='".$_POST['backup']."' WHERE id = '$id'");
    
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
}
?>