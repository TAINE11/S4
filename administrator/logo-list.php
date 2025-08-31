<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Logo Đã Bán </h4>
                            </div>
                        </div>
                    </div>
                    
                   <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Người Mua </th>
                                                    <th> Tên Logo </th>
                                                    <th> Mẫu Logo </th>
                                                    <th> Ảnh Mẫu Logo </th>
                                                    <th> Thời Gian Mua </th>
                                                    <th> Trạng Thái </th>
                                                    <th> Hành Động </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                    $query = $connect->query("SELECT * FROM DanhSachLogo");
                                                    foreach($query as $row){
                                                        $theme = $connect->query("SELECT * FROM Logo WHERE id = '".$row['theme']."'")->fetch_array();
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['username'];?></td>
                                                    <td><?=$row['name'];?></td>
                                                    <td><?=$theme['name'];?></td>
                                                    <td> <img src="<?=$theme['image'];?> " width="80px"></td>
                                                    <td><?=ToTime($row['time']);?></td>
                                                    <td><?=StatusLogo($row['status']);?></td>
                                                    <td> <a onclick="load(<?=$row['id'];?>)" data-bs-toggle="modal" data-bs-target="#info-header-modal" class="btn btn-info"> Chi Tiết </a> </td>
                                                </tr>
            
                                            <?php } ?>
                                            
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
        
        
        <?php
        if(isset($_POST['id2'])){
        ?>
        
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                load(<?=$_POST['id2'];?>);
            });
            
            $(document).ready(function(){
                $("#info-header-modal").modal('show');
            });
        </script>
        
        <?php } ?>
        
        <div id="info-header-modal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-info">
                                <h4 class="modal-title" id="info-header-modalLabel"> Chi Tiết Đơn Hàng </h4>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="error_response">
                                <div class="form-control"> Tên Logo: <strong class="text-info" id="name"></strong></div><br>
                                <div class="form-control"> Mẫu Logo: <strong class="text-dark" id="theme"></strong></div><br>
                                
                                <img id="image" width="100%"><br><br>
                                
                                <div class="row">
                                <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Cập Nhật Trạng Thái </label>
                                <div class="input-group">
                                    <select class="form-control" id="status_select">
                                        
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Link Download </label>
                                <div class="input-group">
                                    <input id="link" class="form-control" placeholder="Link tải Logoo">
                                </div>
                            </div>
                            </div>
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Đóng </button>
                                <button type="button" onclick="delete_hehe()" class="btn btn-danger">  Xóa Trang  </button>
                                <button type="button" onclick="Update()" class="btn btn-info"> Cập Nhật </button>
                            </div>
                        </div>
                    </div>
                </div>

        
        <script>
            function load(id){
                document.getElementById("id").value = id;
                
                  $.ajax({
                    url: "/administrator/ajaxs/logo-design.php",
                    method: "POST",
                    data: {
                        type: 'load-info',
                        id: id,
                    },
                    success: function(response) {
                       var data = JSON.parse(response);
                       
                       if(data.status == 'error'){
                           document.getElementById("error_response").innerHTML = '<strong class="text-danger"> ' + data.message + ' </strong>';
                       } else {
                          
                            if (data.dmmm == 0) {
                              document.getElementById("status_select").innerHTML = `
                              <option value="0" selected> Đang Xử Lí </option>
                                           <option value="1"> Hoàn Thành </option>
                                           <option value="4"> Hủy </option>`;
                            } else if (data.dmmm == 1) {
                              document.getElementById("status_select").innerHTML = `
                                            <option value="0"> Đang Xử Lí </option>
                                            <option value="1" selected> Hoàn Thành </option>
                                            <option value="2"> Hủy </option>`;
                            } else if (data.dmmm == 2) {
                              document.getElementById("status_select").innerHTML = `
                                           <option value="0"> Đang Xử Lí </option>
                                           <option value="1" > Hoàn Thành </option>
                                           <option value="2" selected> Hủy </option>`;
                            } else {
                               document.getElementById("status_select").innerHTML =  `<option disabled> Không thể tải dữ liệu </option>`;
                            }
                            
                            
                           document.getElementById("name").innerHTML = data.name;
                           document.getElementById("theme").innerHTML = data.name_theme;
                           document.getElementById("link").value = data.link;
                           document.getElementById("image").src = data.image_theme;
                           
                           console.log(response);
                       }
                    }
                });
            }
            
            function Update(id){
                  $.ajax({
                    url: "/administrator/ajaxs/logo-design.php",
                    method: "POST",
                    data: {
                        type: 'update-logo',
                        id: $("#id").val(),
                        link: $("#link").val(),
                        status: $("#status_select").val(),
                    },
                    success: function(response) {
                        $("#msg").html(response);
                        console.log(response);
                    }
                });
            }
            
            
            function delete_hehe(){
                var id = document.getElementById("id").value;
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa dịch vụ này?",
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
        
        <input type="hidden" id="id"><input type="hidden" id="name"><input type="hidden" id="username2">
<?php

if(isset($_GET['delete_server'])){
    $inTrue = $connect->query("DELETE FROM `DanhSachLogo` WHERE `id` = '".$_GET['delete_server']."'");
    if($inTrue){
        $connect->query("DELETE FROM `DanhSachLogo` WHERE `id` = '".$check['id']."'");
        echo swal('Xóa thành công','success');
        echo redirect('?');
    } else {
        echo swal('Không thể xóa!','error');
    }
}
include('layouts/footer.php');
?>