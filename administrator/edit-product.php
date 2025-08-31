<?php
include('layouts/header.php');
$danhmuc = $connect->query("SELECT * FROM MauGiaoDien WHERE id = '".$_GET['theme']."'")->fetch_array();
$theme = $connect->query("SELECT * FROM GiaoDien WHERE id = '".$_GET['id']."'")->fetch_array();

if(isset($_GET['delete_server'])){
    $check = $connect->query("SELECT * FROM `GiaoDien` WHERE `id` = '".$_GET['delete_server']."'")->fetch_array();
    
    if($_GET['delete_server'] != $check['id']){
        echo swal('ID không hợp lệ!','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `GiaoDien` WHERE `id` = '".$_GET['delete_server']."'");
        if($inTrue){
            echo swal('Xoá thành công','success');
            echo redirect('./website-design.php');
        } else {
            echo swal('Không thể xóa!','error');
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
                                <h4 class="page-title"> Chỉnh Sửa Giao Diện (<?=inHoaString($theme['name']);?>) </h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Chỉnh Sửa Giao Diện </h4>
                                </div>
                                
                                <div class="card-body">
                                    <div class="needs-validation" novalidate="">
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="name"> Tên Giao Diện </label>
                                            <input type="text" class="form-control" id="name" placeholder="VD: Thiết Kế Shop Bán Nick" value="<?=$theme['name'];?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="name"> Mô Tả Giao Diện </label>
                                            <input type="text" class="form-control" id="description" placeholder="Mô Tả Giao Diện" value="<?=$theme['description'];?>">
                                        </div>
                                                         
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="uname"> Ảnh Thumbnail </label>
                                            <input type="text" class="form-control" id="image" placeholder="Link Ảnh" value="<?=$theme['image'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="uname"> Ảnh Mô Tả </label>
                                            <input type="text" class="form-control" id="images" placeholder="Link Ảnh" value="<?=$theme['images'];?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Số Tiền </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="price" placeholder="VD: 100000" value="<?=$theme['price'];?>">
                                            </div>
                                        </div>
                                                                <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Phí Gia Hạn </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="exprice" placeholder="VD: 100000" value="<?=$theme['exprice'];?>">
                                            </div>
                                        </div>             
                                             <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername"> Lượt Tạo </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="sold" placeholder="VD: 100" value="<?=$theme['sold'];?>">
                                            </div>
                                        </div>             
                                        <button class="btn btn-primary" onclick="ThemMayChu()"> Chỉnh Sửa </button>
                                    </div>

                                </div> 
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
                        type: 'edit-theme',
                        name: $("#name").val(),
                        description: $("#description").val(),
                        image: $("#image").val(),
                        images: $("#images").val(),
                        price: $("#price").val(),
                        exprice: $("#exprice").val(),
                        sold: $("#sold").val(),
                        id: '<?=$_GET['id'];?>'
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
        </script>
        
<?php
include('layouts/footer.php');
?>