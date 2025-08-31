<?php
include('layouts/header.php');
if(isset($_GET['delete_server'])){
    $check = $connect->query("SELECT * FROM `server_cron_auto` WHERE `id` = '".$_GET['delete_server']."'")->fetch_array();
    
    if($_GET['delete_server'] != $check['id']){
        echo swal('ID Không Hợp Lệ','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `server_cron_auto` WHERE `id` = '".$_GET['delete_server']."'");
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
                                <h4 class="page-title"> Thêm Máy Chủ Cron</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Thông Tin Máy Chủ </h4>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="name"> Tên Máy Chủ </label>
                                <input type="text" class="form-control" id="name" placeholder="" required="">
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="uname"> Giá Thuê </label>
                                <input type="number" class="form-control" id="rate" placeholder="Giá Thuê" required="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label" for="validationCustomUsername"> Số Lượt Thuê Giới Hạn </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="limit" placeholder="Số Lượt Thuê Giới Hạn" required="">
                                </div>
                            </div>

                        </div>
                    </div>


                    <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm Máy Chủ </button>
                </div>
            </div>
        </div>
    </div>
</div>
                <div class="row">
                    
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Server </h4>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-sm table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th> Tên </th>
                                                    <th> Giá  </th>
                                                    <th>Limit</th>
                                                    <th> Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $query = $connect->query("SELECT * FROM `server_cron_auto`");
                                                foreach($query as $row){
                                                    $id+=1;
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$id;?> </td>
                                                    <td> <?=$row['name'];?> </td>
                                                    <td> <?=Price($row['rate']);?> <sup>đ</sup> </td>
                                                    <td><?=$row['limit'];?></td>
                                                    <td> <button onclick="delete_true(<?=$row['id'];?>)" class="btn btn-danger"> Xóa </button> </td>
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
            function ThemMayChu(){
                  $.ajax({
                    url: "/administrator/ajaxs/cron.php",
                    method: "POST",
                    data: {
                        type: 'add-server',
                        name: $("#name").val(),
                        rate: $("#rate").val(),
                        limit: $("#limit").val(),
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
        </script>
                <script>
            function delete_true(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa?",
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