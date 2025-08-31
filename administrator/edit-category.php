<?php
include('layouts/header.php');
$id = $_GET['id'];
$query = $connect->query("SELECT * FROM MauGiaoDien WHERE id = '$id'")->fetch_array();
if(empty($id) || $id != $query['id']){
    echo swal('ID không hợp lệ!','error');
    echo redirect('./website-design.php');
}
?>


<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> Chỉnh Sửa Danh Mục </h4>
                    </div>
                </div>
            </div>
                    
                    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"> Thông Tin Danh Mục </h4>
            </div>

            <div class="card-body">
                <div class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="name"> Tên Danh Mục </label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập Tên Danh Mục" value="<?=$query['name'];?>">
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="uname"> Ảnh </label>
                                <input type="file" id="uploadInput" accept="image/*" class="form-control"><br>
                                <input type="text" id="image" class="form-control" placeholder="Link Ảnh" value="<?=$query['image'];?>">
                                <div id="message"></div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="ThemMayChu()"> Cập Nhật </button>
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
                    url: "/administrator/ajaxs/website.php",
                    method: "POST",
                    data: {
                        type: 'edit-category',
                        name: $("#name").val(),
                        image: $("#image").val(),
                        id: '<?=$query['id'];?>'
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