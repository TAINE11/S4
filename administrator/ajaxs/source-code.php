<?php
include('ini.php');

$type = $_POST['type'];

if($type == 'add-source'){
    $inTrue = $connect->query("INSERT INTO `MaNguon`(`id`, `name`, `description`, `price`, `linkcode`, `image`, `images`, `sold`) VALUES (NULL,'".$_POST['name']."','".$_POST['description']."','".$_POST['price']."','".$_POST['linkcode']."','".$_POST['image']."','".$_POST['images']."','0')");
    if($inTrue){
        echo swal('Thêm thành công!','success');
        echo redirect('');
    } else {
        echo swal('Thêm thất bại!','error');
    }
} else if($type == 'edit-source'){
    $inTrue = $connect->query("UPDATE `MaNguon` SET `name`='".$_POST['name']."',`description`='".$_POST['description']."',`price`='".$_POST['price']."',`linkcode`='".$_POST['linkcode']."',`image`='".$_POST['image']."',`images`='".$_POST['images']."',`sold`='".$_POST['sold']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Lưu thành công!','success');
        echo redirect('');
    } else {
        echo swal('Lưu thất bại!','error');
    }
}
?>