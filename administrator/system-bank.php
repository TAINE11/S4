<?php
include('layouts/header.php');
if(isset($_GET['delete'])){
    $check = $connect->query("SELECT * FROM `Banks` WHERE `id` = '".$_GET['delete']."'")->fetch_array();
    
    if($_GET['delete'] != $check['id']){
        echo swal('ID không hợp lệ!','error');
    } else {
        $inTrue = $connect->query("DELETE FROM `Banks` WHERE `id` = '".$_GET['delete']."'");
        if($inTrue){
            echo swal('Xóa thành công','success');
            echo redirect('?');
        } else {
            echo swal('Xóa thất bại!','error');
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
                                <h4 class="page-title"> Cài Đặt Ngân Hàng </h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Cài Đặt API Momo </h4>
            </div>
            
            <div class="container">
            <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong> Nguồn Mặc Định - </strong> API Nạp Momo Được Tích Hợp Tại API.DICHVUDARK.VN, Nên Token Và Các Thông Tin Liên Quan Lấy Tại API.DICHVUDARK.VN
                </div>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label" for="name"> Token Momo </label>
                                <input type="text" class="form-control" id="token_momo" placeholder="Token Momo" value="<?=$system['token_momo'];?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12">
                                <strong class="text-dark"> Link Cron: <strong class="text-danger">https://<?=$_SERVER['SERVER_NAME'];?>/api/cron.php</strong></strong>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="ThemMayChu()"> Cập Nhật </button>
                </div>
            </div>
        </div>
    </div>
     </div>
     
     
    <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Thêm Ngân Hàng </h4>
            </div>
            
            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    
                    
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="name"> Tên Ngân Hàng </label>
                                <input type="text" class="form-control" id="name" placeholder="Tên Ngân Hàng">
                            </div>
               
                    
                            <div class="col-6">
                                <label class="form-label" for="name"> Chủ Tài Khoản </label>
                                <input type="text" class="form-control" id="chutaikhoan" placeholder="Chủ Tài Khoản">
                            </div>
               
               
                            <div class="col-6">
                                <label class="form-label" for="name"> Số Tài Khoản </label>
                                <input type="text" class="form-control" id="sotaikhoan" placeholder="Số Tài Khoản">
                            </div>
                    
                            <div class="col-6">
                                <label class="form-label" for="name"> Nạp Tối Thiểu </label>
                                <input type="text" class="form-control" id="toithieu" placeholder="Nạp Tối Thiểu">
                            </div>
                   
                   
                    
                            <div class="col-6">
                               <label class="form-label" for="uname"> Ảnh </label>
                                <input type="file" id="uploadInput" accept="image/*" class="form-control"><br>
                                <div id="message"></div>
                            </div>
                            
                            <div class="col-6">
                               <label class="form-label" for="uname"> Link Ảnh (Nếu Có) </label>
                                <input type="text" id="image" class="form-control" placeholder="Link Ảnh">
                            </div>
                            
                          </div>
                  
                  <br>
                  
                    <button class="btn btn-primary" onclick="ThemBanks()"> Thêm Ngân Hàng </button>
                </div>
            </div>
        </div>
    </div>
</div>

                            
                            <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Ngân Hàng </h4>
                                    <p class="text-muted mb-0">
                                        Hệ Thống Chỉ Tích Hợp Sẵn API Momo, Nếu Cần Thêm Các API Khác Vui Lòng Liên Hệ <a href="https://zalo.me/0961154794" class="text-danger"> Minh Phát </a>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-centered mb-0">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th> Ngân Hàng </th>
                                                    <th> Chủ Tài Khoản / Số Tài Khoản </th>
                                                    <th> Tối Thiểu Nạp </th>
                                                    <th> Hình Ảnh </th>
                                                    <th> Hành Động </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $query = $connect->query("SELECT * FROM Banks ORDER BY id DESC");
                                                foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td> <?=$row['name'];?> </td>
                                                    <td> <?=$row['chutaikhoan'];?> / <?=$row['sotaikhoan'];?></td>
                                                    <td> <?=$row['toithieu'];?> </td>
                                                    <td> <img src="<?=$row['image'];?>" style="width: 40px;"> </td>
                                                    <td> <button onclick="loadBanks(<?=$row['id'];?>)" data-bs-toggle="modal" data-bs-target="#info-header-modal" class="btn btn-primary"> Chi Tiết </button></td>
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


             <div id="info-header-modal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-info">
                                <h4 class="modal-title" id="info-header-modalLabel"> Chi Tiết Ngân Hàng </h4>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="error_response">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="name"> Ngân Hàng </label>
                                    <div class="col-md-9">
                                        <input type="text" id="name_value" class="form-control" placeholder="Tên Ngân Hàng">
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="name"> Chủ Tài Khoản </label>
                                    <div class="col-md-9">
                                        <input type="text" id="chutaikhoan_value" class="form-control" placeholder="Chủ Tài Khoản ">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="name"> Số Tài Khoản </label>
                                    <div class="col-md-9">
                                        <input type="text" id="sotaikhoan_value" class="form-control" placeholder="Số Tài Khoản ">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="name"> Nạp Tối Thiểu </label>
                                    <div class="col-md-9">
                                        <input type="text" id="toithieu_value" class="form-control" placeholder="VD: 10,000đ">
                                    </div>
                                </div>
                            
                            <div class="col-6">
                               <label class="form-label" for="uname"> Link Ảnh </label>
                                <input type="text" id="image_value" class="form-control" placeholder="Link Ảnh">
                            </div>
                                                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Đóng </button>
                                <button type="button" onclick="deletes()" class="btn btn-danger"> Xóa </button>
                                <button type="button" onclick="Update()" class="btn btn-info"> Cập Nhật </button>
                            </div>
                        </div>
                    </div>
                </div>

        <input type="hidden" id="id">
        
        <script>
            function loadBanks(id){
                  $.ajax({
                    url: "/administrator/ajaxs/system.php",
                    method: "POST",
                    data: {
                        type: 'load-atm',
                        id: id
                    },
                    success: function(response) {
                       var data = JSON.parse(response);
                       console.log(response);
                       
                       if(data.status == 'error'){
                           document.getElementById("error_response").innerHTML = '<strong class="text-danger"> ' + data.message + ' </strong>';
                       } else {
                           document.getElementById("name_value").value = data.name;
                           document.getElementById("chutaikhoan_value").value = data.chutaikhoan;
                           document.getElementById("sotaikhoan_value").value = data.sotaikhoan;
                           document.getElementById("toithieu_value").value = data.toithieu;
                           document.getElementById("image_value").value = data.image;
                       }
                    }
                });
                
                document.getElementById("id").value = id;
                
            }
            
            
            function deletes(){
                var id = document.getElementById("id").value;
                
                swal({
                  title: "Xác nhận",
                  text: "Bạn có chắc muốn xóa ngân hàng?",
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
            
             function Update(){
                  $.ajax({
                    url: "/administrator/ajaxs/system.php",
                    method: "POST",
                    data: {
                        type: 'edit-bank',
                        name: $("#name_value").val(),
                        chutaikhoan: $("#chutaikhoan_value").val(),
                        toithieu: $("#toithieu_value").val(),
                        image: $("#image_value").val(),
                        sotaikhoan: $("#sotaikhoan_value").val(),
                        id: $("#id").val(),
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
                

      function ThemMayChu(){
          $.ajax({
            url: "/administrator/ajaxs/system.php",
            method: "POST",
            data: {
                type: 'momo-system',
                token_momo: $("#token_momo").val(),
            },
            success: function(response) {
               $("#msg").html(response);
               console.log(response);
            }
        });
    }
    
    function ThemBanks(){
          $.ajax({
            url: "/administrator/ajaxs/system.php",
            method: "POST",
            data: {
                type: 'add-bank',
                name: $("#name").val(),
                chutaikhoan: $("#chutaikhoan").val(),
                toithieu: $("#toithieu").val(),
                image: $("#image").val(),
                sotaikhoan: $("#sotaikhoan").val(),
            },
            success: function(response) {
               $("#msg").html(response);
               console.log(response);
            }
        });
    }

        
     const uploadInput = document.getElementById('uploadInput');
        const shortenedUrlInput = document.getElementById('image');
     
        uploadInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                
                const clientId = '3352c129079eb4b';
                
                fetch('https://api.imgur.com/3/image', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Client-ID ${clientId}`,
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.data.link) {
                        document.getElementById('message').innerHTML = '<br><p class="text-success"> Ảnh đã được xử lí thành công </p>';
                        shortenedUrlInput.value = data.data.link;
                    }
                })
                
                document.getElementById('message').innerHTML = '<br><b style="color: red;"> Ảnh đang được xử lí, vui lòng chờ </b>';
            }
        });
        
</script>
        
<?php
include('layouts/footer.php');
?>