<?php
include('layouts/header.php');
if(isset($_GET['delete_server'])){
    $check = $connect->query("SELECT * FROM `Dots` WHERE `id` = '".$_GET['delete_server']."'")->fetch_array();
    
    if($_GET['delete_server'] != $check['id']){
        echo swal('ID Gói Miền Không Hợp Lệ','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `Dots` WHERE `id` = '".$_GET['delete_server']."'");
        if($inTrue){
            echo swal('Thao tác thành công!','success');
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
                                    <h4 class="page-title"> Quản Lý Đuôi Miền </h4>
                                </div>
                                
                                <a href="./add-dots.php" class="btn btn-primary"><i class="ri-box-3-line"></i> Thêm Đuôi Miền  </a>
                                
                            </div>
                        </div>
                        
                        <br>
                        
                <div class="row">
                    
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Đuôi Miền </h4>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-sm table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th> Đuôi Miền </th>
                                                    <th> Giá Bán </th>
                                                    <th> Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $query = $connect->query("SELECT * FROM `Dots`");
                                                foreach($query as $row){
                                                    $id+=1;
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$id;?> </td>
                                                    <td> .<?=inHoaString($row['dot']);?> </td>
                                                    <td> <?=Price($row['price']);?> <sup>đ</sup> </td>
                                                    <td> <a href="./edit-dots.php?id=<?=$row['id'];?>" class="btn btn-warning"> Chỉnh Sửa </a> <button onclick="delete_true(<?=$row['id'];?>)" class="btn btn-danger"> Xóa </button> </td>
                                                </tr>
                                                
                                                <?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>

                </div> 

            </div>

        </div>
        
        <script>
            function delete_true(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa gói miền này?",
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