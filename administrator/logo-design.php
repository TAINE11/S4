<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title"> Quản Lý Logo </h4>
                                </div>
                               
                            </div>
                        </div>
                        
                        <br>
                        

            
                        <div class="row"> 
                        
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Thêm Mẫu Logo </h4>
                                </div>
                                
                                
                                <div class="card-body">
                                    <div class="needs-validation" novalidate="">
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Tên Logo </label>
                                            <input type="text" class="form-control" id="name" placeholder="Tên Logo">
                                        </div>
                                        
                                        
                                        
                                        <div class="mb-3">
		                      <label class="form-label" for="uname"> Ảnh </label>
		                      <input type="file" id="uploadInput" accept="image/*" class="form-control">
		                      <br>
		                      <input type="text" id="image" class="form-control" placeholder="Link Ảnh">
		                      <div id="message"></div>
		                    </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Giá Tiền </label>
                                            <input type="text" class="form-control" id="price" placeholder="Giá Tiền">
                                        </div>
                                        <button class="btn btn-primary" onclick="onclickSubmit()"> Thêm Mẫu </button>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                        
                        
                       <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Mẫu Logo </h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-dark mb-0">
                                            <thead>
                                                <tr>
                                                    <th> Tên Mẫu </th>
                                                    <th> Hình Ảnh </th>
                                                    <th> Giá Bán </th>
                                                    <th> Thao Tác </th>
                                                </tr>
                                            </thead>
                                            <tbody>                    
                                            <?php
                                                $query = $connect->query("SELECT * FROM Logo");
                                                foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td> <?=$row['name'];?></td>
                                                    <td> <img src="<?=$row['image'];?>" style="width: 60px"> </td>
                                                    <td> <?=pRICE($row['price']);?> <sup>đ</sup> </td>
                                                    <td>
                                                        <a href="./edit-logo.php?id=<?=$row['id'];?>" class="btn btn-primary"> Chỉnh Sửa </a> <button onclick="delete_data(<?=$row['id'];?>)" class="btn btn-danger"> Xóa </button>
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
            function delete_data(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa mẫu logo này?",
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
            
            function onclickSubmit(){
                  $.ajax({
                    url: "/administrator/ajaxs/logo-design.php",
                    method: "POST",
                    data: {
                        type: 'add-logo',
                        name: $("#name").val(),
                        image: $("#image").val(),
                        price: $("#price").val(),
                    },
                    success: function(response) {
                       $("#msg").html(response);
                       console.log(response);
                    }
                });
            }
            const uploadInput = document.getElementById('uploadInput');
  const shortenedUrlInput = document.getElementById('image');
  uploadInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const formData = new FormData();
      formData.append('image', file);
      const clientId = '815cf287c84b97c';
      fetch('https://api.imgur.com/3/image', {
        method: 'POST',
        headers: {
          'Authorization': `Client-ID ${clientId}`,
        },
        body: formData,
      }).then(response => response.json()).then(data => {
        if (data.data.link) {
          document.getElementById('message').innerHTML = '<br><p class="text-success"> Ảnh đã được xử lí thành công </p>';
          shortenedUrlInput.value = data.data.link;
        }
      })
      document.getElementById('message').innerHTML = '<br><b style="color:red;"> Ảnh đang được xử lí, vui lòng chờ </b>';
    }
  });
        </script>
        
        
        
<?php
if(isset($_GET['delete_server'])){
    $inTrue = $connect->query("DELETE FROM `Logo` WHERE `id` = '".$_GET['delete_server']."'");
    if($inTrue){
        echo swal('Xoá thành công!','success');
        echo redirect('?');
    } else {
        echo swal('Xoá thất bại!','error');
    }
}
include('layouts/footer.php');
?>