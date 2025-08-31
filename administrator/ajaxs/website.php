<?php
include('ini.php');
$type = $_POST['type'];

if($type == 'add-category'){
    $inTrue = $connect->query("INSERT INTO `MauGiaoDien`(`id`, `name`, `image`, `time_date`) VALUES (NULL,'".$_POST['name']."','".$_POST['image']."','".time()."')");
    if($inTrue){
        echo swal('Thêm danh mục thành công','success');
        echo redirect('./add-category.php');
    } else {
        echo swal('Không thể xử lí!','error');
    }
} else if($type == 'add-theme'){
    $inTrue = $connect->query("INSERT INTO `GiaoDien`(`id`, `category`, `name`, `description`, `image`, `images`, `price`, `exprice`, `sold`) VALUES (NULL,'".$_POST['id']."','".$_POST['name']."','".$_POST['description']."','".$_POST['image']."','".$_POST['images']."','".$_POST['price']."','".$_POST['exprice']."','0')");
    if($inTrue){
        echo swal('Thêm giao diện thành công','success');
        echo redirect('');
    } else { 
        echo swal('Không thể xử lí!','error');
    }
} else if($type == 'edit-category'){
    
     $inTrue = $connect->query("UPDATE `MauGiaoDien` SET `name`='".$_POST['name']."',`image`='".$_POST['image']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Thêm giao diện thành công','success');
    } else {
        echo swal('Không thể xử lí!','error');
    }
} else if($type == 'load-info'){
    $query = $connect->query("SELECT * FROM DanhSachWeb WHERE id = '".$_POST['id']."'")->fetch_array();
    if($query['id'] != $_POST['id']){
        echo json_api('Không Tìm thấy thông tin!','error');
    } else {
        echo json_encode(['dmmm' => $query['status'] , 'domain' => $query['domain'], 'username' => $query['username'], 'theme' => $query['theme'], 'useradmin' => $query['useradmin'], 'password' => $query['password'], 'orvertime' => ToTime($query['orvertime'])]);
    }
} else if($type == 'edit-theme'){
    $inTrue = $connect->query("UPDATE `GiaoDien` SET `name`='".$_POST['name']."',`description`='".$_POST['description']."',`image`='".$_POST['image']."',`images`='".$_POST['images']."',`price`='".$_POST['price']."',`exprice`='".$_POST['exprice']."',`sold`='".$_POST['sold']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Cập nhật giao diện thành công','success');
        echo redirect('');
    } else {
        echo swal('Không thể xử lí!','error');
    }
} else if($type == 'update'){
    $inTrue = $connect->query("UPDATE `DanhSachWeb` SET `status`='".$_POST['status']."' WHERE `id` = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Cập nhật thành công','success');
        echo redirect('');
    } else {
        echo swal('Không thể xử lí!','error');
    }
}
?>