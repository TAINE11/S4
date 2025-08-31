<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Danh Sách Tên Miền </h4>
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
                                                    <th> Tên Miền </th>
                                                    <th> DNS </th>
                                                    <th> Thời Gian Mua </th>
                                                    <th> Thời Gian Hết Hạn </th>
                                                    <th> Trạng Thái </th>
                                                    <th> Hành Động </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                if(isset($_GET['type'])){
                                                    $query = $connect->query("SELECT * FROM Domain WHERE status = '".$_GET['type']."'");
                                                } else {
                                                    $query = $connect->query("SELECT * FROM Domain");
                                                }
                                                    
                                                    foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['username'];?></td>
                                                    <td><a href="//<?=$row['domain'];?>"><?=$row['domain'];?></a></td>
                                                    <td><?=$row['ns'];?></td>
                                                    <td><?=ToTime($row['time']);?></td>
                                                    <td><?=ToTime($row['overtime']);?></td>
                                                    <td><?=StatusDomain($row['status']);?></td>
                                                    <td> <a onclick="loadDomain(<?=$row['id'];?>)" data-bs-toggle="modal" data-bs-target="#info-header-modal" class="btn btn-info"> Chi Tiết </a> </td>
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
        
        
        <div id="info-header-modal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-info">
                                <h4 class="modal-title" id="info-header-modalLabel"> Chi Tiết Tên Miền </h4>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="error_response">
                                <div class="form-control"> Tên Miền: <strong class="text-info" id="domain"></strong></div><br>
                                <div class="form-control"> Hạn Sử Dụng: <strong class="text-dark" id="hsd"></strong></div><br>
                                <div class="form-control"> Chủ Sở Hữu: <strong class="text-dark" id="username"></strong></div><br>
                                <div class="form-control"> DNS: <strong class="text-dark" id="dns"></strong></div><br>
                                <div class="form-control"> Ngày Mua / Ngày Hết Hạn: <strong class="text-dark" id="time"></strong></div><br>
                                <div class="form-control"> Trạng Thái: <strong class="text-dark" id="status_btn"></strong></div><br>
                                
                                <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Cập Nhật Trạng Thái </label>
                                <div class="input-group">
                                    <select class="form-control" id="update_status">
                                        <option value="0"> Đang Xử Lí </option>
                                        <option value="1"> Hoàn Thành </option>
                                        <option value="2"> Hết Hạn </option>
                                        <option value="3"> Bị Hủy </option>
                                        <option value="4"> Hủy & Hoàn Tiền </option> 
                                    </select>
                                </div>
                            </div>
                            
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Đóng </button>
                                <button type="button" onclick="Update_Domain()" class="btn btn-info"> Cập Nhật </button>
                            </div>
                        </div>
                    </div>
                </div>

        
        <script>
            function loadDomain(id){
                  $.ajax({
                    url: "/administrator/ajaxs/domain.php",
                    method: "POST",
                    data: {
                        type: 'loadDomain',
                        id: id
                    },
                    success: function(response) {
                       var data = JSON.parse(response);
                       
                       if(data.status == 'error'){
                           document.getElementById("error_response").innerHTML = '<strong class="text-danger"> ' + data.message + ' </strong>';
                       } else {
                           document.getElementById("domain").innerHTML = data.domain;
                           document.getElementById("hsd").innerHTML = data.hsd;
                           document.getElementById("username").innerHTML = data.username;
                           document.getElementById("dns").innerHTML = data.dns;
                           document.getElementById("time").innerHTML = data.time;
                           document.getElementById("status_btn").innerHTML = data.status_btn;
                           document.getElementById("username2").value = data.username;
                       }
                       
                       document.getElementById("id").value = id;
                       document.getElementById("name").value = data.name;
                       console.log(response);
                    }
                });
            }
            
            function Update_Domain(id){
                  $.ajax({
                    url: "/administrator/ajaxs/domain.php",
                    method: "POST",
                    data: {
                        type: 'update_domain',
                        update_status: $("#update_status").val(),
                        id: $("#id").val(),
                        name: $("#name").val(),
                        username2: $("#username2").val(),
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
        </script>
        
        <input type="hidden" id="id"><input type="hidden" id="name"><input type="hidden" id="username2">
<?php
include('layouts/footer.php');
?>