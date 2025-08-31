<?php
include('ini.php');
$type = $_POST['type'];

if($type == 'add-logo'){
    $inTrue = $connect->query("INSERT INTO `Logo`(`id`, `name`, `image`, `price`, `sold`) VALUES (NULL,'".$_POST['name']."','".$_POST['image']."','".$_POST['price']."','0')");
    if($inTrue){
        echo swal('Thêm thành công','success');
        echo redirect('');
    } else {
        echo swal('Thêm thất bại!','error');
    }
} else if($type == 'load-info'){
    $query = $connect->query("SELECT * FROM DanhSachLogo WHERE id = '".$_POST['id']."'")->fetch_array();
    $theme = $connect->query("SELECT * FROM Logo WHERE id = '".$query['theme']."'")->fetch_array();
    if($query['id'] != $_POST['id']){
        echo json_api('Không tìm thấy thông tin!','error');
    } else {
        echo json_encode(['dmmm' => $query['status'] ,'link' => $query['link'], 'name' => $query['name'], 'username' => $query['username'], 'name_theme' => $theme['name'], 'image_theme' => $theme['image']]);
    }
} else if($type == 'update-logo'){
    $inTrue = $connect->query("UPDATE `DanhSachLogo` SET `status`='".$_POST['status']."', `link`='".$_POST['link']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Thao tác thành công','success');
        echo redirect('');
    } else {
        echo swal('Thao tác thất bại!','error');
    }
} else if($type == 'edit-logo'){
    $inTrue = $connect->query("UPDATE `Logo` SET `name`='".$_POST['name']."',`image`='".$_POST['image']."',`price`='".$_POST['price']."',`sold`='".$_POST['sold']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Thao tác thành công','success');
        echo redirect('');
    } else {
        echo swal('Thao tác thất bại!','error');
    }
}
?>