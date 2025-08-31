<?php
include('ini.php');

$type = $_POST['type'];

if($type == 'edit-users'){
    $inTrue = $connect->query("UPDATE `Users` SET `username`='".$_POST['username']."',`email`='".$_POST['email']."',`level`='".$_POST['level']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Lưu thành công','success');
        echo redirect('');
    } else {
        echo swal('Lưu thất bại!','error');
    }
} else if($type == 'edit-money'){
    if($_POST['type_ac'] == 'cong'){
        $inTrue = $connect->query("UPDATE `Users` SET `money`=`money` + '".$_POST['money']."' WHERE `id` = '".$_POST['id']."'");
        if($inTrue){
            echo swal('Cộng số dư thành công ('.Price($_POST['money']).')!','success');
            echo redirect('');
        } else {
            echo swal('Cộng số dư thất bại!','error');
        }
    } else {
    $inTrue = $connect->query("UPDATE `Users` SET `money`=`money` - '".$_POST['money']."' WHERE `id` = '".$_POST['id']."'");
        if($inTrue){
            echo swal('Trừ số dư thành công ('.Price($_POST['money']).')!','success');
            echo redirect('');
        } else {
            echo swal('Trừ số dư thất bại!','error');
        }
    }
}
?>