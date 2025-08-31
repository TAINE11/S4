<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Thêm Máy Chủ </h4>
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
                                <input type="text" class="form-control" id="name" placeholder="Ví Dụ: Việt Nam" required="">
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="uname"> ID Máy Chủ </label>
                                <input type="text" class="form-control" id="uname" placeholder="Ví Dụ: vn, de" required="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Hostname </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="hostname" placeholder="" required="">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> WHM USERNAME </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="whmusername" placeholder="" required="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> WHM PASSWORD </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="whmpassword" placeholder="" required="">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="validationCustom03"> SSL </label>
                                <select class="form-control" id="ssl_key">
                                    <option value="true_ssl"> Miễn Phí Chứng Chỉ SSL </option>
                                    <option value="false_ssl"> Không Có Sẵn </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Backup </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="backup" placeholder="" required="">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="validationCustom03"> NameServer 1 </label>
                                <input type="text" class="form-control" id="nameserver1" placeholder="Ví Dụ: ns1.cyberlux.vn" required="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="validationCustom03"> NameServer 2 </label>
                                <input type="text" class="form-control" id="nameserver2" placeholder="Ví Dụ: ns2.cyberlux.vn" required="">
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="validationCustom03"> IP </label>
                                <input type="text" class="form-control" id="ip" placeholder="Ví Dụ: 66.249.68.66" required="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="validationCustom03"> Ghi Chú </label>
                        <textarea type="text" class="form-control" id="ghichu"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="validationCustom03"> Trạng Thái </label>
                        <select class="form-control" id="value">
                            <option value="on"> Hiển Thị </option>
                            <option value="off"> Ẩn </option>
                        </select>
                    </div>

                    <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm Máy Chủ </button>
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
                        type: 'them',
                        name: $("#name").val(),
                        hostname: $("#hostname").val(),
                        whmusername: $("#whmusername").val(),
                        whmpassword: $("#whmpassword").val(),
                        nameserver1: $("#nameserver1").val(),
                        nameserver2: $("#nameserver2").val(),
                        ip: $("#ip").val(),
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