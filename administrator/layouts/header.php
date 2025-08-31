<?php
include('core.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title> HỆ THỐNG QUẢN TRỊ </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="HỆ THỐNG QUẢN TRỊ" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="https://bdt.asia/img/member-avatar.png">
        <link rel="stylesheet" href="./layouts/assets/vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="./layouts/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">
        <script src="./layouts/assets/js/config.js"></script>
        <link href="./layouts/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="./layouts/assets/css/header.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="./layouts/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script>
    <!-- ALERT KIỂU 1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
      <!-- Thêm TinyMCE -->
      <script src="https://cdn.tiny.cloud/1/y9rdtforjw6yunl0lyuged2ldrspt3echmsf376yzh88ddoe/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
      
      
    </head>

    <body>
        <div class="wrapper"> 

            
            <div class="navbar-custom">
                <div class="topbar container-fluid">
                    <div class="d-flex align-items-center gap-1"> 

                        <!-- Topbar Brand Logo -->
                        <div class="logo-topbar">
                            <!-- Logo light -->
                            <a href="./" class="logo-light">
                                <span class="logo-lg">
                                    <strong class="text-light"><?=inHoaString($_SERVER['SERVER_NAME']);?></strong>
                                </span>
                                <span class="logo-sm">
                                    <img src="./layouts/assets/images/logo.png" alt="small logo">
                                </span>
                            </a>

                            <!-- Logo Dark -->
                            <a href="./" class="logo-dark">
                                <span class="logo-lg">
                                    <strong class="text-dark"><?=inHoaString($_SERVER['SERVER_NAME']);?></strong>
                                </span>
                                <span class="logo-sm">
                                    <img src="./layouts/assets/images/logo.png" alt="small logo">
                                </span>
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="ri-menu-line"></i>
                        </button>

                        <!-- Horizontal Menu Toggle Button -->
                        <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>

                        <!-- Topbar Search Form -->
                        <div class="app-search d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search...">
                                    <span class="ri-search-line search-icon text-muted"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-3">
                        <li class="dropdown d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i class="ri-search-line fs-22"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>


                        <li class="d-none d-sm-inline-block">
                            <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                                <i class="ri-settings-3-line fs-22"></i>
                            </a>
                        </li>

                        <li class="d-none d-sm-inline-block">
                            <div class="nav-link" id="light-dark-mode">
                                <i class="ri-moon-line fs-22"></i>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="https://imgur.com/cgcWqIO.png" alt="user-image" width="32" class="rounded-circle">
                                </span>
                                <span class="d-lg-block d-none">
                                    <h5 class="my-0 fw-normal"> <?=ReturnXss($getUser['name']);?> <i
                                            class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0"> Xin Chào, Admin !</h6>
                                </div>

                                <a href="/logout" class="dropdown-item">
                                    <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                    <span> Đăng Xuất </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            
            <div class="leftside-menu">

                <!-- Brand Logo Light -->
                <a href="./" class="logo logo-light">
                    <span class="logo-lg">
                        <strong class="text-light"><?=inHoaString($_SERVER['SERVER_NAME']);?></strong>
                    </span>
                    <span class="logo-sm">
                        <img src="<?=$system['logo'];?>" alt="logo">
                    </span>
                </a>

                <!-- Brand Logo Dark -->
                <a href="./" class="logo logo-dark">
                    <span class="logo-lg">
                        <strong class="text-dark"><?=inHoaString($_SERVER['SERVER_NAME']);?></strong>
                    </span>
                    <span class="logo-sm">
                        <img src="<?=$system['logo'];?>" alt="logo">
                    </span>
                </a>

                <!-- Sidebar -left -->
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title">BẢNG ĐIỀU KHIỂN</li>

                        <li class="side-nav-item">
                            <a href="./" class="side-nav-link">
                                <i class="ri-dashboard-3-line"></i>
                                <span> Trang Chủ </span>
                            </a>
                        </li>
                        </li><li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPages3" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="ri-pages-line"></i>
                                <span> Mã Nguồn </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="sidebarPages3">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./source-code.php"> Thêm / Xóa / Sửa  </a>
                                    </li>
                                    
                                     <li>
                                        <a href="./source-list.php"> Mã Nguồn Đã Bán </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPages292" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="ri-pages-line"></i>
                                <span> Cài Đặt Hosting </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="sidebarPages292">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./server.php"> Máy Chủ / Gói </a>
                                    </li>
                                    
                                     <li>
                                        <a href="./cpanel.php"> Danh Sách Hosting </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPages1" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="ri-pages-line"></i>
                                <span> Thiết Kế Website </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="sidebarPages1">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./website-design.php"> Danh Mục / Giao Diện </a>
                                    </li>
                                    
                                     <li>
                                        <a href="./website-list.php"> Danh Sách Website </a>
                                    </li>
                                    <li>
                                        <a href="./dots.php"> Đuôi Miền </a>
                                    </li>
                                </ul>
                            </div>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPages4" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="ri-pages-line"></i>
                                <span> Thiết Kế Logo </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="sidebarPages4">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./logo-design.php"> Thêm / Xóa / Sửa  </a>
                                    </li>
                                    
                                     <li>
                                        <a href="./logo-list.php"> Danh Sách Logo </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPages4p" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="ri-pages-line"></i>
                                <span> Tên Miền </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="sidebarPages4p">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./domain.php"> Thêm / Xóa / Sửa  </a>
                                    </li>
                                    
                                     <li>
                                        <a href="./domain-list.php"> Danh Sách Miền </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarPagesa4" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                                <i class="ri-pages-line"></i>
                                <span> Cronjobs </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="sidebarPagesa4">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./add-server-cron.php"> Máy Chủ  </a>
                                    </li>
                                    
                                     <li>
                                        <a href="./cron-list.php"> Danh Sách Cron </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#card" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
                                <i class="ri-layout-line"></i>
                                <span> Nguồn Thẻ </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="card">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./system-card.php"> Cấu Hình Nạp Thẻ </a>
                                    </li>
                                    
                                    <li>
                                        <a href="./card-list.php"> Danh Sách Thẻ Cào </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                        
                        
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#bank" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
                                <i class=" ri-bank-line"></i>
                                <span> Ngân Hàng </span>
                                <span class="menu-arrow"></span>
                            </a>
                            
                            <div class="collapse" id="bank">
                                <ul class="side-nav-second-level">
                                    
                                    <li>
                                        <a href="./system-bank.php"> Ngân Hàng </a>
                                    </li>
                                    
                                    <li>
                                        <a href="./bank-list.php"> Lịch Sử Nạp (Momo) </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a href="./giftcode.php" class="side-nav-link">
                                <i class="ri-briefcase-line"></i>
                                <span> Mã Giảm Giá  </span>
                                <span class="menu-arrow"></span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="./setting.php" class="side-nav-link">
                                <i class=" ri-git-repository-private-fill"></i>
                                <span> Cài Đặt </span>
                                <span class="menu-arrow"></span>
                            </a>
                        </li>
                        
                        
                        <li class="side-nav-item">
                            <a href="./users.php" class="side-nav-link">
                                <i class="ri-group-2-line"></i>
                                <span> Thành Viên  </span>
                                <span class="menu-arrow"></span>
                            </a>
                        </li>
                    
                         
                        
                    </ul>

                    <div class="clearfix"></div>
                </div>
            </div>
            
            