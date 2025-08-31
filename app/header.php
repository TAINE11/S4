<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?=$system['description'];?>">
  <meta name="keywords" content="<?=$system['keywords'];?>">
  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="<?=$system['shortcut'];?>" />
  <!-- Core Css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.35.0/iconfont/tabler-icons.min.css" integrity="sha512-tpsEzNMLQS7w9imFSjbEOHdZav3/aObSESAL1y5jyJDoICFF2YwEdAHOPdOr1t+h8hTzar0flphxR76pd0V1zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /><script src="https://dichvu.info/BanQuyen/license.js"></script>
  <link rel="stylesheet" href="/dist/assets/css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
  <!-- Thêm jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
    .breadcrumb-item {
      color: #007bff;
    }
    .breadcrumb-item b {
      font-weight: bold;
    }
    .breadcrumb-item i {
      font-style: italic;
    }
  </style>
</head>
<body class="link-sidebar">
  <div class="preloader">
    <img width="100%" src="https://laravelui.spruko.com/dashplex/build/assets/img/loader.svg" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper">
    <aside class="left-sidebar with-vertical">
      <div>
        <div class="brand-logo d-flex align-items-center">
          <a href="/" class="text-nowrap logo-img">
            <img width="200px" src="<?=$system['logo'];?>" alt="Logo" />
          </a>

        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul class="sidebar-menu" id="sidebarnav">
       <li class="nav-small-cap">
        <iconify-icon class="mini-icon" icon="solar:menu-dots-linear">
        </iconify-icon>
        <span class="hide-menu">
         Menu
        </span>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link" href="/">
         <iconify-icon class="" icon="solar:widget-add-line-duotone">
         </iconify-icon>
         <span class="hide-menu">
          Trang Chủ
         </span>
        </a>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="solar:chat-square-code-broken">
         </iconify-icon>
         <span class="hide-menu">
          Mã Nguồn
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/source-code">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
             Kho Mã Nguồn
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/source-manage">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
           Mã Nguồn Đã Mua
           </span>
          </a>
         </li>
        </ul>
       </li>
     <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="solar:widget-4-line-duotone">
         </iconify-icon>
         <span class="hide-menu">
          Hosting
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
          <?php $query = $connect->query("SELECT * FROM Server WHERE value = 'on'");
                foreach($query as $row){ ?>
         <li class="sidebar-item">
          <a class="sidebar-link" onclick="chooseServer('<?=$row['uname'];?>')">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
             Máy Chủ <?=$row['name'];?>
           </span>
          </a>
         </li>
         <?php } ?>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/host-manage">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Quản Lý Hosting
           </span>
          </a>
         </li>
        </ul>
       </li> 
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon class="" icon="solar:cart-3-line-duotone">
         </iconify-icon>
         <span class="hide-menu">
            Tạo Website
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/web-design">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Mẫu Giao Diện
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/web-manage">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Website Đã Tạo
           </span>
          </a>
         </li>
        </ul>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="solar:gallery-bold-duotone">
         </iconify-icon>
         <span class="hide-menu">
          Tạo Logo
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/logo-design">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
             Mẫu Logo
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/logo-manage">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Logo Đã Tạo
           </span>
          </a>
         </li>
        </ul>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="gridicons:domains">
         </iconify-icon>
         <span class="hide-menu">
          Tên Miền
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/pricing-domain">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
             Miền Giá Rẻ
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/domain-manage">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
           Tên Miền Đã Mua
           </span>
          </a>
         </li>
        </ul>
       </li>
       <li class="sidebar-item">
        <a class="sidebar-link" href="/cron">
         <iconify-icon icon="eos-icons:cronjob">
         </iconify-icon>
         <span class="hide-menu">
          Thuê Cron
         </span>
        </a>
       </li>
       <li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="ph:gift-light">
         </iconify-icon>
         <span class="hide-menu">
          Tiếp Thị Liên Kết
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/affiliates">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
             Tiếp Thị Liên Kết
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/withdraw">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
           Lịch Sử Rút Tiền
           </span>
          </a>
         </li>
        </ul>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="gridicons:customize">
         </iconify-icon>
         <span class="hide-menu">
          Tools
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/upanh">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
             Lấy Link Hình Ảnh
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/view-code">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
           View Code ( F12 )
           </span>
          </a>
         </li>
        </ul>
       </li>
        <span class="sidebar-divider lg">
        </span>
       </li>
       <li class="nav-small-cap">
        <iconify-icon class="mini-icon" icon="solar:menu-dots-linear">
        </iconify-icon>
        <span class="hide-menu">
       Account
        </span>
       </li>
       <?php if(isset($_SESSION['users'])){ ?>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
        <iconify-icon icon="solar:user-broken">
         </iconify-icon>
         <span class="hide-menu">
            Tài Khoản & Bảo Mật
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/profile">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Trang Cá Nhân
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/change-password">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Đổi Mật Khẩu
           </span>
          </a>
         </li>
        </ul>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
         <iconify-icon icon="solar:wallet-broken">
         </iconify-icon>
         <span class="hide-menu">
          Nạp Tiền
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/card">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Nạp Thẻ
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/banks">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Chuyển Khoản
           </span>
          </a>
         </li>
        </ul>
       </li>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
        <iconify-icon icon="solar:user-broken">
         </iconify-icon>
         <span class="hide-menu">
             Hỗ Trợ
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
    <a class="sidebar-link" href="<?=$system['facebook'];?>">
        <span class="icon-small"></span>
        <span class="menu-link">Facebook admin</span>
    </a>
</li>
         <li class="sidebar-item">
    <a class="sidebar-link" href="<?=$system['telegram'];?>">
        <span class="icon-small"></span>
        <span class="menu-link">Telegram admin</span>
    </a>
</li>
         <li class="sidebar-item">
    <a class="sidebar-link" href="<?=$system['zalo_group'];?>">
        <span class="icon-small"></span>
        <span class="menu-link">Nhóm Zalo</span>
    </a>
</li>
        </ul>
       </li>
       <?php } else { ?>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link has-arrow" href="javascript:void(0)">
        <iconify-icon icon="solar:user-broken">
         </iconify-icon>
         <span class="hide-menu">
          Đăng Nhập & Đăng Ký
         </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
         <li class="sidebar-item">
          <a class="sidebar-link" href="/login">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Đăng Nhập
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/register">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Đăng Ký
           </span>
          </a>
         </li>
         <li class="sidebar-item">
          <a class="sidebar-link" href="/forget-password">
           <span class="icon-small">
           </span>
           <span class="hide-menu">
            Quên Mật Khẩu
           </span>
          </a>
         </li>         
        </ul>
       </li>       
       <?php } ?>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link sidebar-link" href="/giftcode">
         <iconify-icon icon="ph:gift-light">
         </iconify-icon>
         <span class="hide-menu">
          Mã Giảm Giá
         </span>
        </a>
       </li>
       <?php if($getUser['level'] == 'admin'):?>
       <li class="sidebar-item">
        <a aria-expanded="false" class="sidebar-link sidebar-link" href="/administrator">
         <iconify-icon icon="grommet-icons:user-admin"></iconify-icon>
         <span class="hide-menu">
          Quản Trị Viên
         </span>
        </a>
       </li>
       <?php endif ?>
      </ul>
        </nav>

      </div>
    </aside>
    <div class="page-wrapper">
      <header class="topbar">
        <div class="with-vertical">
          <!-- ---------------------------------- -->
          <!-- Start Vertical Layout Header -->
          <!-- ---------------------------------- -->
          <nav class="navbar navbar-expand-lg p-0">
            <ul class="navbar-nav">
              <li class="nav-item nav-icon-hover-bg rounded-circle d-flex">
                <a class="nav-link  sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                  <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-6"></iconify-icon>
                </a>
              </li>
              <li class="nav-item d-none d-xl-flex nav-icon-hover-bg rounded-circle">
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <iconify-icon icon="solar:magnifer-linear" class="fs-6"></iconify-icon>
                </a>
              </li>
            </ul>

            <div class="d-block d-lg-none py-9 py-xl-0">
              <img width="100px" src="<?=$system['logo'];?>" />
            </div>
            <a class="navbar-toggler p-0 border-0 nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <iconify-icon icon="solar:menu-dots-bold" class="fs-6"></iconify-icon>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between">
                <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link moon dark-layout nav-icon-hover-bg rounded-circle" href="javascript:void(0)">
                      <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                    </a>
                    <a class="nav-link sun light-layout nav-icon-hover-bg rounded-circle" href="javascript:void(0)" style="display: none">
                      <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item d-block d-xl-none">
                    <a class="nav-link nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <iconify-icon icon="ph:question-fill" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                      <div class="d-flex align-items-center gap-2 lh-base">
                        <img src="<?php if($getUser['level'] == 'admin') echo 'https://i.imgur.com/cgcWqIO.jpeg'; else echo 'https://i.imgur.com/cgcWqIO.jpeg'; ?>" class="rounded-circle" width="35" height="35" alt="Avatar" />
                        <iconify-icon icon="solar:alt-arrow-down-bold" class="fs-2"></iconify-icon>
                      </div>
                    </a>
                    <div class="dropdown-menu profile-dropdown dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                    <?php if(isset($_SESSION['users'])){ ?>
                      <div class="position-relative px-4 pt-3 pb-2">
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                          <img src="<?php if($getUser['level'] == 'admin') echo 'https://i.imgur.com/cgcWqIO.jpeg'; else echo 'https://i.imgur.com/cgcWqIO.jpeg'; ?>" class="rounded-circle" width="56" height="56" alt="Avatar" />
                          <div>
                            <h5 class="mb-0 fs-12"><?=$getUser['username'];?>
                            </h5>
                            <p class="mb-0 text-dark">
                              <?=$getUser['email'];?>
                            </p>
                          </div>
                        </div>
                        <?php if(isset($_SESSION['users'])){ ?>
<?php } else { ?>
  <div class="toast toast-onload align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body hstack align-items-start gap-6">
      <iconify-icon icon="gridicons:notice" class="fs-6"></iconify-icon>
      <div>
        <h5 class="text-white fs-3 mb-1">Thông báo</h5>
        <h6 class="text-white fs-2 mb-0">Bạn chưa đăng nhập!</h6>
      </div>
      <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
<?php } ?>
                        <div class="message-body">
                          <a href="/profile" class="p-2 dropdown-item h6 rounded-1">
                            Trang Cá Nhân
                          </a>
                          <a href="/change-password" class="p-2 dropdown-item h6 rounded-1">
                            Đổi Mật Khẩu
                          </a>
                          <a href="/card" class="p-2 dropdown-item h6 rounded-1">
                           Nạp Tiền <span class="badge bg-danger-subtle text-danger rounded ms-8"><?=Price($getUser['money']);?><sup>đ</sup></span>
                          </a>
<hr>
                          <a href="/logout" class="p-2 dropdown-item h6 rounded-1">
                            Đăng Xuất
                          </a>
                        </div>
                      </div>
                     <?php } else { ?>
                      <div class="position-relative px-4 pt-3 pb-2">
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                          <img src="<?php if($getUser['level'] == 'admin') echo 'https://i.imgur.com/cgcWqIO.jpeg'; else echo 'https://i.imgur.com/cgcWqIO.jpeg'; ?>" class="rounded-circle" width="56" height="56" alt="Avatar" />
                          <div>
                            <h5 class="mb-0 fs-12">Khách
                            </h5>
                            <p class="mb-0 text-dark">
                              Chưa đăng nhập!
                            </p>
                          </div>
                        </div>
                        <div class="message-body">
                          <a href="/login" class="p-2 dropdown-item h6 rounded-1">
                            Đăng Nhập
                          </a>
                          <a href="/register" class="p-2 dropdown-item h6 rounded-1">
                            Đăng Ký
                          </a>
                          <a href="/forget-password" class="p-2 dropdown-item h6 rounded-1">
                            Quên Mật Khẩu
                          </a>
                        </div>
                      </div>
                      <div class="simplebar-track simplebar-vertical"style="visibility: hidden;">
       <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
       </div>
                     <?php } ?> 
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- ---------------------------------- -->
          <!-- End Vertical Layout Header -->
          <!-- ---------------------------------- -->

          <!-- ------------------------------- -->
          <!-- apps Dropdown in Small screen -->
          <!-- ------------------------------- -->
        </div>
        <div class="app-header with-horizontal">
          <nav class="navbar navbar-expand-xl container-fluid p-0">
            <ul class="navbar-nav align-items-center">
              <li class="nav-item d-flex d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover-bg rounded-circle" id="sidebarCollapse" href="javascript:void(0)">
                  <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                </a>
              </li>
              <li class="nav-item d-none d-xl-flex align-items-center">
                <a href="../horizontal/index.html" class="text-nowrap nav-link">
                  <img src="../assets/images/logos/logo.svg" alt="matdash-img" />
                </a>
              </li>
              <li class="nav-item d-none d-xl-flex align-items-center nav-icon-hover-bg rounded-circle">
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <iconify-icon icon="solar:magnifer-linear" class="fs-6"></iconify-icon>
                </a>
              </li>
            </ul>
            <div class="d-block d-xl-none">
              <a href="../main/index.html" class="text-nowrap nav-link">
                <img src="../assets/images/logos/logo.svg" alt="matdash-img" />
              </a>
            </div>
            <a class="navbar-toggler nav-icon-hover p-0 border-0 nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
              </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link nav-icon-hover-bg rounded-circle d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                      <iconify-icon icon="solar:sort-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link nav-icon-hover-bg rounded-circle moon dark-layout" href="javascript:void(0)">
                      <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                    </a>
                    <a class="nav-link nav-icon-hover-bg rounded-circle sun light-layout" href="javascript:void(0)" style="display: none">
                      <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="nav-item d-block d-xl-none">
                    <a class="nav-link nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <iconify-icon icon="solar:magnifer-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>



                  <!-- ------------------------------- -->
                  <!-- start profile Dropdown -->
                  <!-- ------------------------------- -->
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                      <div class="d-flex align-items-center gap-2 lh-base">
                        <img src="https://i.imgur.com/cgcWqIO.jpeg" class="rounded-circle" width="35" height="35" alt="matdash-img" />
                        <iconify-icon icon="solar:alt-arrow-down-bold" class="fs-2"></iconify-icon>
                      </div>
                    </a>
                    <div class="dropdown-menu profile-dropdown dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                      <div class="position-relative px-4 pt-3 pb-2">
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                          <img src="https://i.imgur.com/cgcWqIO.jpeg" class="rounded-circle" width="56" height="56" alt="matdash-img" />
                          <div>
                            <h5 class="mb-0 fs-12">Bùi Đức Thành <span class="text-success fs-11">Pro</span>
                            </h5>
                            <p class="mb-0 text-dark">
                              admin@dichvu.info
                            </p>
                          </div>
                        </div>
                        <div class="message-body">
                          <a href="javascript:void(0)" class="p-2 dropdown-item h6 rounded-1">
                            My Profile
                          </a>
                          <a href="javascript:void(0)" class="p-2 dropdown-item h6 rounded-1">
                            My Subscription
                          </a>
                          <a href="javascript:void(0)" class="p-2 dropdown-item h6 rounded-1">
                            My Statements <span class="badge bg-danger-subtle text-danger rounded ms-8">4</span>
                          </a>
                          <a href="javascript:void(0)" class="p-2 dropdown-item h6 rounded-1">
                            Account Settings
                          </a>
                          <a href="../default-sidebar/authentication-login2.html" class="p-2 dropdown-item h6 rounded-1">
                            Sign Out
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- ------------------------------- -->
                  <!-- end profile Dropdown -->
                  <!-- ------------------------------- -->
                </ul>
              </div>
            </div>
          </nav>

        </div>
        <script>
      function chooseServer(url){
          window.location.href="/hosting?server=" + url;
      }
</script>

      </header>