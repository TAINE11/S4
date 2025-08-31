<?php
include('layouts/header.php');
if(isset($_GET['delete_server'])){
    $check = $connect->query("SELECT * FROM `MauGiaoDien` WHERE `id` = '".$_GET['delete_server']."'")->fetch_array();
    
    if($_GET['delete_server'] != $check['id']){
        echo swal('ID Máy Chủ Không Hợp Lệ','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `MauGiaoDien` WHERE `id` = '".$_GET['delete_server']."'");
        if($inTrue){
            $connect->query("DELETE FROM `MauGiaoDien` WHERE `danhmuc` = '".$check['id']."'");
            echo swal('Xóa thành công','success');
            echo redirect('?');
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
                                    <h4 class="page-title"> Danh Mục Thiết Kế Web </h4>
                                </div>
                                
                                <a href="./add-category.php" class="btn btn-primary"><i class="ri-box-3-line"></i> Thêm Danh Mục  </a>
                                
                            </div>
                        </div>
                        
                        <br>
                        

            
            <div class="row"> 
                    <?php
                    $query = $connect->query("SELECT * FROM MauGiaoDien ORDER BY id DESC");
                    foreach($query as $row){
                    ?>
                    
                        <div class="col-xl-4 col-sm-6 ">
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    <div class="card-widgets">
                                        <a href="./edit-category.php?id=<?=$row['id'];?>"><i class=" ri-file-edit-fill"></i></a>
                                        <a href="./add-product.php?server=<?=$row['id'];?>"><i class="ri-add-line"></i></a>
                                        <a onclick="xoaServer(<?=$row['id'];?>)"><i class="ri-close-line"></i></a>
                                    </div>
                                    <h4 class="card-title mb-0"> Danh Mục: <?=$row['name'];?> </h4> 
                                    <br>
                                    <img src="<?=$row['image'];?>" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>


                    </div>
                    
                    
                    
                </div> 

            </div>

        </div>
        
        <script>
            function xoaServer(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa danh mục này?",
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