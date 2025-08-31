<?php
include('ini.php');
$type = $_POST['type'];

if($type == 'them'){
    $inTrue = $connect->query("INSERT INTO `Dots`(`id`, `dot`, `price`) VALUES (NULL,'".$_POST['name']."','".$_POST['price']."')");
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Không Thể Lưu Dữ Liệu','error');
    }
} else if($type == 'edit'){
    $inTrue = $connect->query("UPDATE `Dots` SET `dot`='".$_POST['name']."',`price`='".$_POST['price']."' WHERE id = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Thao Tác Thành Công','success');
        echo redirect('');
    } else {
        echo swal('Không Thể Lưu Dữ Liệu','error');
    }
}
?>