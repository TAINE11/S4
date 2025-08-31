<?php
include('layouts/header.php');
$id = $_GET['id'];
$query = $connect->query("SELECT * FROM Server WHERE id = '$id'")->fetch_array();
if(empty($id) || $id != $query['id']){
    echo swal('ID Máy Chủ Không Hợp Lệ','error');
    echo redirect('./server.php');
}
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Chỉnh Sửa Máy Chủ </h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Thông Tin Máy Chủ </h4>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="name"> Tên Máy Chủ </label>
                                <input type="text" class="form-control" id="name" placeholder="Ví Dụ: Việt Nam" required="" value="<?=$query['name'];?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="uname"> ID Máy Chủ </label>
                                <input type="text" class="form-control" id="uname" placeholder="Ví Dụ: vn, de" required="" value="<?=$query['uname'];?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustomUsername"> Hostname </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="hostname" placeholder="" required="" value="<?=$query['hostname'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustomUsername"> WHM USERNAME </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="whmusername" placeholder="" required="" value="<?=$query['whmusername'];?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustomUsername"> WHM PASSWORD </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="whmpassword" placeholder="" required="" value="<?=$query['whmpassword'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03"> SSL </label>
                                <select class="form-control" id="ssl_key"> 
                                    <option value="true_ssl" <?php if($query['ssl_key'] == 'true_ssl'){ echo 'selected'; } ?>> Miễn Phí Chứng Chỉ SSL </option>
                                    <option value="false_ssl" <?php if($query['ssl_key'] == 'false_ssl'){ echo 'selected'; } ?>> Không Có Sẵn </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustomUsername"> Backup </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="backup" placeholder="" required="" value="<?=$query['backup'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03"> NameServer 1 </label>
                                <input type="text" class="form-control" id="nameserver1" placeholder="Ví Dụ: ns1.cyberlux.vn" required="" value="<?=$query['nameserver1'];?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03"> NameServer 2 </label>
                                <input type="text" class="form-control" id="nameserver2" placeholder="Ví Dụ: ns2.cyberlux.vn" required="" value="<?=$query['nameserver2'];?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class "form-label" for="validationCustom03"> IP </label>
                                <input type="text" class="form-control" id="ip" placeholder="Ví Dụ: 66.249.68.66" required="" value="<?=$query['ip'];?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03"> Ghi Chú </label>
                                <textarea  type="text" class="form-control" id="ghichu" rows="4"><?=$query['ghichu'];?></textarea >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03"> Trạng Thái </label>
                                <select class="form-control" id="value">
                                    <option value="on" <?php if($query['value'] == 'on') { echo 'selected'; } ;?>> Hiển Thị </option>
                                    <option value="off" <?php if($query['value'] == 'off') { echo 'selected'; } ;?>> Ẩn </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <!-- Empty column for spacing -->
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary" onclick="ThemMayChu()"> Cập Nhật Máy Chủ </button>
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
                    url: "/administrator/ajaxs/server.php",
                    method: "POST",
                    data: {
                        type: 'edit',
                        id: '<?=$query['id'];?>',
                        hostname: $("#hostname").val(),
                        name: $("#name").val(),
                        whmusername: $("#whmusername").val(),
                        whmpassword: $("#whmpassword").val(),
                        nameserver1: $("#nameserver1").val(),
                        nameserver2: $("#nameserver2").val(),
                        ip: $("#ip").val(),
                        value: $("#value").val(),
                        ghichu: $("#ghichu").val(),
                        backup: $("#backup").val(),
                        ssl_key: $("#ssl_key").val(),
                        uname: $("#uname").val(),
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