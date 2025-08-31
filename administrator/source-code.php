<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title"> Quản Lý Source Code </h4>
                                </div>
                               
                            </div>
                        </div>
                        
                        <br>
                        

            
                        <div class="row"> 
                        
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Thêm Source Code </h4>
                                </div>
                                
                                
                                <div class="card-body">
                                    <div class="needs-validation" novalidate="">
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Tên Code </label>
                                            <input type="text" class="form-control" id="name" placeholder="Tên Code">
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Mô Tả </label>
                                            <input type="text" class="form-control" id="description" placeholder="Mô Tả">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Giá Bán </label>
                                            <input type="number" class="form-control" id="price" placeholder="10000">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Link Code </label>
                                            <input type="text" class="form-control" id="linkcode" placeholder="Tên Code">
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Ảnh Thumbnail </label>
                                            <input type="text" class="form-control" id="image" placeholder="Link Ảnh">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01"> Ảnh Mô Tả </label>
                                            <input type="text" class="form-control" id="images" placeholder="Link Ảnh">
                                        </div>
                                        <button class="btn btn-primary" onclick="onclickSubmit()"> Thêm Mã Nguồn </button>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                        
                        
                       <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title"> Danh Sách Mã Nguồn Đang Bán </h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-dark mb-0">
                                            <thead>
                                                <tr>
                                                    <th> Tên Mã Nguồn </th>
                                                    <th> Hình Ảnh </th>
                                                    <th> Giá Bán </th>
                                                    <th> Thao Tác </th>
                                                </tr>
                                            </thead>
                                            <tbody>                    
                                            <?php
                                                $query = $connect->query("SELECT * FROM MaNguon");
                                                foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td> <?=$row['name'];?></td>
                                                    <td> <img src="<?=$row['image'];?>" style="width: 60px"> </td>
                                                    <td> <?=Price($row['price']);?> <sup>đ</sup> </td>
                                                    <td>
                                                        <a href="./edit-source.php?id=<?=$row['id'];?>" class="btn btn-primary"> Chỉnh Sửa </a> <button onclick="delete_data(<?=$row['id'];?>)" class="btn btn-danger"> Xóa </button>
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
                  text: "Bạn có chắc chắn muốn xóa mã nguồn này?",
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
                    url: "/administrator/ajaxs/source-code.php",
                    method: "POST",
                    data: {
                        type: 'add-source',
                        name: $("#name").val(),
                        description: $("#description").val(),
                        image: $("#image").val(),
                        images: $("#images").val(),
                        price: $("#price").val(),
                        linkcode: $("#linkcode").val(),
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
    $inTrue = $connect->query("DELETE FROM `MaNguon` WHERE `id` = '".$_GET['delete_server']."'");
    if($inTrue){
        echo swal('Xoá thành công!','success');
        echo redirect('?');
    } else {
        echo swal('Xoá thất bại!','error');
    }
}
include('layouts/footer.php');
?>