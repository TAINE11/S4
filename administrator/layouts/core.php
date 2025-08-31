<?php
include('../app/config.php');
if(!isset($_SESSION['users'])){
    die('Bạn Không Có Quyền Truy Cập =))');
} else if($getUser['level'] != 'admin'){
    die('Bạn Không Có Quyền Truy Cập =))');
} 
?>