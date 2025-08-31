<?php
include('layouts/header.php');
if(empty($_GET['id'])){
    echo swal('ID người dùng không hợp lệ!','error');
    echo redirect('./users.php');
} else {
    $query = $connect->query("SELECT * FROM Users WHERE id = '".$_GET['id']."'")->fetch_array();
    if($_GET['id'] != $query['id']){
        echo swal('ID Không Hợp Lệ','error');
        echo redirect('./users.php');
    }
}
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Chỉnh Sửa Thành Viên</h4>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Nhập Thông Tin </h4>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <div class="row">
                                <div class="col-6">
                                <label class="form-label" for="name"> Tên Người Dùng </label>
                                <input type="text" class="form-control" id="username" placeholder="Tên Người Dùng" value="<?=$query['username'];?>">
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label" for="name"> Email </label>
                                <input type="text" class="form-control" id="email" placeholder="Email" value="<?=$query['email'];?>">
                            </div>
                            
                            
                            <div class="col-6">
                                <label class="form-label" for="name"> Mật Khẩu </label>
                                <div class="form-control" style="background-color: #808080; color: white;"><?=$query['password'];?></div>
                            </div>
                            
                            
                            <div class="col-6">
                                <label class="form-label" for="name"> Số Dư </label>
                                <input type="text" class="form-control" placeholder="VD: 0" value="<?=$query['money'];?>" style="background-color: #808080; color: white;" disabled>
                            </div>
                            
                            
                             <div class="col-6">
                                <label class="form-label" for="name"> Số Dư Đã Tiêu </label>
                                <input type="text" class="form-control" placeholder="VD: 0" value="<?=$query['remoney'];?>" style="background-color: #808080; color: white;" disabled>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="name"> Cấp Bậc </label>
                                <select class="form-control" id="level">
                                    <option value="member" <?php if($query['level'] == ''){ echo 'selected'; } ;?> > Thành Viên </option>
                                    <option value="admin" <?php if($query['level'] == 'admin'){ echo 'selected'; } ;?> > Quản Trị Viên </option>
                                    <option value="ctv" <?php if($query['level'] == 'ctv'){ echo 'selected'; } ;?> > Cộng Tác Viên </option>
                                    <option value="daily" <?php if($query['level'] == 'daily'){ echo 'selected'; } ;?> > Đại Lý </option>
                                    <option value="npp" <?php if($query['level'] == 'npp'){ echo 'selected'; } ;?> > Nhà Phân Phối </option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-primary" onclick="ThemMayChu()"> Cập Nhật </button>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title"> Biến Đổi Số Dư </h4>
                </div>
                
                <div class="container">
                <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong> Chú ý - </strong> khi bạn thay đổi số dư thì chủ tài khoản cũng có thể xem thay đổi tại nhật ký hoạt động
                    </div></div>
                    
                <div class="card-body">
                    <div class="needs-validation" novalidate="">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name"> Loại Biến Đổi </label>
                                    <select class="form-control" id="type_ac">
                                        <option value="cong"> Cộng Tiền </option>
                                        <option value="tru"> Trừ Tiền </option>
                                    </select>
                                </div>
    
                                <div class="col-6">
                                    <label class="form-label" for="name"> Số Tiền </label>
                                    <input class="form-control" id="money" value="0">
                                </div>
                            </div>
                        </div>
    
    
                        <button class="btn btn-danger" onclick="seletOption()"> Biến Đổi </button>
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
                        url: "/administrator/ajaxs/users.php",
                        method: "POST",
                        data: {
                            type: 'edit-users',
                            name: $("#name").val(),
                            username: $("#username").val(),
                            email: $("#email").val(),
                            level: $("#level").val(),
                            id: '<?=$query['id'];?>',
                        },
                        success: function(response) {
                           $("#msg").html(response);
                           console.log(response);
                        }
                    });
                }
                
                function seletOption(){
                      $.ajax({
                        url: "/administrator/ajaxs/users.php",
                        method: "POST",
                        data: {
                            type: 'edit-money',
                            money: $("#money").val(),
                            type_ac: $("#type_ac").val(),
                            id: '<?=$query['id'];?>',
                            username: '<?=$query['username'];?>'
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