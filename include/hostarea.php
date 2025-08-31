<?php include('../app/header.php');
checkSession();
$id = $_GET['id'];
$query = $connect->query("SELECT * FROM DanhSachHost WHERE id = '$id' AND username = '".$getUser['username']."'")->fetch_array();
$getName = $connect->query("SELECT * FROM Server WHERE uname = '".$query['server']."'")->fetch_array();
$getPack = $connect->query("SELECT * FROM `HostPackage` WHERE `package` = '".$query['package']."'")->fetch_array();
if($id != $query['id'] || empty($id)){
    echo redirect('/host-manage');
}
?>
<title>Quản Lý Hosting #<?=$query['id'];?> - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">CHI TIẾT HOSTING</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Hosting area
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

              <div class="row">
                <div class="col-lg-9">
                  <div class="card">
                    <div class="card-body p-4">
                      <div class="w-100 badge bg-primary">
                      <b class="fs-4 mb-6">HOSTING <?=inHoaString($getPack['package']);?></b><br>
                     <iconify-icon icon="ph:link" class="fs-4 me-1"></iconify-icon> <a href="https://<?=$query['domain'];?>" class="mb-0 pb-9 text-white">
                        https://<?=$query['domain'];?>
                      </a>
                      </div><br>
                      <div class="py-9">
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Tên Miền: </span>
                            <a href="https://<?=$query['domain'];?>"><b class="mb-0 text-primary">htps://<?=$query['domain'];?></b></a>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Link Login: </span>
                            <?php if($query['status'] == 0 || $query['status'] == 1){ ?>
                            <a href="<?=$getName['hostname'];?>:2083" target="_blank"><b class="mb-0 text-primary"><?=$getName['hostname'];?>:2083</b></a>
                            <?php } else { echo 'Không Hiển Thị!'; } ?>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Tài Khoản: </span>
                           <b class="copyText mb-1 text-black"><?=$query['taikhoan'];?><iconify-icon class="fs-4 me-1 text-black" icon="solar:copy-bold-duotone"></iconify-icon></b>
                          </div>
                        </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Mật Khẩu: </span>
                            <b class="copyText mb-1 text-black"><?=$query['matkhau'];?><iconify-icon class="fs-4 me-1 text-black" icon="solar:copy-bold-duotone"></iconify-icon></b>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">IP Host: </span>
                            <b class="copyText mb-1 text-black"><?=$getName['ip'];?><iconify-icon class="fs-4 me-1 text-black" icon="solar:copy-bold-duotone"></iconify-icon></b>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Ns1: </span>
                            <b class="copyText mb-4 text-black"><?php if($query['status'] == 0 || $query['status'] == 1){ ?>  <?=$getName['nameserver1'];?><?php } else { ?> Không hiển thị! <?php } ?><iconify-icon class="fs-4 me-1 text-black" icon="solar:copy-bold-duotone"></iconify-icon></b>
                          </div>
                        
                       </div>
                       <div class="d-flex align-items-center">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Ns2: </span>
                            <b class="copyText mb-1 text-black"><?php if($query['status'] == 0 || $query['status'] == 1){ ?> <?=$getName['nameserver2'];?> <?php } else { ?> Không hiển thị! <?php } ?><iconify-icon class="fs-4 me-1 text-black" icon="solar:copy-bold-duotone"></iconify-icon></b>
                          </div>
                        
                       </div>
                       <br>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Email: </span>
                            <b class="mb-1 text-danger"><?=$query['email'];?></b>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Gói: </span>
                            <b class="mb-1 text-black">HOSTING <?=inHoaString($getPack['package']);?></b>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Tình Trạng: </span><?=StatusHost($query['status']);?>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 qfs-3 text-black">Ngày Mua: </span>
                            <b class="mb-1 text-black"><?=ToTime($query['time']);?></b>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                          <div class="ms-6 d-flex">
                           <span class="mb-1 me-1 fs-3 text-black">Ngày Hết Hạn: </span>
                            <b class="mb-1 text-black"><?=ToTime($query['orvertime']);?></b>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                 <div class="col-lg-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="align-items-center mb-9 text-center" <?php if($query['status'] == 1){ ?> onclick="window.open('<?=$getName['hostname'];?>:2083/login/?user=<?=$query['taikhoan'];?>&pass=<?=$query['matkhau'];?>')" <?php } else { ?> onclick="ErrorStatus()" <?php } ?>>
                       <img src="https://cyberlux.vn/static/media/cpanel.1139248d3ba4eb8126c8c487f86e29c3.svg" class="fs-7 m-1" alt="Cpanel"><br>
                          <h6 class="mb-1">Truy Cập CPanel</h6>
                      </div>
                      
                      <div <?php if($query['status'] == 1){ ?> data-bs-toggle="modal" data-bs-target="#pop-tool-modal" <?php } else { ?> onclick="ErrorStatus()" <?php } ?> class="align-items-center mb-9 text-center">
                       <img src="https://cyberlux.vn/static/media/change-pass.4fa237f5d74afe374fb6af5f688318f7.svg" class="fs-7 m-1" alt="Cpanel"><br>
                          <h6 class="mb-1">Đổi Mật Khẩu</h6>
                      </div>
                      
                      <div <?php if($query['status'] == 1 || $query['status'] == 4){ ?> data-bs-toggle="modal" data-bs-target="#extend-modal" <?php } else { ?> onclick="ErrorStatus()" <?php } ?> class="align-items-center mb-9 text-center">
                       <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAARvSURBVHgB7VlNiFtVFD4nDU430ieIdCH0uRAEW5uA0I4UTEBwGQfFH7qYBFfSlmZw4TIJFHfSDPVnmbhRdOG0CzeKvAhSRlwkgy0KhfZBl130lW6mJZPb79x3k2am+XnvZhheIB+8e2/uu7k5/+fcG6IFFlhggQVmANMcQZVfc6mbdimd9rne8WVuLhhQ5YxD3e4GhrnBJHOdr/y7lqZ5wM7OZQqJr+FpgfoiKVVW548/SLwGjPTv9yU+mD9/3EOXSVHS8Zhc3Sv6c88b+ewkn4HnyEcbwFsLu+aZV9F25sOJz71RJu6JH7QolLwwkwETpeRrAFg+s3Xk0quXZOjgqZBohHgFPtFMvAZO/6hcxdQGoVc3P+bS3vfzEEYrrLTka6NeJtqERProimBgffMT9ketSTQDMB1xXB99fdyamUwIyeQiIkEZWdHFxw7G6+JYtA+A9JFt6T0MS+OkL7DWAIiXaFAH8T6JfTI7GDfUudfLtD+Q/X0Q35y0yF4DjHqEqAmJ9yNDVad35pCxGaClTzoDl6attdIA6hPXmM3u9K7UNbSOLnstYRy3gszbmiZ9ga0GAt2GTDxFKnUScwHX//fJHlIiQECUj7LYigEcJgKYyzqGFXXhxBEteeYC+uK9w0dhPjfIBkb6VUi/iaTlR/mOtROfzf7S+fWlgmhBnNaT/trRD4LCm78X3/pZZcgOFd2q0UlrFKxKCSMpj5mC65vZFdTrcszrLJ9qO2be4RTlr3/InZh73sFTg+1Xo37PzoSYNpQS4dOKOZv65k0AQvKY96hHHjQRh4mG2adJMRDbhEBgBQSKidRGJRgzJ0wEvR1qn/5JrUbYs0jmyDgpaY1CLBMaqDl0sokxOtdQzqMl8lAGZCCm4uZH/P2EfcV0hPlXKCYiayC3obR94/EPL9HatPWtEgdLjyiPQqwDc2qO08RQ0orsuMOIrAH8kNhocadH2X/ORnfOUZrQB3XadpZP/SdLPJ20pmh0HCJpwEhJnloc4gXDmnj+8cPmrS/e39C3DN30nd/+PtP+9O53bpywuRdTNdAPmTK2sdE+RBNf3v6svXz/L5fC4s8H4TnEslWEszX+5qZV/RQljDaUxHVFWZoB3lbW0fkCxPPXN6pmuomMfszcMFgxMNGEJGSiy4H4tbjh7RmExAtae95IQWibucczsKsuiVAVTgUyte6lZhqGud8hS4w0IQmZ29thyJzFwYYxKADlTvPCCYd6vIW7noKuaNkuAul9pcHGOdKFFEOVyv/h5aJ/5djncpzLQ/ot2kfgt2DrInXJKxyQ6tVsHVjAhngvjAr6QHIST+6PF99tvVP9KlJNbgM59Mx4btBgcwx06dChrKhZb66lRBdhty/055IKceKcSH43ocZsul3r6HBQSGnTCc3mKVjfhBH1VKKlL0gjGqzDkC4jMjSgCakY30bkkVPWVf72pnV4Oyj0o1CV+se5EC3Yf6n/R1qSMaiF9FWJPhp2/f2IDgcFRsat0hxDMnGF5hhPAJw6zri/87CPAAAAAElFTkSuQmCC" class="fs-5 m-1" alt="Cpanel"><br>
                          <h6 class="mb-1">Gia Hạn</h6>
                      </div>
                      
                      <div <?php if($query['status'] == 1){ ?> data-bs-toggle="modal" data-bs-target="#nangcap-modal" <?php } else { ?> onclick="ErrorStatus()" <?php } ?> class="align-items-center mb-9 text-center">
                       <img src="https://cyberlux.vn/static/media/upgrade.31da1fc7c44e0f85fdbfe906ea7d1723.svg" class="fs-7 m-1" alt="Cpanel"><br>
                          <h6 class="mb-1">Nâng Cấp</h6>
                      </div>
                      
                      <div class="align-items-center mb-9 text-center">
    <img src="https://cyberlux.vn/static/media/cpanel_change_domain.f58208deac38fab815e62761560cd36f.svg" class="fs-5 m-1" alt="Reset Hosting"><br>
    <h6 class="mb-1" onclick="resetHosting()">Reset Hosting</h6>
</div>
                      
                      <div onclick="SwalChamDut()" class="align-items-center mb-9 text-center">
                       <img src="https://cyberlux.vn/static/media/cpanel_change_domain.f58208deac38fab815e62761560cd36f.svg" class="fs-5 m-1" alt="Cpanel"><br>
                          <h6 class="mb-1">Hủy Dịch Vụ</h6>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
        </div>
      </div>
<!-- DOI MAT KHAU -->
<?php if($query['status'] == 1){
?>
<div class="modal fade" id="pop-tool-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h6 class="modal-title" id="myLargeModalLabel">
           Đổi Mật Khẩu
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
                    <div class="row">
                     <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                          <label for="inputname" class="form-label">Mật Khẩu Mới</label>
                          <input type="text" class="form-control" id="password" placeholder="Nhập mật khẩu mới">
                        </div>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="justify-content-center btn mb-1 btn-rounded btn-dark d-flex align-items-center" data-bs-dismiss="modal">
            Hủy
          </button>
          <button id="submit" onclick="ChangePassword()" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
            Đổi Ngay
          </button>
        </div>
      </div>
    </div>
  </div>
   <script>
function ChangePassword(){
  $('#submit').html('Đang xử lý...').prop('disabled', true);
      $.ajax({
                    url: "/ajaxs/hosting.php",
                    method: "POST",
                    data: {
                       id: '<?=$query['id'];?>',
                       password: $("#password").val(),
                       type: 'changepassword',
                    },
                    success: function(response) {
                     var data = JSON.parse(response);
                     
                     swal("Thông Báo",data.message,data.status);
                     
                     if(data.status == 'success'){
                         window.location.href="";
                     }
                     $('#submit').html('Đổi Mật Khẩu').prop('disabled', false);
                     modal.close();
                    }
                });
            }
</script>
<?php } ?>
<!-- GIA HAN -->
<?php if($query['status'] == 1 || $query['status'] == 4){
  $package = $connect->query("SELECT * FROM HostPackage WHERE package = '".$query['package']."'")->fetch_array();
  ?>
<div class="modal fade" id="extend-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h6 class="modal-title" id="myLargeModalLabel">
           Gia Hạn Gói
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
                    <div class="row">
                     <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
<label for="inputEmail3" class="form-label">Hạn Dùng</label>
                         <select class="form-control" id="hsd">
                  <option value="0">-- Chọn hạn sử dụng --</option>
                      <option value="1">1 Tháng - <?=Price($package['price'] * 1);?>đ</option>
                      <option value="2">2 Tháng - <?=Price($package['price'] * 2);?>đ</option>
                      <option value="3">3 Tháng - <?=Price($package['price'] * 3);?>đ</option>
                      <option value="4">4 Tháng - <?=Price($package['price'] * 4);?>đ</option>
                      <option value="5">5 Tháng - <?=Price($package['price'] * 5);?>đ</option>
                      <option value="6">6 Tháng - <?=Price($package['price'] * 6);?>đ</option>
                      <option value="7">7 Tháng - <?=Price($package['price'] * 7);?>đ</option>
                      <option value="8">8 Tháng - <?=Price($package['price'] * 8);?>đ</option>
                         </select>
                        </div>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="justify-content-center btn mb-1 btn-rounded btn-dark d-flex align-items-center" data-bs-dismiss="modal">
            Hủy
          </button>
          <button id="extend" onclick="extend()" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
            Gia Hạn
          </button>
        </div>
      </div>
    </div>
  </div>
   <script>
function extend(){
  $('#extend').html('Đang xử lý...').prop('disabled', true);
      $.ajax({
                    url: "/ajaxs/hosting.php",
                    method: "POST",
                    data: {
                       id: '<?=$query['id'];?>',
                       hsd: $("#hsd").val(),
                       type: 'giahan',
                    },
                    success: function(response) {
                     var data = JSON.parse(response);
                     
                     swal("Thông Báo",data.message,data.status);
                     
                     if(data.status == 'success'){
                         window.location.href="";
                     }
                     $('#extend').html('Gia Hạn').prop('disabled', false);
                     modal.close();
                    }
                });
            }
</script>
<?php } ?>
<!-- NANG CAP -->
<?php if($query['status'] == 1){ 
     $package = $connect->query("SELECT * FROM HostPackage WHERE package = '".$query['package']."'")->fetch_array();
      ?>
<div class="modal fade" id="nangcap-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h6 class="modal-title" id="myLargeModalLabel">
           Nâng Cấp Gói
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
                    <div class="row">
                     <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
<label for="inputEmail3" class="form-label">Chọn Gói</label>
                         <select class="form-control" id="package">
                  <option value="0">-- Chọn Gói --</option>
                      <?php
                       $hsd = tinhNgay($query['time'], $query['orvertime']);
                       $tienConLai  = TruTienDichVu($query['time'], $getPack['price'], $hsd);
                       $getPrice = $getPack['price'];
                       $res = $connect->query("SELECT * FROM HostPackage WHERE server = '".$getName['uname']."' AND price > $getPrice AND package != '".$package['package']."'");
                       foreach($res as $row){
                           $id+=1;
                       ?>
                       
                       <option value="<?=$row['id'];?>"> <?=inHoaString($row['package']);?> (<?=Price($row['price'] - $tienConLai);?> <sup>đ</sup>) </option>
                       
                       <?php } if($id == 0){ ?>
                       
                        <option value=""> Hiện không có gói nào:( </option>
                        
                       <?php } ?>
                         </select>
                        </div>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="justify-content-center btn mb-1 btn-rounded btn-dark d-flex align-items-center" data-bs-dismiss="modal">
            Hủy
          </button>
          <button id="submit3" onclick="tphat()" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
            Nâng Cấp
          </button>
        </div>
      </div>
    </div>
  </div>
    <script>
        function tphat(){
          $('#submit3').html('Đang xử lý...').prop('disabled', true);
            $.ajax({
                url: "/ajaxs/hosting.php",
                method: "POST",
                data: {
                   id: '<?=$query['id'];?>',
                   packagee: $("#package").val(),
                   type: 'nangcap',
                },
                success: function(response) {
                 var data = JSON.parse(response);
                 
                 swal("Thông Báo",data.message,data.status);
                 
                 if(data.status == 'success'){
                     window.location.href="";
                 }
               $('#submit3').html('Nâng Cấp').prop('disabled', false);
                 modal.close();
                }
            });
        }
    </script>
<?php } ?> 
  
<?php if($query['status'] == 1){ ?>
          <form action="" method="post" id="submitDelete"><input name="delete" value="true" type="hidden"></form>
            <?php 
            if(isset($_POST['delete']) && $_POST['delete'] == 'true'){
                    $query = $getName['hostname'].':2087/json-api/removeacct?api.version=1&user='.$query['taikhoan'].'&password='.$query['matkhau'].'&enabledigest=0&db_pass_update=1'; 
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
                        echo swal('Không Thể Kết Nối Đến Cpanel','error');
                    } else {
                        $connect->query("DELETE FROM `DanhSachHost` WHERE `id` = '".$_GET['id']."'");
                        echo swal('Chấm dứt thành công!','success');
                        echo redirect('/host-manage');
                    }
                    curl_close($curl); 
              }
              
            ?>
 <script>
        function ErrorStatus(){
          swal('Thông Báo','Chức Năng Chỉ Cho Phép Dùng Khi Hosting Hoạt Động','warning');
        }
      
       function SwalChamDut(){
        swal({
          title: "Xác Nhận",
          text: "Bạn Có Chắc Muốn Xóa Dịch Vụ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              document.getElementById("submitDelete").submit();
              swal("Tạo Lệnh Chấm Dứt Thành Công,", {
              icon: "success",
            });
          }
        });
    }
        
    </script>
    <script>
function resetHosting() {
    if (confirm('Sau khi đặt lại tất cả dữ liệu sẽ biến mất, Bạn có muốn tiếp tục?')) {
        $.ajax({
            url: "/ajaxs/reset.php",
            method: "POST",
            data: {
                id: '<?=$query['id'];?>',
                type: 'reset'
            },
            success: function(response) {
                var data = JSON.parse(response);
                swal("Notification", data.message, data.status);
                if (data.status == 'success') {
                    window.location.href = "";
                }
            }
        });
    }
}
</script>
          <?php } ?>
<script>
          document.addEventListener('DOMContentLoaded', function() {
            const copyTextElements = document.querySelectorAll('.copyText');
            const copyButtonElements = document.querySelectorAll('.copyButton');
            function copyToClipboard(text, message) {
              navigator.clipboard.writeText(text).then(() => {
              }).catch(err => {
                
              });
            }
            copyTextElements.forEach(element => {
              element.addEventListener('click', function() {
                const text = element.innerText;
                swal("Thông Báo", "Đã sao chép " + text, "success");
                copyToClipboard(text);
              });
            });
          });
        </script>
<?php include('../app/footer.php'); ?>