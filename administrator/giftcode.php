<?php
include('layouts/header.php');
?>


<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> Mã Giảm Giá </h4>
                    </div>
                </div>
            </div>
                    
                    <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Thêm Mã Giảm Giá </h4>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <div class="row">
                          <div class="col-6">
                                <label class="form-label" for="name"> Gói </label>
                                <select class="form-control" id="service">
                                  <option value="Website">Dịch vụ Website</option>
                                  <option value="Hosting">Dịch vụ Hosting</option>
                                  <option value="Logo">Dịch vụ Logo</option>
                                  </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="name"> Mã </label>
                                <input type="text" class="form-control" id="code" placeholder="Nếu để trống hệ thống tự random mã">
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label" for="name"> Loại Giảm </label>
                                <select class="form-control" id="type" onchange="changMore()">
                                    <option value=""> Vui Lòng Chọn </option>
                                    <option value="money"> Giảm Tiền </option>
                                    <option value="perce"> Giảm Phần Trăm </option>
                                </select>
                            </div>
                            
                            <div id="more_option"></div>
                            <br>
                            
                            <div class="col-12">
                                <label class="form-label" for="name"> Giới Hạn Dùng </label>
                                <input type="text" class="form-control" id="max" placeholder="Tối thiểu 1 lượt">
                            </div>
                            
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm Mã Giảm Giá  </button>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title"> Danh Sách Mã </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-dark mb-0">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Gói </th>
                                    <th> Mã </th>
                                    <th> Mệnh Giá </th>
                                    <th> Đã Dùng / Giới Hạn </th>
                                    <th> Loại Giảm Giá </th>
                                    <th> Thao Tác </th>
                                </tr>
                            </thead>
                            <tbody>                    
                            <?php
                                $query = $connect->query("SELECT * FROM MaGiamGia");
                                foreach($query as $row){
                                    $id+=1;
                                ?>
                                
                                <tr>
                                    <td> #<?=$id;?></td>
                                     <td> <?=$row['service'];?></td>
                                    <td> <?=$row['code'];?></td>
                                    <td> <?php if($row['type'] == 'money'){ echo Price($row['amount']).'<sup>đ</sup>'; } else if($row['type'] == 'perce'){ echo $row['amount'].'%'; }; ?> </td>
                                    <td> <?=$row['sold'];?> / <?=$row['max'];?> </td>
                                    <td> <?php if($row['type'] == 'money'){ echo 'Giảm Tiền'; } else if($row['type'] == 'perce'){ echo 'Phần Trăm'; }; ?> </td>
                                    <td>
                                        <button onclick="delete_data(<?=$row['id'];?>)" class="btn btn-danger"> Xóa </button>
                                    </td>
                                </tr>
                                
                                <?php }  ?>
                                
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
                        
</div>


                </div> 

            </div> 
        </div>
        
        <script>
        
        function changMore(){
            const type = document.getElementById("type").value;
            if(type == 'money'){
                document.getElementById('more_option').innerHTML = `<div class="col-6">
                                <label class="form-label" for="name"> Số Tiền Giảm </label>
                                <input type="text" class="form-control" id="amount" placeholder="VD: 10000">
                            </div>`;
            } else if(type == 'perce'){
                document.getElementById('more_option').innerHTML = `<div class="col-6">
                                <label class="form-label" for="name"> Phần Trăm Giảm </label>
                                <input type="text" class="form-control" id="amount" placeholder="VD: 10">
                            </div>`;
            } else {
                document.getElementById('more_option').innerHTML = '';
            }
        }
        
          function delete_data(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa mã này?",
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
            
            
            function ThemMayChu(){
                  $.ajax({
                    url: "/administrator/ajaxs/magiamgia.php",
                    method: "POST",
                    data: {
                        service: $("#service").val(),
                        code: $("#code").val(),
                        amount: $("#amount").val(),
                        type: $("#type").val(),
                        max: $("#max").val(),
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
        </script>
        
<?php

if(isset($_GET['delete_server'])){
    $inTrue = $connect->query("DELETE FROM `MaGiamGia` WHERE `id` = '".$_GET['delete_server']."'");
    if($inTrue){
        echo swal('Xóa thành công','success');
        echo redirect('?');
    } else {
        echo swal('Xóa thất bại!','error');
    }
}

include('layouts/footer.php');
?>