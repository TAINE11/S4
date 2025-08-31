<?php
include('ini.php');

    if(empty($_POST['code'])){
        $code = RandStrings(10);
    } else {
        $code = $_POST['code'];
    }
    
    $inTrue = $connect->query("INSERT INTO `MaGiamGia`(`id`, `service`, `code`, `max`, `sold`, `type`, `amount`) VALUES (NULL,'".$_POST['service']."','".$code."','".$_POST['max']."','0','".$_POST['type']."','".$_POST['amount']."')");
    if($inTrue){
        echo swal('Thêm thành công','success');
        echo redirect('');
    } else {
        echo swal('Thêm thất bại!','error');
    }

?>