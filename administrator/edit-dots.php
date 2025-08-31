<?php
include('layouts/header.php');
if(empty($_GET['id'])){
    echo swal('ID Gói Miền Không Hợp Lệ','error');
    echo redirect('./dots.php');
} else {
    $query = $connect->query("SELECT * FROM Dots WHERE id = '".$_GET['id']."'")->fetch_array();
    if($_GET['id'] != $query['id']){
        echo swal('ID Gói Miền Không Hợp Lệ','error');
        echo redirect('./dots.php');
    }
}
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Chỉnh Sửa Đuôi Miền </h4>
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
                                <label class="form-label" for="name"> Đuôi Miền (Ví Dụ: COM, NET <strong class="text-danger">Không cần ghi dấu .</strong>) </label>
                                <input type="text" class="form-control" id="name" placeholder="Ví Dụ: com, net, org" required="" value="<?=$query['dot'];?>">
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Giá Bán </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="price" placeholder="Ví Dụ: 10000" required="" value="<?=$query['price'];?>">
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
                    url: "/administrator/ajaxs/dots.php",
                    method: "POST",
                    data: {
                        type: 'edit',
                        name: $("#name").val(),
                        price: $("#price").val(),
                        id: '<?=$query['id'];?>'
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