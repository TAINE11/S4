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
  <title>Đăng Ký Tài Khoản</title>
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
                <h2 class="mb-2 mt-4 fs-7 fw-bolder">Đăng Ký Tài Khoản</h2>
                <p class="mb-9">Tiến hành đăng ký tài khoản để tiếp tục các dịch vụ của chúng tôi!</p>
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
                    <label for="name" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên của bạn">
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Tên Tài Khoản</label>
                  <input type="text" class="form-control" id="username" placeholder="Nhập tên tài khoản">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn">
                </div>
                <div class="mb-4">
                  <label for="password" class="form-label">Mật Khẩu</label>
                  <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="mb-3">
                  <label for="id_aff" class="form-label">Mã Giới Thiệu</label>
                  <input type="text" class="form-control" id="id_aff" placeholder="Mã Giới Thiệu ( nếu có )">
                </div>
                <button id="register" onclick="submit()" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Đăng Ký</button>
                <div class="d-flex align-items-center">
                  <p class="fs-4 mb-0 text-dark">Bạn đã có tài khoản?</p>
                  <a class="text-primary fw-medium ms-2" href="/login">Đăng nhập tại đây</a>
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
  // Get input values
  var name = $("#name").val();
  var username = $("#username").val();
  var email = $("#email").val();
  var password = $("#password").val();
  var id_aff = $("#id_aff").val();

  // Check name length
  if (name.length === 0) {
    swal('Thông Báo', 'Tên không được để trống.', 'error');
    return;
  }

  // Check username length
  if (username.length <= 6) {
    swal('Thông Báo', 'Tên tài khoản phải dài hơn 6 ký tự.', 'error');
    return;
  }

  // Check password length
  if (password.length <= 6) {
    swal('Thông Báo', 'Mật khẩu phải dài hơn 6 ký tự.', 'error');
    return;
  }
  
  // Check email domain
  var emailRegex = /^[^\s@]+@(gmail\.com|yahoo\.com|icloud\.com|outlook\.(com|co\.uk|com\.au))$/;
  if (!emailRegex.test(email)) {
    swal('Thông Báo', 'Chỉ được dùng có đuôi email phổ biến hiện nay', 'error');
    return;
  }

  $('#register').html('Đang xử lý...').prop('disabled', true);
  $.ajax({
    url: "/ajaxs/auth.php",
    method: "POST",
    data: {
      type: 'register',
      name: name,
      username: username,
      email: email,
      password: password,
      id_aff: id_aff
    },
    success: function(response) {
      var data = JSON.parse(response);
      
      swal('Thông Báo', data.message, data.status);
      
      if (data.status == 'success') {
        window.location.href = "/";
      }
      
      $('#register').html('Đăng kí').prop('disabled', false);
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
