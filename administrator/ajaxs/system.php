<?php
include('ini.php');

$type = $_POST['type'];
if($type == 'card-system'){
    $inTrue = $connect->query("UPDATE System SET sitecard = '".$_POST['sitecard']."', partner_id = '".$_POST['partner_id']."', partner_key = '".$_POST['partner_key']."' WHERE id = '1'");
        if($inTrue){
            echo swal('Cấu hình thành công','success');
            echo redirect('');
        } else {
            echo swal('Cấu hình thất bại!','error');
        }
} else if($type == 'momo-system'){
    $inTrue = $connect->query("UPDATE System SET token_momo = '".$_POST['token_momo']."' WHERE id = '1'");
        if($inTrue){
            echo swal('Lưu thành công!','success');
            echo redirect('');
        } else {
            echo swal('Lưu thất bại!','error');
        }
} else if($type == 'add-bank'){
    $inTrue = $connect->query("INSERT INTO `Banks`(`id`, `name`, `chutaikhoan`, `sotaikhoan`, `toithieu`, `image`) VALUES (NULL,'".$_POST['name']."','".$_POST['chutaikhoan']."','".$_POST['sotaikhoan']."','".$_POST['toithieu']."','".$_POST['image']."')");
        if($inTrue){
            echo swal('Thêm ngân hàng thành công!','success');
            echo redirect('');
        } else {
            echo swal('Thêm ngân hàng thất bại!','error');
        }
} else if($type == 'load-atm'){
    $id = $_POST['id'];
    $query = $connect->query("SELECT * FROM Banks WHERE id = '$id'")->fetch_array();
    if($query['id'] != $id){
        echo json_api('ID ngân hàng không hợp lệ!','error');
    } else {
        echo json_encode(['name' => $query['name'], 'chutaikhoan' => $query['chutaikhoan'], 'sotaikhoan' => $query['sotaikhoan'], 'toithieu' => $query['toithieu'], 'image' => $query['image'], 'status' => 'success']);
    }
} else if($type == 'edit-bank'){
    $inTrue = $connect->query("UPDATE `Banks` SET `name`='".$_POST['name']."',`chutaikhoan`='".$_POST['chutaikhoan']."',`sotaikhoan`='".$_POST['sotaikhoan']."',`toithieu`='".$_POST['toithieu']."',`image`='".$_POST['image']."' WHERE id = '".$_POST['id']."'");
    if($inTrue){
        echo swal('Lưu thành công!','success');
        echo redirect('');
    } else {
        echo swal('Lưu thất bại!','error');
    }
} else if($type == 'setting'){
    $inTrue = $connect->query("UPDATE `System` SET `modal`='".AntiXss($_POST['modal'])."',`title`='".$_POST['title']."',`description`='".$_POST['description']."', `logo`='".$_POST['logo']."',`image`='".$_POST['image']."',`shortcut`='".$_POST['shortcut']."',`facebook`='".$_POST['facebook']."',`telegram`='".$_POST['telegram']."',`keywords`='".$_POST['keywords']."',`zalo_group`='".$_POST['zalo_group']."' WHERE id = '1'");
        if($inTrue){
            echo swal('Cấu hình thành công!','success');
            echo redirect('');
        } else {
            echo swal('Cấu hình thất bại!','error');
        } 
}
?>