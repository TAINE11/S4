<?php include('../app/header.php');
$domain = $_SESSION['domain'];
$explode = explode(".", $domain);
$query = $connect->query("SELECT * FROM DomainPackages WHERE name = '".$explode[1]."'")->fetch_array();
if(empty($domain) || $explode[1] != $query['name']){
    echo redirect('/pricing-domain');
}

else if(isDomainRegistered($domain)){
?>
<title>Thanh Toán Tên Miền - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">THANH TOÁN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Thanh Toán
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7">
              <div class="card">
                <div class="px-4 py-3 border-bottom">
                  <h6 class="card-title mb-0">Đăng Ký Tên Miền</h6>
                </div>
                <div class="card-body">
                  <div class="mb-4 row align-items-center">
                    <label for="exampleInputText30" class="form-label col-sm-3 col-form-label">Tên Miền</label>
                    <div class="col-sm-9">
                      <div class="input-group border rounded-1">
                        <input type="text" class="form-control border-0" id="domain" value="<?=$domain;?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="mb-4 row align-items-center">
                    <label for="exampleInputText1" class="form-label col-sm-3 col-form-label">Hạn Đăng Ký</label>
                    <div class="col-sm-9">
              <select class="form-control" id="hsd" onchange="checkGia()">
                  <option value="0"> Vui Lòng Chọn</option>
                  <option value="1"> 1 Năm </option>
                  <option value="3"> 3 Năm </option>
                  <option value="5"> 5 Năm </option>
                  <option value="10"> 10 Năm </option>
              </select>
                    </div>
                  </div>
                   <div class="mb-4 row align-items-center">
                    <label for="exampleInputText3" class="form-label col-sm-3 col-form-label">Nameserver</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="ns" placeholder="Mỗi NS cách nhau bởi dấu (,)">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                      <button onclick="pay()" id="submit" type="button" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center float-end">
                        <iconify-icon class="fs-6 me-2" icon="mdi:cart"></iconify-icon>
                        Thanh Toán
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
                      <div class="card border shadow-none">
                        <div class="card-body p-4">
                          <h6 class="card-title">Hoá Đơn: <span class="text-success"><?=inHoaString($domain);?></span>
                          </h6>
                          <div class="d-flex align-items-center justify-content-between mt-7 mb-3">
                            <div class="d-flex align-items-center gap-3">
                              <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                <iconify-icon class="d-block fs-7" icon="solar:tag-price-bold-duotone"></iconify-icon>
                              </div>
                              <div>
                                <p class="mb-0">Tổng Thanh Toán</p>
                                <h5 class="fs-4 fw-semibold"><strong id="money">0</strong><sup>đ</sup></h5>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center gap-3">
                          </div>
                        </div>
                      </div>
                    </div>
          </div>
        </div>
      </div>
<script>
    function checkGia(){
        const price = <?=$query['price'];?>;
        const hsd = document.getElementById("hsd").value;
        
        let tongtien = price * hsd;
        let vndString = tongtien.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }); 
        let duongcodes = vndString.replace('₫', ''); 
        document.getElementById("money").innerHTML = duongcodes;
    }
    function pay(){
        $('#submit').html('Vui lòng chờ...').prop('disabled', true);
         $.ajax({
                url: "/ajaxs/PayDomain.php",
                method: "POST",
                data: {
                    domain: $("#domain").val(),
                    hsd: $("#hsd").val(),
                    ns: $("#ns").val(),
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    
                    if(data.status == 'error'){
                        swal('Thông Báo', data.message, data.status);
                    } else if(data.status == 'success') {
                        swal('Thông Báo', data.message, data.status);
                    }
                    $('#submit').html('<iconify-icon class="fs-6 me-2" icon="mdi:cart"></iconify-icon>Thanh Toán').prop('disabled', false);
                    checkGia();
                }
            });
    }
</script>
  
  
  
<?php
} else {
    echo swal('Tên Miền Không Thể Đăng Ký','error');
    echo redirect('/pricing-domain');
}
include('../app/footer.php'); ?>