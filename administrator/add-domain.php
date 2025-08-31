<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Thêm Gói Miền </h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Nhập Thông Tin </h4>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="name"> Đuôi Miền (Vú Dụ: COM, NET <strong class="text-danger">Không cần ghi dấu .</strong>) </label>
                                <input type="text" class="form-control" id="name" placeholder="Ví Dụ: com, net, org" required="">
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="uname"> Ảnh </label>
                                <input type="file" id="uploadInput" accept="image/*" class="form-control"><br>
                                <input type="text" id="image" class="form-control" placeholder="Link Ảnh">
                                <div id="message"></div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Giá Bán </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="price" placeholder="Ví Dụ: 10000" required="">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Trạng Thái </label>
                                <div class="input-group">
                                    <select class="form-control" id="value">
                                        <option value="on"> Hiển Thị </option>
                                        <option value="off"> Ẩn </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm Gói Miền </button>
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
                    url: "/administrator/ajaxs/domain.php",
                    method: "POST",
                    data: {
                        type: 'them',
                        name: $("#name").val(),
                        price: $("#price").val(),
                        image: $("#image").val(),
                        value: $("#value").val(),
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