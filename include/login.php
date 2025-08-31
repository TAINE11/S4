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
  <title>Đăng Nhập Tài Khoản</title>
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
                <h2 class="mb-2 mt-4 fs-7 fw-bolder">Đăng Nhập Tài Khoản</h2>
                <p class="mb-9">Đăng nhập tài khoản để tiếp tục các dịch vụ!</p>
                <div class="row">
                  <div class="col-6 mb-2 mb-sm-0">
                    <a class="btn btn-link border border-muted d-flex align-items-center justify-content-center rounded-2 py-8 text-decoration-none" href="login-google" role="button">
                      <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/svgs/google-icon.svg" alt="matdash-img" class="img-fluid me-2" width="18" height="18" />
                      Google
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-link border border-muted d-flex align-items-center justify-content-center rounded-2 py-8 text-decoration-none" href="login-facebook" role="button">
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
                <form id="login-form">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên Tài Khoản</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên tài khoản">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Mật Khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                  </div>
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                              <input class="form-check-input primary" type="checkbox" name="remember" id="flexCheckChecked" />
                              <label class="form-check-label text-dark" for="flexCheckChecked">
                                Nhớ tài khoản
                                </label>
                    </div>
                    <a class="text-primary fw-medium" href="/forget-password">Quên mật khẩu ?</a>
                  </div>
                  <button id="login" type="button" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Đăng Nhập</button>
                </form>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-medium">Bạn chưa có tài khoản?</p>
                  <a class="text-primary fw-medium ms-2" href="/register">Tạo tài khoản mới</a>
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
                type: 'login',
                username: $("#username").val(),
                password: $("#password").val(),
                remember: $("#remember").is(":checked") // Gửi giá trị của checkbox 'Nhớ tài khoản'
            },
            success: function(response) {
                var data = JSON.parse(response);
                
                swal('Thông Báo', data.message, data.status);
                
                if (data.status == 'success') {
                    window.location.href = "/";
                }
                
                $('#login').html('Đăng Nhập').prop('disabled', false);
            },
            error: function() {
                swal('Thông Báo', 'Có lỗi xảy ra, vui lòng thử lại!', 'error');
                $('#login').html('Đăng Nhập').prop('disabled', false);
            }
        });
    }

    $(document).ready(function() {
        $('#login').click(function() {
            submit();
        });
    });
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
