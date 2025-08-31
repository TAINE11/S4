<?php
include('layouts/header.php');
$server = $connect->query("SELECT * FROM Server WHERE uname = '".$_GET['server']."'")->fetch_array();

if(empty($_GET['server']) || $_GET['server'] != $server['uname']){
    echo swal('Tên Máy Chủ Không Hợp Lệ','error');
    echo redirect('./server.php');
}


if(isset($_GET['delete_server'])){
    $check = $connect->query("SELECT * FROM `HostPackage` WHERE `id` = '".$_GET['delete_server']."'")->fetch_array();
    
    if($_GET['delete_server'] != $check['id']){
        echo swal('ID Máy Chủ Không Hợp Lệ','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `HostPackage` WHERE `id` = '".$_GET['delete_server']."'");
        if($inTrue){
            echo swal('Thao Tác Thành Công','success');
            echo redirect('?server='.$check['server']);
        } else {
            echo swal('Không Thể Xóa','error');
        }
    }
}
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Quản Lý Gói Máy Chủ (<?=inHoaString($server['name']);?>) </h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Thêm Gói </h4>
                                     <p class="text-muted mb-0">
                                        <strong class="text-danger"> Tên Gói: </strong> Nếu Trong WHM Gói Của Bạn Theo Dạng <?=$server['whmusername'];?>_package1 Thì Bạn Chỉ Cần Viết package1 Vào Ô Tên Gói
                                    </p>
                                    
                                </div>
                                
                                <div class="card-body">
                                    <div class="needs-validation" novalidate="">
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="name"> Tên Gói </label>
                                            <input type="text" class="form-control" id="packages" placeholder="VD: package1" required="">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="name"> Dung Lượng </label>
                                            <input type="text" class="form-control" id="disk" placeholder="VD: 500 MB" required="">
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="uname"> Băng Thông </label>
                                            <input type="text" class="form-control" id="bangthong" placeholder="VD: Không Giới Hạn" required="">
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Miền Khác </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="addondomain" placeholder="VD: Không Giới Hạn" required="">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Miền Con </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="subdomain" placeholder="VD: Không Giới Hạn" required="">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom03"> Giá Bán </label>
                                            <input type="text" class="form-control" id="price" placeholder="Ví Dụ: 10000" required="">
                                        </div>
                                        
                                   
                                        <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm Gói </button>
                                    </div>

                                </div> 
                            </div> 
                        </div> 
                        
                        
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Gói </h4>
                                </div>
                                <div class="container">
                                <div class="table-responsive-sm">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th> Tên Gói </th>
                                                    <th> Dung Lượng </th>
                                                    <th> Giá Bán </th>
                                                    <th> Hành Động </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = $connect->query("SELECT * FROM HostPackage WHERE server = '".$server['uname']."'");
                                                foreach($query as $row){
                                                ?>
                                                
                                                <tr class="table-active">
                                                    <td> <?=inHoaString($row['package']);?> </td>
                                                    <td> <?=inHoaString($row['disk']);?> </td>
                                                    <td> <?=Price($row['price']);?> <sup>đ</sup> </td>
                                                    <td> <span onclick="xoaServer(<?=$row['id'];?>)" class="badge bg-pink"> Xóa </span> <span onclick="window.location.href='./edit-package.php?id=<?=$row['id'];?>&server=<?=$row['server'];?>';" class="badge bg-info"> Chỉnh Sửa </span> </td>
                                                </tr>
                                                
                                                <?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div></div>
                            </div> 
                        </div> 
                    </div>
                </div> 

            </div> 
        </div>
        
        <script>
            function ThemMayChu(){
                  $.ajax({
                    url: "/administrator/ajaxs/server.php",
                    method: "POST",
                    data: {
                        type: 'themgoi',
                        packages: $("#packages").val(),
                        disk: $("#disk").val(),
                        bangthong: $("#bangthong").val(),
                        addondomain: $("#addondomain").val(),
                        subdomain: $("#subdomain").val(),
                        server: $("#server").val(),
                        price: $("#price").val(),
                        server: '<?=$_GET['server'];?>'
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
            
            
            function xoaServer(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa máy chủ này?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location.href="?delete_server=" + id;
                  }
                });
            }
        </script>
        
<?php
include('layouts/footer.php');
?>