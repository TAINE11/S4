<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Thành Viên </h4>
                                </div>
                        </div>
                    </div>
                    
                   <div class="row">
                        
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Thành Viên </h4>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered border-primary table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th> UID </th>
                                                    <th> Tên Người Dùng / Email </th>
                                                    <th> Số Dư </th>
                                                    <th> Thời Gian Đăng Ký </th>
                                                    <th> Cấp Bậc </th>
                                                    <th> Truy Cập </th>
                                                    <th class="text-center"> Thao Tác </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $query = $connect->query("SELECT * FROM Users ");
                                                foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td class="table-user">
                                                        <?=$row['id'];?>
                                                    </td>
                                                    <td> <?=$row['username'];?> / <?=$row['email'];?> </td>
                                                    <td> <?=Price($row['money']);?><sup>đ</sup></td>
                                                    <td> <?=ToTime($row['time']);?> </td>
                                                    <td> <?=$row['level'];?> </td>
                                                    
                                                    <?php if(time() - $row['date_online'] >= 60){
                                                                $adminoff = $adminoff + 1;
                                                            ?>
                                                                <td><button class="btn btn-dark"><?=distanceTime($row['date_online']);?></button></td>
                                                            <?php } else { 
                                                                $adminonline = $adminonline + 1;
                                                            ?>    
                                                                <td><button class="btn btn-success"> Hoạt Động </button></td>
                                                            <?php } ?>
                                                            
                                                    <td class="text-center">
                                                        <a onclick="XoaUsers(<?=$row['id'];?>)" class="text-reset fs-16 px-1"> <i class="text-danger ri-delete-bin-2-line"></i></a>
                                                        <a href="./edit-user.php?id=<?=$row['id'];?>" class="text-reset fs-16 px-1"> <i class="text-primary ri-edit-fill"></i></a>
                                                    </td>
                                                </tr>
                                               
                                               <?php
                                                }
                                               ?>
                                               
                                            </tbody>
                                        </table>
                                    </div>

                                </div> 
                            </div> 
                        </div>
                     
                    </div>
                    
                    
                </div> 

            </div> 
        </div>
        
       <script>
            function XoaUsers(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa người dùng này?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location.href="?delete=" + id;
                  }
                });
            }
        </script>
        
<?php
if(isset($_GET['delete'])){
    $inTrue = $connect->query("DELETE FROM `Users` WHERE `id` = '".$_GET['delete']."'");
    if($inTrue){
        echo swal('Xóa thành công','success');
        echo redirect('?');
    } else {
        echo swal('Xóa thất bại!','error');
    }
}
include('layouts/footer.php');
?>