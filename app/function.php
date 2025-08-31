<?php
function distanceTime($thoiDiem){
    $thoiGianHienTai = time();
    $khoangCach = $thoiGianHienTai - $thoiDiem;

    if ($khoangCach < 60) {
        return $khoangCach . " giây trước";
    } elseif ($khoangCach < 3600) {
        return round($khoangCach / 60) . " phút trước";
    } elseif ($khoangCach < 86400) {
        return round($khoangCach / 3600) . " giờ trước";
    } else {
        return round($khoangCach / 86400) . " ngày trước";
    }
}
function json_api($text, $status){
    echo json_encode(['message' => $text, 'status' => $status]);
}
function calculatePercentage($amount, $percentage) {
    return ($amount * $percentage) / 100;
}
function tinhNgay($time, $timedn){
    $ngayMua = new DateTime("@" . $time);
    $ngayHetHan = new DateTime("@" . $timedn);
    $soNgay = $ngayHetHan->diff($ngayMua)->days;
    
    return $soNgay;
}
function checkGia($price, $giam) {
    $result = $price - ($price * ($giam / 100));
    return $result;
}
function TruTienDichVu($time, $amount, $hsd){
$ngayMua = $time; 
$ngayHienTai = time(); 
$soNgay = floor(($ngayHienTai - $ngayMua) / (60 * 60 * 24));

$giaDichVu = $amount; 
$tienConDu = max(0, $giaDichVu - ($soNgay * ($giaDichVu / $hsd)));
return $tienConDu;
}
function ToTime($time){
    return date('d/m/Y - h:i:s', $time);
}
function inHoaString($text){
    return strtoupper($text);
}
function inOneString($text){
    return ucwords($text);
}
function inThuongString($text){
    return strtolower($text);
}
function redirect($url){
    return('<meta http-equiv="refresh" content="0;url='.$url.'">');
}
function ReturnXss($text){
    return htmlspecialchars_decode($text, ENT_QUOTES);
}
function AntiXss($text){
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
function Price($monney){
    return str_replace(".", ",", number_format($monney));
}
function swal($text, $status){
    return '<script>swal("Thông Báo", "'.$text.'", "'.$status.'");</script>';
}
function isDomainRegistered($domain) {
    if (file_get_contents("http://www.whois.net.vn/whois.php?domain=".$domain) == 0) {
        return true;
    } else {
        return false;
    }
}
function Title($text){
    return '<title> '.$text.' </title>';
}
function checkSession(){
    if(!isset($_SESSION['users'])){
        echo redirect('/login');
        exit;
    }
}
function resultDomain($domain, $price, $status){
    if($status == 'true'){
  return '<tr>
            <td> 
              <span class="badge bg-success"> Có Thể Đăng Ký
              </span>
            </td>
            <td class="text-center">
              <a class="fw-semibold">
                '.$domain.'
              </a>
            </td>
            
            <td class="text-center">
              <strong> '.Price($price).' <sup>đ</sup></strong>
            </td>
            
            <td class="text-center">
              <a class="badge bg-black" href="/ajaxs/inDomain.php?domain='.$domain.'">
Mua Ngay
              </a>
            </td>
          </tr>
          '; 
          
} else if($status == 'false'){
       return '<tr>
            <td>
              <span class="badge bg-danger"> Đã được đăng ký</span>
            </td>
            
            <td class="text-center">
              <a class="fw-semibold">
                '.$domain.'
              </a>
            </td>
            
            <td class="text-center">
              <strong> '.Price($price).' <sup>đ</sup></strong>
            </td>
            
            <td class="text-center">
            </td>
          </tr>
          '; 
          
} else if($status == 'null'){
  return '<tr>
            <td>
              <span class="badge rounded-pill bg-warning"> Không khả dụng </span>
            </td>
            
            <td class="text-center">
              <a class="fw-semibold">
                '.$domain.'
              </a>
            </td>
            
            <td class="text-center">
              <strong> '.Price($price).' <sup>đ</sup></strong>
            </td>
            
            <td class="text-center">
              
            </td>
          </tr>
          '; 
}

}
function StatusHost($status){
    if($status == '0'){
        return '<span class="mb-1 badge bg-primary">Đang tạo</span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-success">Hoạt động</span>';
    } else if($status == '2'){
        return '<span class="mb-1 badge bg-danger">Hết hạn</span>';
    } else if($status == '3'){
        return '<span class="mb-1 badge bg-danger">Tạm khoá</span>';
    } else if($status == '4'){
        return '<span class="mb-1 badge bg-warning">Chờ gia hạn</span>';
    } else if($status == '5'){
        return '<span class="mb-1 badge bg-danger">Bị khoá</span>';
    } else if($status == '6'){
        return '<span class="mb-1 badge bg-danger">Không khả dụng</span>';
    } else {
        return '<span class="mb-1 badge bg-danger">Không xác định</span>';
    }
}
function StatusWeb($status){
    if($status == '0'){
        return '<span class="mb-1 badge bg-primary">Đang xử lý</span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-success">Hoạt động</span>';
    } else if($status == '2'){
        return '<span class="mb-1 badge bg-warning">Chờ gia hạn</span>';
    } else if($status == '3'){
        return '<span class="mb-1 badge bg-danger">Hết hạn</span>';
    } else if($status == '4'){
        return '<span class="mb-1 badge bg-danger">Bị hủy</span>';
    } else if($status == '5'){
        return '<span class="mb-1 badge bg-warning">Đang xét duyệt</span>';
    } else {
        return '<span class="mb-1 badge bg-info">Không xác định</span>';
    }
}
function StatusCron($status){
    if($status == '0'){
        return '<span class="mb-1 badge bg-success">Hoạt động</span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-warning">Tạm dừng</span>';
    } else if($status == '2'){
        return '<span class="mb-1 badge bg-danger">Lỗi</span>';
    } else if($status == '3'){
        return '<span class="mb-1 badge bg-warning">Bảo trì</span>';
    } else if($status == '4'){
        return '<span class="mb-1 badge bg-danger">Hết hạn</span>';
    } else {
        return '<span class="mb-1 badge bg-info">Không xác định</span>';
    }
    return $result;
}
function StatusLogo($status){
    if($status == '0'){
        return '<span class="mb-1 badge bg-primary">Đang tạo</span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-success">Hoàn tất</span>';
    } else if($status == '2'){
        return '<span class="mb-1 badge bg-danger">Bị hủy</span>';
    } else if($status == '6'){
        return '<span class="mb-1 badge bg-danger">Không khả dụng</span>';
    } else {
        return '<span class="mb-1 badge bg-danger">Không xác định</span>';
    }
}
function StatusDomain($status){
    if($status == '0'){
        return '<span class="mb-1 badge bg-primary"> Đang xử lý </span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-success"> Hoạt động </span>';
    } else if($status == '2'){
        return '<span class="mb-1 badge bg-danger"> Hết hạn </span>';
    } else if($status == '3'){
        return '<span class="mb-1 badge bg-danger"> Bị hủy </span>';
    } else if($status == '4'){
        return '<span class="mb-1 badge bg-danger"> Hoàn tiền </span>';
    } else {
        return '<span class="mb-1 badge bg-danger"> Không xác định </span>';
    }
}
function StatusMomo($status){
    if($status == '0'){
        return '<span class="mb-1 badge bg-primary">Đang xử lý</span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-success">Hoàn thành</span>';
    } 
}
function StatusCard($status){
     if($status == '0'){
        return '<span class="mb-1 badge bg-primary">Đang xử lý</span>';
    } else if($status == '1'){
        return '<span class="mb-1 badge bg-success">Thẻ đúng</span>';
    } else if($status == '2'){
        return '<span class="mb-1 badge bg-danger">Thẻ sai</span>';
    } else {
        return '<span class="mb-1 badge bg-info">Không xác định</span>';
    }
}
function curl_get_info($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode;
}
function curl_post_info($url)
{
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
    ));
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode;
}
function GetSvCron($id_server){
    $cloudnix = $connect->query("SELECT * FROM `server_cron_auto` WHERE `id` = '$id_server' AND `status` = 'ON'");
    if ($cloudnix) {
        $result = $cloudnix['name'];
    } else {
        $result = 'Lỗi';
    }
    return $result;
}
function GetCodeCron($code){
    if ($code == 200) {
        $result = 'success(' . $code . ')';
    }
    if ($code != 200) {
        $result = 'error(' . $code . ')';
    }
    return $result;
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function curl_post($data, $url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function RandStrings($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}
?>