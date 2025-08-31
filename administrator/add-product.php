<?php
include('layouts/header.php');
$server = $connect->query("SELECT * FROM MauGiaoDien WHERE id = '".$_GET['server']."'")->fetch_array();

if(empty($_GET['server']) || $_GET['server'] != $server['id']){
    echo redirect('./website-design.php');
}

if(isset($_GET['delete_server'])){
$danhmuc = $connect->query("SELECT * FROM GiaoDien WHERE id = '".$_GET['delete_server']."'")->fetch_array();

$inTrue = $connect->query("DELETE FROM `GiaoDien` WHERE `id` = '".$_GET['delete_server']."'");
if($inTrue){
    $connect->query("DELETE FROM `GiaoDien` WHERE `category` = '".$check['id']."'");
    echo swal('Xóa thành công!','success');
    echo redirect('?server='.$danhmuc['category']);
} else {
    echo swal('Không thể xoá!','error');
}
}
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Thêm Giao Diện (Danh Mục <?=inHoaString($server['name']);?>) </h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Thêm Giao Diện </h4>
                                </div>
                                
                                <div class="card-body">
                                    <div class="needs-validation" novalidate="">
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="name"> Tên Giao Diện </label>
                                            <input type="text" class="form-control" id="name" placeholder="VD: Thiết Kế Shop Bán Nick" required="">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="name"> Mô Tả Giao Diện </label>
                                            <input type="text" class="form-control" id="description" placeholder="Mô Tả Giao Diện" required="">
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="uname"> Ảnh Thumbnail </label>
                                            <input type="text" class="form-control" id="image" placeholder="Link Ảnh" required="">
                                        </div>
<div class="mb-3">
                                            <label class="form-label" for="uname"> Ảnh Mô Tả </label>
                                            <input type="text" class="form-control" id="images" placeholder="Link Ảnh" required="">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Số Tiền </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="price" placeholder="VD: 100000" required="">
                                            </div>
                                        </div>
                                     <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Phí Gia Hạn </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="exprice" placeholder="VD: 100000" required="">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm Gói </button>
                                    </div>

                                </div> 
                            </div> 
                        </div> 
                        
                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Giao Diện </h4>
                                </div>
                                <div class="container">
                                <div class="table-responsive-sm">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th> Tên Giao Diện </th>
                                                    <th> Hình Ảnh </th>
                                                    <th> Giá Bán </th>
                                                    <th> Hành Động </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = $connect->query("SELECT * FROM GiaoDien WHERE category = '".$server['id']."'");
                                                foreach($query as $row){
                                                ?>
                                                
                                                <tr class="table-active">
                                                    <td> <?=($row['name']);?> </td>
                                                    <td> <img src="<?=($row['image']);?>" style="width: 50px;"> </td>
                                                    <td> <?=Price($row['price']);?><sup>đ</sup></td>
                                                    <td> <span onclick="xoaServer(<?=$row['id'];?>)" class="badge bg-pink"> Xóa </span> <span onclick="window.location.href='./edit-product.php?id=<?=$row['id'];?>&theme=<?=$row['category'];?>';" class="badge bg-info"> Chỉnh Sửa </span> </td>
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
                    url: "/administrator/ajaxs/website.php",
                    method: "POST",
                    data: {
                        type: 'add-theme',
                        name: $("#name").val(),
                        description: $("#description").val(),
                        image: $("#image").val(),
                        images: $("#images").val(),
                        price: $("#price").val(),
                        exprice: $("#exprice").val(),
                        id: '<?=$_GET['server'];?>'
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