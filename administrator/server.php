<?php
include('layouts/header.php');
if(isset($_GET['delete_server'])){
    $check = $connect->query("SELECT * FROM `Server` WHERE `id` = '".$_GET['delete_server']."'")->fetch_array();
    
    if($_GET['delete_server'] != $check['id']){
        echo swal('ID Máy Chủ Không Hợp Lệ','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `Server` WHERE `id` = '".$_GET['delete_server']."'");
        $connect->query("DELETE FROM `HostPackage` WHERE `server` = '".$check['server']."'");
        if($inTrue){
            $connect->query("DELETE FROM `HostPackage` WHERE `server` = '".$check['server']."'");
            echo swal('Đã xóa máy chủ & Các gói','success');
            echo redirect('?');
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
                                    <h4 class="page-title"> Quản Lý Máy Chủ </h4>
                                </div>
                                
                                <a href="./add-server.php" class="btn btn-primary"><i class="ri-box-3-line"></i> Thêm Máy Chủ  </a>
                                
                            </div>
                        </div>
                        
                        <br>
                        

            
            <div class="row"> 
                    <?php
                    $query = $connect->query("SELECT * FROM Server ORDER BY id DESC");
                    foreach($query as $row){
                    ?>
                    
                        <div class="col-xl-4 col-sm-12 ">
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    <div class="card-widgets">
                                        <a href="./edit-server.php?id=<?=$row['id'];?>"><i class=" ri-file-edit-fill"></i></a>
                                        <a href="./add-package.php?server=<?=$row['uname'];?>"><i class="ri-add-line"></i></a>
                                        <a onclick="xoaServer(<?=$row['id'];?>)"><i class="ri-close-line"></i></a>
                                    </div>
                                    <h5 class="card-title mb-0"> Máy Chủ: <?=$row['name'];?> </h5> <p class="card-title mb-0 text-<?php if($row['value'] == 'on') { echo 'primary'; } else { echo 'danger'; } ?>"> Trạng Thái: <?=inHoaString($row['value']);?> </p>
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