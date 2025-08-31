<?php include('../app/header.php');
checkSession();
// Truy vấn dữ liệu
$sql = "SELECT * FROM Withdrawal_history";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Truy vấn không thành công: " . mysqli_error($connect));
}

// Đặt giá trị sản phẩm
$product_price = 100000; // Giá sản phẩm
$commission = ($affiliate / 100) * $product_price; // Tính hoa hồng

?>
<title>Tiếp Thị Liên Kết - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-sm-0 card-title">Tiếp Thị Liên Kết</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="/">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Affiliates
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
            <i class="ti ti-user me-2 fs-6"></i>
            <span class="d-none d-md-block">Tổng Quan</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
            <i class="ti ti-bell me-2 fs-6"></i>
            <span class="d-none d-md-block">Thống Kê</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
            <i class="ti ti-lock me-2 fs-6"></i>
            <span class="d-none d-md-block">Rút Tiền</span>
          </button>
        </li>
      </ul>
      <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
            <div class="row">
              <div class="col-lg-6 d-flex align-items-stretch">
  <div class="card w-100 border position-relative overflow-hidden">
    <div class="card-body p-4">
      <h4 class="card-title"></h4>
      <p class="card-subtitle mb-4"></p>
      <div class="text-center">
                <img src="https://i.imgur.com/cgcWqIO.jpeg" alt="Avatar" class="rounded-circle" width="120" height="120">
        <div class="d-flex align-items-center justify-content-center my-4 gap-6">
          <a class="btn btn-primary" href="/withdraw">Lịch sử rút</a>
          <button class="btn bg-danger-subtle text-danger">Đăng xuất</button>
        </div>
        <p class="mb-0">Chia sẻ liên kết này lên mạng xã hội hoặc bạn bè của bạn.</p>
        <p class="mb-0">Bạn sẽ nhận được hoa hồng khi bạn bè được bạn giới thiệu sử dụng dịch vụ của <b>DICHVU.INFO</b></p>
        <p id="affiliate" style="display:none;"><?=$system['affiliate'];?></p> <!-- Giá trị hoa hồng từ PHP -->
    <p class="mb-0">
        Nếu bạn A nhấn vào link tiếp thị của bạn, bạn A mua sản phẩm của hệ thống <span id="productPrice"></span>, bạn sẽ được hoa hồng <?=$system['affiliate'];?>% của <span id="productPrice"></span> là <span id="commission"></span>.
    </p>
        <p class="mb-0">Nghiêm cấm hành vi tự giới thiệu bản thân để giảm giá bán, phát hiện sẽ khóa tài khoản và không duyệt rút tiền.</p>
      </div>
    </div>
  </div>
</div>

              <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100 border position-relative overflow-hidden">
                  <div class="card-body p-4">
                    <h4 class="card-title">Thông Tin Chi Tiết</h4>
                    <hr>
                      <div class="mb-3">
                        <label class="form-label">Link Giới Thiệu Của Bạn</label>
                        <input type="text" class="form-control" value="https://<?= $_SERVER['SERVER_NAME']; ?>/register?aff=<?= urlencode($getUser['id']); ?>" readonly>

                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword2" class="form-label">Mức Hoa Hồng</label>
                        <input type="text" class="form-control" value="<?=$system['affiliate'];?>%" readonly> 
                      </div>
                      <div>
                        <label for="exampleInputPassword3" class="form-label">Số Dư Hoa Hồng Khả Dụng</label>
                        <input type="text" class="form-control" value="<?= $getUser['money_aff']; ?>đ" readonly>
                      </div>
                  </div>
                </div>
              </div>            </div>
          </div>
          <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <div class="card border shadow-none">
                  <div class="card-body p-4">
                    <h4 class="card-title">Thống Kê</h4>
                    <div>
                      <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                          <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-checkbox text-dark d-block fs-7" width="22" height="22"></i>
                          </div>
                          <div>
                            <h5 class="fs-4 fw-semibold">0</h5>
                            <p class="mb-0">Đăng Ký Mới</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                          <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-truck-delivery text-dark d-block fs-7" width="22" height="22"></i>
                          </div>
                          <div>
                            <h5 class="fs-4 fw-semibold">0</h5>
                            <p class="mb-0">Số Lượt Truy Cập</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                          <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-mail text-dark d-block fs-7" width="22" height="22"></i>
                          </div>
                          <div>
                            <h5 class="fs-4 fw-semibold"><?=$row['commission_amount'];?>đ</h5>
                            <p class="mb-0">Hoa Hồng Đã Nhận</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <div class="card border shadow-none">
                  <div class="card-body p-4">
                    <h4 class="card-title mb-3">Tạo Yêu Cầu Rút Tiền</h4>
                    <div class="alert bg-danger-subtle text-info alert-dismissible fade show" role="alert">
                      <div class="d-flex align-items-center text-danger">
                      Số tiền Rút tối thiểu là 100.000.00đ  và  Khoản thanh toán sau đó sẽ được gửi đến tài khoản rút tiền của bạn trong thời gian ngày làm việc không quá 7 ngày sau khi yêu cầu. Vui lòng không liên hệ với chúng tôi về thanh toán trước ngày đến hạn.
                      </div>
                    </div>
                    <form>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <label for="exampleInputtext6" class="form-label">Ngân Hàng</label>
                            <select class="form-control" id="bank">
                            	<option value="">-- Chọn ngân hàng cần rút -- </option>
                            	<option value="Momo">Ví điện tử Momo</option>
                                                            <option value="VIETCOMBANK">Ngân hàng Vietcombank</option>

                                                            <option value="BIDV">Ngân hàng BIDV</option>

                                                            <option value="VIETINBANK">Ngân hàng VIETINBANK</option>

                                                            <option value="AGRIBANK">Ngân hàng AGRIBANK</option>

                                                            <option value="SACOMBANK">Ngân hàng SACOMBANK</option>

                                                            <option value="DONGABANK">Ngân hàng DONGABANK</option>

                                                            <option value="VPBANK">Ngân hàng VPBANK</option>

                                                            <option value="TPBANK">Ngân hàng TPBANK</option>

                                                            <option value="EXIMBANK">Ngân hàng EXIMBANK</option>

                                                            <option value="SEABANK">Ngân hàng SEABANK</option>

                                                            <option value="KIENLONGBANK">Ngân hàng KIENLONGBANK</option>

                                                            <option value="TECHCOMBANK">Ngân hàng TECHCOMBANK</option>

                                                            <option value="ABBANK">Ngân hàng ABBANK</option>

                                                            <option value="SAIGONBANK">Ngân hàng SAIGONBANK</option>

                                                            <option value="MSB">Ngân hàng MSB</option>

                                                            <option value="CIMB">Ngân hàng CIMB</option>

                                                            <option value="VAB">Ngân hàng VAB</option>

                                                            <option value="VIB">Ngân hàng VIB</option>

                                                            <option value="SCB">Ngân hàng SCB</option>

                                                            <option value="IBK">Ngân hàng IBK</option>

                                                            <option value="VRB">Ngân hàng VRB</option>

                                                            <option value="NASB">Ngân hàng NASB</option>

                                                            <option value="VIETCAPITAL">Ngân hàng VIETCAPITAL</option>

                                                            <option value="BVB">Ngân hàng BVB</option>

                                                            <option value="LPB">Ngân hàng LPB</option>

                                                            <option value="PVCOMBANK">Ngân hàng PVCOMBANK</option>

                                                            <option value="OCEANBANK">Ngân hàng OCEANBANK</option>

                                                            <option value="GPB">Ngân hàng GPB</option>

                                                            <option value="NAMABANK">Ngân hàng NAMABANK</option>

                                                            <option value="HDB">Ngân hàng HDB</option>

                                                            <option value="OCB">Ngân hàng OCB</option>

                                                            <option value="MHB">Ngân hàng MHB</option>

                                                            <option value="NCB">Ngân hàng NCB</option>

                                                            <option value="ACB">Ngân hàng ACB</option>

                                                            <option value="VIETBANK">Ngân hàng VIETBANK</option>

                                                            <option value="MB">Ngân hàng MB BANK</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputtext7" class="form-label">Số Tài Khoản</label>
                            <input type="text" class="form-control" id="stk" placeholder="Nhập số tài khoản cần rút">
                          </div>
                          <div>
                            <label for="exampleInputtext8" class="form-label">Chủ Tài Khoản</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập tên chủ tài khoản cần rút">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputtext9" class="form-label">Số Tiền Rút</label>
                            <input type="number" class="form-control" id="amount" placeholder="Nhập số tiền cần rút">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex align-items-center justify-content-end gap-6">
                  <button class="btn btn-primary" id="withdraw" onclick="s()">Rút Ngay</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <script>
        // Hàm tính hoa hồng
        function calculateCommission() {
            // Lấy giá trị hoa hồng từ PHP
            var affiliate = parseFloat(document.getElementById('affiliate').innerText);
            var productPrice = 100000; // Giá sản phẩm

            // Tính hoa hồng
            var commission = (affiliate / 100) * productPrice;

            // Hiển thị kết quả
            document.getElementById('commission').innerText = commission.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            document.getElementById('productPrice').innerText = productPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        }

        // Chạy hàm khi trang tải xong
        window.onload = function() {
            calculateCommission();
        }
    </script>
    <script>
      function s(){
          $('#withdraw').html('Đang xử lý...').prop('disabled', true);
          $.ajax({
            url: "/ajaxs/withdraw-ref.php",
            method: "POST",
            
            data: {
	            bank: $("#bank").val(),
	            stk: $("#stk").val(),
	            name: $("#name").val(),
	            amount: $("#amount").val()
            },
                success: function(response) {
                    var data = JSON.parse(response);
                    
                    swal('Thông Báo', data.message, data.status);
                    
                    if(data.status == 'success'){
                        window.location.href="/affiliates";
                    }
                $('#withdraw').html('Rút Ngay').prop('disabled', false);
            }
        });
      }
    </script> 
      
<?php include('../app/footer.php'); ?>