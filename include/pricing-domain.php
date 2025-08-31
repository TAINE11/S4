<?php include('../app/header.php'); ?>
<?php
if(isset($_POST['domain'])){
    ?>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
          whoiGet();
        });
    </script>
    
    <?php
}
?>
	<title>Bảng Giá Miền - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
	<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">TÊN MIỀN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Domain
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <!-- row -->
          <div class="row">
            <div class="col-12">
              <!-- start Event Registration -->
              <div class="card">
               
                  <div class="card-body">
                    <h5 class="card-title">Kiểm Tra Miền</h5>
                    
                  </div>
                  <div class="card-body border-top">
                    <div class="row">
                      <div class="col-12">
                        <div class="mb-3">
                          <label for="fname3" class="form-label">Tên Miền</label>
                          <input type="text" class="form-control" id="domain" value="<?=$_POST['domain'];?>" placeholder="Nhập tên miền muốn mua">
                        </div>
                      </div>
                      
                  <div class="p-3">
                    <div class="d-flex flex-wrap gap-6 align-items-center">
                      <div class="ms-auto d-flex flex-wrap gap-6 align-items-center">
                        <div class="btn-group">
                          <button id="WhoisDomain" onclick="whoiGet()" class="btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                            <iconify-icon icon="solar:card-2-bold-duotone" class="fs-4 me-2"></iconify-icon>
                            Kiểm Tra
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                
              </div>
              <!-- end Event Registration -->
            </div>
          </div>
          </div>
          </div>
           <div class="block block-rounded" id="result-domain">
  </div>
 <div class="row" id="pricingdomain">
            <div class="col-12">
            
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-2 align-items-center">
                <div>
                  <h5>Bảng Giá</h5>
                </div>
              </div>
              <div class="table-responsive rounded-1">
                <table class="col-12 table text-nowrap customize-table mb-0 align-middle">
                  <thead class="text-dark">
                    <tr>
                      <th></th>
                      <th>Đuôi Miền</th>
                      <th>Giá</th>
                      
                    </tr>
                  </thead>
                  <tbody>
<?php
$query = $connect->query("SELECT * FROM DomainPackages");
      foreach($query as $row){
             ?>
                    <tr>
                      <td><img src="<?=$row['image'];?>" width="70px"></td>
                      <td>Tên Miền .<?=inHoaString($row['name']);?></td>
                      <td><?=Price($row['price']);?>đ</td>
                      
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
       <script>
      function whoiGet(){
          $('#WhoisDomain').html('Vui lòng chờ...').prop('disabled', true);
           $.ajax({
                url: "/ajaxs/WhoiDomain.php",
                method: "POST",
                data: {
                    domain: $("#domain").val()
                },
                success: function(response) {
                    document.getElementById('result-domain').innerHTML = `          
                    <div class="row">
            <div class="col-12">
            
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-2 align-items-center">
                <div>
                  <h5>Kết Quả</h5>
                </div>
              </div>
              <div class="table-responsive rounded-1">
                <table class="col-12 table text-nowrap customize-table mb-0 align-middle">
                  <thead class="text-dark">
                    <tr>
                      <th>Trạng Thái</th>
                      <th>Miền</th>
                      <th>Giá</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody id="listdomain"></tbody>
                </table>
              </div>
            </div>
          </div>
            </div>
          </div>
                        `;
                        
                        $("#listdomain").html(response);
                        $("#pricingdomain").html('');
                        
                    $('#WhoisDomain').html('<i class="fa fa-fw opacity-50 fa-search"></i> Kiểm tra').prop('disabled', false);
                }
            });
      }
  </script>
<?php include('../app/footer.php'); ?>