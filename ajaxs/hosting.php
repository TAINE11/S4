<?php
include('../app/config.php');

$type =  $_POST['type'];

if($type == 'create'){
$id = $_POST['id'];
$package = $connect->query("SELECT * FROM HostPackage WHERE id = '$id'")->fetch_array();
$getName = $connect->query("SELECT * FROM Server WHERE uname = '".$package['server']."'")->fetch_array();
$checkLimit = $connect->query("SELECT * FROM DanhSachHost WHERE domain = '".$domain."' AND status != '2' OR status = '4' AND server = '".$getName['uname']."'")->num_rows;

$hostname = $getName['hostname'];
$whmusername = $getName['whmusername'];
$whmpassword = $getName['whmpassword'];
$ip = $getName['ip'];

$taikhoan = inThuongString('cnxhost'.RandStrings(5));
$matkhau = inThuongString(RandStrings(14));

$tienphaitra = $package['price'] * $_POST['hsd'];
$timehethan = time()+(2592000 * $_POST['hsd']);

if(!isset($_SESSION['users'])){
    echo json_api('Vui lòng đăng nhập để tiếp tục!','error');
} else if(empty($id)){
    echo json_api('Gói Hosting không hợp lệ!','error');
} else if(empty($_POST['domain'])){
    echo json_api('Vui lòng nhập tên miền!','error');
} else if(empty($_POST['hsd']) || $_POST['hsd'] < 1){
    echo json_api('Hạn đăng ký không hợp lệ!','error');
} else if($getUser['money'] < $tienphaitra){
    echo json_api('Số dư không đủ để thanh toán!','error');
} else if($checkLimit == 1){
    echo json_api('Tên miền đã tồn tại trong hệ thống!','error');
} else {
    
    $query = $hostname.':2087/json-api/createacct?api.version=1&username='.$taikhoan.'&domain='.$_POST['domain'].'&plan='.$getName['whmusername'].'_'.$package['package'].'&featurelist=jupiter&password='.$matkhau.'&ip=n&cgi=1&hasshell=1&contactemail='.$_POST['email'].'&cpmod=paper_lantern&language=vi'; 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); 
    $header[0] = "Authorization: Basic " . base64_encode($whmusername.":".$whmpassword) . "\n\r";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl); 
    $data = json_decode($result, true);
    
    if ($result === false) {
        if($result == '') echo json_api('Máy chủ đang bảo trì!', 'error'); else echo json_api('Có lỗi xảy ra, hãy kiểm tra lại!', 'error');
    } else {
        
        if(isset($data['metadata']['result'])){
             if($data['metadata']['result'] == 1){
                $inTrue = $connect->query("INSERT INTO `DanhSachHost`(`id`, `username`, `domain`, `email`, `package`, `server`, `status`, `time`, `orvertime`, `taikhoan`, `matkhau`) VALUES (NULL,'".$getUser['username']."','".$_POST['domain']."','".$_POST['email']."','".$package['package']."','".$getName['uname']."','1','".time()."','$timehethan','$taikhoan','$matkhau')");
                if($inTrue){
                    $connect->query("UPDATE Users SET money = money - '".$tienphaitra."' WHERE username = '".$getUser['username']."'");
                    $connect->query("UPDATE Users SET remoney = remoney + '".$tienphaitra."' WHERE username = '".$getUser['username']."'");
                    echo json_api('Thanh toán thành công', 'success');
                } else {
                    echo json_api('Không thể thanh toán!', 'error');
                }
               
        } else {
            echo json_api('Hãy thử đăng ký với tên miền khác!', 'error');
        }
        } else {
            echo json_api('Lỗi máy chủ!', 'error');
        }
        } 
        
        curl_close($curl); 
        
}

} else if($type == 'changepassword'){
    $query = $connect->query("SELECT * FROM `DanhSachHost` WHERE `id` = '".$_POST['id']."'")->fetch_array();
    $getName = $connect->query("SELECT * FROM `Server` WHERE `uname` = '".$query['server']."'")->fetch_array();
    
    if(empty($_POST['id']) || $_POST['id'] != $query['id']){
        echo json_api('Dịch vụ không tồn tại!','error');
    } else if($query['username'] != $getUser['username']){
        echo json_api('Bạn không có quyền quản lý dịch vụ này!','error');
    } else if(empty($_POST['password'])){
        echo json_api('Vui lòng nhập mật khẩu mới!','error');
    } else if($query['server'] != $getName['uname']) {
        echo json_api('Máy chủ không còn khả dụng!','error');
    } else {
        
        $query = $getName['hostname'].':2087/json-api/passwd?api.version=1&user='.$query['taikhoan'].'&password='.$_POST['password'].'&enabledigest=0&db_pass_update=1'; 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); 
        $header[0] = "Authorization: Basic " . base64_encode($getName['whmusername'].":".$getName['whmpassword']) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_URL, $query);
        $result = curl_exec($curl); 
        $data = json_decode($result, true);
        
        if ($result == false) {
          echo json_api('Đặt lại mật khẩu thất bại! - '.$result, 'error');  
        } else {
            
            if(isset($data['metadata']['result'])){
             if($data['metadata']['result'] == 1){
                         
                    $updateTrue = mysqli_query($connect, "UPDATE DanhSachHost SET matkhau = '".$_POST['password']."' WHERE id = '".$_POST['id']."'");
                     if($updateTrue){
                         echo json_api('Đặt lại mật khẩu thành công', 'success');
                     } else {
                         echo json_api('Đặt lại mật khẩu thất bại!', 'error');
                     }
                     
                 } else {
                    echo json_api('Vui lòng thử với mật khẩu bảo mật hơn!', 'error');
                }
                } else {
                    echo json_api('Lỗi máy chủ!', 'error');
                }
                
        
        }
        curl_close($curl); 

    }
} else if($type == 'giahan'){
        
$hsd = $_POST['hsd'];
$id = $_POST['id'];
$query = $connect->query("SELECT * FROM DanhSachHost WHERE id = '$id'")->fetch_array();
$package = $connect->query("SELECT * FROM HostPackage WHERE package = '".$query['package']."'")->fetch_array();
$getName = $connect->query("SELECT * FROM Server WHERE uname = '".$package['server']."'")->fetch_array();
$tienphaitra = $package['price'] * $hsd;
$timedangco = $query['orvertime'];
$timesapco = 2592000 * $hsd;
$unsuspendacct = time()+(2592000*$hsd);
$tongtime = $timedangco + $timesapco;

$timesuspended = time()+(86400*3);

if($package['price'] < 1000){
    $hsd = '0';
}

if(empty($id)){
    echo json_api('Dịch vụ không hợp lệ!','error');
} else if(empty($hsd) || $hsd < 1 || $hsd > 12){
    echo json_api('Hạn dùng không hợp lệ!','error');
} else if($getUser['money'] < $tienphaitra){
    echo json_api('Không đủ tiền để gia hạn!','error');
} else {
    
    if($query['status'] == '4'){
        $query = $getName['hostname'].':2087/json-api/unsuspendacct?api.version=1&user='.$query['taikhoan'].'&password='.$query['matkhau'].'&enabledigest=0&db_pass_update=1'; 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl, CURLOPT_HEADER,0); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); 
        $header[0] = "Authorization: Basic " . base64_encode($getName['whmusername'].":".$getName['whmpassword']) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_URL, $query); 
        $result = curl_exec($curl); 
        
        if ($result == false) {
            echo swal('Không thể gia hạn!','error');
        } else {
            $inUpdate = $connect->query("UPDATE DanhSachHost SET orvertime = '$unsuspendacct', status = '1', timesuspended = '' WHERE id = '$id'");
            if($inUpdate){
                echo json_api('Gia hạn gói thành công','success');
                $connect->query("UPDATE Users SET money = money - $tienphaitra WHERE username = '".$getUser['username']."'");
                $connect->query("UPDATE Users SET remoney = remoney + $tienphaitra WHERE username = '".$getUser['username']."'");
            } else {
                echo json_api('Gia hạn thất bại!','error');
            }
        }
        curl_close($curl);
    
    
    } else {
    
    $inUpdate = $connect->query("UPDATE DanhSachHost SET orvertime = '$tongtime' WHERE id = '$id'");
    if($inUpdate){
        echo json_api('Gia hạn gói thành công','success');
        $connect->query("UPDATE Users SET money = money - $tienphaitra WHERE username = '".$getUser['username']."'");
                $connect->query("UPDATE Users SET remoney = remoney + $tienphaitra WHERE username = '".$getUser['username']."'");
    } else {
        echo json_api('Gia hạn thất bại!','error');
    }
    
    }
}

} else if($type == 'nangcap'){
        
    $package = $_POST['packagee'];
    $id = $_POST['id'];
    $query = $connect->query("SELECT * FROM DanhSachHost WHERE id = '$id'")->fetch_array();
    $old_package = $connect->query("SELECT * FROM HostPackage WHERE package = '".$query['package']."'")->fetch_array();
    $new_package = $connect->query("SELECT * FROM HostPackage WHERE id = '$package'")->fetch_array();
    $getName = $connect->query("SELECT * FROM Server WHERE uname = '".$new_package['server']."'")->fetch_array();
    
    $tienConLai  = TruTienDichVu($query['time'], $old_package['price'], $hsd);
    $tienphaitra = $new_package['price'] - $tienConLai;
    
    if($query['status'] == '1'){
    if(empty($id) || $id != $query['id']){
        echo json_api('Dịch vụ không hợp lệ!','error');
    } else if(empty($package) || $package != $new_package['id']){
        echo json_api('Gói không hợp lệ!','error');
    } else if($getUser['money'] < $tienphaitra){
        echo json_api('Không đủ tiền để nâng cấp!','error');
    } else if($new_package['price'] < $old_package['price']){
        echo json_api('Bạn phải đăng ký gói cao hơn gói hiện tại!','error');
    } else {
        
        $query = $getName['hostname'].':2087/json-api/changepackage?api.version=1&user='.$query['taikhoan'].'&pkg='.$getName['whmusername'].'_'.$new_package['package']; 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); 
        $header[0] = "Authorization: Basic " . base64_encode($getName['whmusername'].":".$getName['whmpassword']) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_URL, $query);
        $result = curl_exec($curl); 
        
        if ($result == false) {
            echo json_api('Không thể nâng cấp!','error');
        } else {
            $inUpdate = mysqli_query($connect, "UPDATE `DanhSachHost` SET `package`='".$new_package['package']."' WHERE id = '$id'");
            if($inUpdate){
                $connect->query("UPDATE Users SET money = money - $tienphaitra WHERE username = '".$getUser['username']."'");
                $connect->query("UPDATE Users SET remoney = remoney + $tienphaitra WHERE username = '".$getUser['username']."'");
                echo json_api('Nâng cấp thành công lên gói '.inHoaString(AntiXss($new_package['package'])),'success');
            } else {
                echo json_api('Không thể thực hiện yêu cầu!'. $response['metadata']['reason'],'error');
            }
        }
    
    
        curl_close($curl);
    }
    
} else {
    echo json_api('Tính năng chỉ khả dụng khi dịch vụ hoạt động!','error');
}
}
?>