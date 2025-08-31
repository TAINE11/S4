<?php
include('ini.php');

$type = $_POST['type'];

if($type == 'them'){
    $inTrue = $connect->query("INSERT INTO `Server`(`id`, `name`, `uname`, `hostname`, `whmusername`, `whmpassword`, `ip`, `nameserver1`, `nameserver2`, `value`, `ghichu`, `ssl_key`, `backup`) VALUES (NULL,'".$_POST['name']."','".inThuongString($_POST['uname'])."','".$_POST['hostname']."','".$_POST['whmusername']."','".$_POST['whmpassword']."','".$_POST['ip']."','".$_POST['nameserver1']."','".$_POST['nameserver2']."','on','".$_POST['ghichu']."', '".$_POST['ssl_key']."', '".$_POST['backup']."')");
    
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
} else if($type == 'edit'){
    $id = $_POST['id'];
    $inTrue = $connect->query("UPDATE `Server` SET `name`='".$_POST['name']."',`uname`='".inThuongString($_POST['uname'])."',`hostname`='".$_POST['hostname']."',`whmusername`='".$_POST['whmusername']."',`whmpassword`='".$_POST['whmpassword']."',`ip`='".$_POST['ip']."',`nameserver1`='".$_POST['nameserver1']."',`nameserver2`='".$_POST['nameserver2']."',`value`='".$_POST['value']."',`ghichu`='".$_POST['ghichu']."', `ssl_key`='".$_POST['ssl_key']."', `backup`='".$_POST['backup']."' WHERE id = '$id'");
    
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
} else if($type == 'themgoi'){
    $inTrue = $connect->query("INSERT INTO `HostPackage`(`id`, `disk`, `bandwidth`, `addondomain`, `subdomain`, `server`, `package`, `price`) VALUES (NULL,'".$_POST['disk']."','".$_POST['bangthong']."','".$_POST['addondomain']."','".$_POST['subdomain']."','".$_POST['server']."','".$_POST['packages']."','".$_POST['price']."')");
    
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
} else if($type == 'editgoi'){
    $inTrue = $connect->query("UPDATE `HostPackage` SET `disk`='".$_POST['disk']."',`bandwidth`='".$_POST['bangthong']."',`addondomain`='".$_POST['addondomain']."',`subdomain`='".$_POST['subdomain']."',`server`='".$_POST['server']."',`package`='".$_POST['packages']."',`price`='".$_POST['price']."' WHERE id = '".$_POST['id']."'");
    
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Thao Tác Thất Bại','error');
    }
}
?>