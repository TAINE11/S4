<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Thêm Đuôi Miền </h4>
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
                                <label class="form-label" for="name"> Đuôi Miền (Ví Dụ: COM, NET <strong class="text-danger">Không cần ghi dấu .</strong>) </label>
                                <input type="text" class="form-control" id="name" placeholder="Ví Dụ: com, net, org" required="">
                            </div>

                           <div class="col-6">
                                <label class="form-label" for="validationCustomUsername"> Giá Bán </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="price" placeholder="Ví Dụ: 10000" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <button class="btn btn-primary" onclick="ThemMayChu()"> Thêm  </button>
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
                        type: 'them',
                        name: $("#name").val(),
                        price: $("#price").val(),
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