<?php include('../app/config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="<?=$system['shortcut'];?>" />

  <!-- Core Css -->
  <link rel="stylesheet" href="/dist/assets/css/style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
  <title>Quên Mật Khẩu</title>
</head>

<body class="link-sidebar">
  <!-- Preloader -->
  <div class="preloader">
    <img src="<?=$system['shortcut'];?>" alt="PN" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row gx-0">
          <div class="col-lg-12 col-xl-5 col-xxl-12">
            <div class="min-vh-100 bg-body row justify-content-center align-items-center p-5">
              <div class="col-12 auth-card">
                <a href="/" class="text-nowrap logo-img d-block w-100">
                  <img width="200px" src="<?=$system['logo'];?>" class="dark-logo" alt="Logo" />
                </a>
                <h2 class="mb-2 mt-4 fs-7 fw-bolder">Quên Mật Khẩu</h2>
                <p class="mb-9">Bạn quên mật khẩu!</p>
                <div class="row">
                  <div class="col-6 mb-2 mb-sm-0">
                    <a class="btn btn-link border border-muted d-flex align-items-center justify-content-center rounded-2 py-8 text-decoration-none" href="javascript:void(0)" role="button">
                      <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/svgs/google-icon.svg" alt="matdash-img" class="img-fluid me-2" width="18" height="18" />
                      Google
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-link border border-muted d-flex align-items-center justify-content-center rounded-2 py-8 text-decoration-none" href="javascript:void(0)" role="button">
                      <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/svgs/facebook-icon.svg" alt="matdash-img" class="img-fluid me-2" width="18" height="18" />
                      Facebook
                    </a>
                  </div>
                </div>
                <div class="position-relative text-center my-4">
                  <p class="mb-0 fs-4 px-3 d-inline-block bg-body text-dark z-index-5 position-relative">
                    hoặc
                  </p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Nhập email tài khoản cần lấy">
                </div>
                <button id="login" onclick="submit()" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Gửi Email</button>
                <div class="d-flex align-items-center justify-content-center">
                  <a class="text-primary fw-medium ms-2" href="/login">Đăng nhập</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function submit() {
      $('#login').html('Đang xử lý...').prop('disabled', true);
      $.ajax({
        url: "/ajaxs/auth.php",
        method: "POST",
        data: {
          type: 'forgotpassword',
          email: $("#email").val()
        },
        success: function(response) {
          try {
            var data = JSON.parse(response);
            swal('Thông Báo', data.message, data.status);
            if (data.status === 'success') {
              window.location.href = "/forget-password";
            }
          } catch (e) {
            console.error('Lỗi phân tích JSON:', e);
            swal('Thông Báo', 'Có lỗi xảy ra. Vui lòng thử lại sau!', 'error');
          } finally {
            $('#login').html('Gửi Email').prop('disabled', false);
          }
        },
        error: function() {
          swal('Thông Báo', 'Không thể kết nối với máy chủ. Vui lòng kiểm tra lại!', 'error');
          $('#login').html('Gửi Email').prop('disabled', false);
        }
      });
    }
  </script>
  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
  <script src="/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/dist/assets/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="/dist/assets/js/theme/app.init.js"></script>
  <script src="/dist/assets/js/theme/theme.js"></script>
  <script src="/dist/assets/js/theme/app.min.js"></script>
  <script src="/dist/assets/js/theme/sidebarmenu-default.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
