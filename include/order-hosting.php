<?php include('../app/header.php');
$id = $_GET['id'];
$query = $connect->query("SELECT * FROM HostPackage WHERE id = '$id'")->fetch_array();
$getName = $connect->query("SELECT * FROM Server WHERE uname = '".$query['server']."'")->fetch_array();

if($id != $query['id']){
    echo redirect('/');
}
?>
<title>Thanh Toán Hosting - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
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
          <div class="col-xxl-12">
  <div class="alert alert-danger alert-dismissible fade show" role="alert"
    <b>Lưu ý:</b> Không load lại website khi mua hosting tránh lỗi!
  </div>
</div>

          <div class="row">
            <div class="col-lg-7">
              <div class="card">
                <div class="px-4 py-3 border-bottom">
                  <h6 class="card-title mb-0">Thông Tin Hosting</h6>
                </div>
                <div class="card-body">
                  <div class="mb-4 row align-items-center">
                    <label for="exampleInputText30" class="form-label col-sm-3 col-form-label">Tên Miền Chính</label>
                    <div class="col-sm-9">
                      <div class="input-group border rounded-1">
                        <input type="text" class="form-control border-0" id="domain" placeholder="Nhập tên miền chính">
                      </div>
                    </div>
                  </div>
                  <div class="mb-4 row align-items-center">
                    <label for="exampleInputText3" class="form-label col-sm-3 col-form-label">Email Đăng Ký</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn" value="<?=$getUser['email'];?>">
                    </div>
                  </div>
                  <div class="mb-4 row align-items-center">
                    <label for="exampleInputText1" class="form-label col-sm-3 col-form-label">Hạn Dùng</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="hsd" onchange="checkGia()">
                        <option value="">-- Chọn Hạn Sử Dụng --</option>
                      <option value="1">1 Tháng - <?=Price($query['price'] * 1);?>đ</option>
                      <option value="2">2 Tháng - <?=Price($query['price'] * 2);?>đ</option>
                      <option value="3">3 Tháng - <?=Price($query['price'] * 3);?>đ</option>
                      <option value="4">4 Tháng - <?=Price($query['price'] * 4);?>đ</option>
                      <option value="5">5 Tháng - <?=Price($query['price'] * 5);?>đ</option>
                      <option value="6">6 Tháng - <?=Price($query['price'] * 6);?>đ</option>
                      <option value="7">7 Tháng - <?=Price($query['price'] * 7);?>đ</option>
                      <option value="8">8 Tháng - <?=Price($query['price'] * 8);?>đ</option>
                        </select>
                    </div>
                  </div>
                   <div class="mb-4 row align-items-center">
                    <label for="exampleInputText3" class="form-label col-sm-3 col-form-label">Mã Giảm Giá (Nếu Có)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="coupon" placeholder="Nhập mã giảm giá (Nếu có)">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                      <button onclick="buy()" id="buy" type="button" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center float-end">
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
                          <h6 class="card-title">Hoá Đơn: <span class="text-success"><?=inHoaString($query['package']);?> (<?=$getName['name'];?>)</span>
                          </h6>
                          <p class="card-subtitle">Chuyển tên miền có dấu sang không dấu <a 
class="text-primary" href="https://www.idnconverter.se/">tại đây</a>.</p>
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
        let cloudnix = vndString.replace('₫', ''); 
        document.getElementById("money").innerHTML = cloudnix;
        document.getElementById("totals").innerHTML = cloudnix;
    }
    
    
    function buy(){
        $('#buy').html('Đang xử lý...').prop('disabled', true);
         $.ajax({
                url: "/ajaxs/hosting.php",
                method: "POST",
                data: {
                    type: 'create',
                    domain: $("#domain").val(),
                    hsd: $("#hsd").val(),
                    email: $("#email").val(),
                    coupon: $("#coupon").val(),
                    id: '<?=$id;?>'
                },
                success: function(response) {
    var data = JSON.parse(response);
    
    if(data.status == 'error'){
        swal('Thông Báo', data.message, data.status);
    } else if(data.status == 'success') {
        swal('Thông Báo', data.message, data.status);
        // Redirect to hosting purchase history page
        window.location.href = '/host-manage';
    }
    $('#buy').html('<iconify-icon class="fs-6 me-2" icon="mdi:cart"></iconify-icon>Thanh Toán').prop('disabled', false);
    checkGia();
}
            });
    }
</script>
<?php include('../app/footer.php'); ?>