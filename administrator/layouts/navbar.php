<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1"> 
            <div class="logo-topbar">
                <a href="./" class="logo-light">
                    <strong class="text-light"><?= inHoaString($_SERVER['SERVER_NAME']); ?></strong>
                </a>
                <a href="./" class="logo-dark">
                    <strong class="text-dark"><?= inHoaString($_SERVER['SERVER_NAME']); ?></strong>
                </a>
            </div>
            <button class="button-toggle-menu">
                <i class="ri-menu-line"></i>
            </button>
        </div>
        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown">
                    <span class="account-user-avatar">
                        <img src="https://imgur.com/cgcWqIO.png" alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-block d-none">
                        <h5 class="my-0 fw-normal"><?= ReturnXss($getUser['name']); ?></h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Xin Chào, Admin!</h6>
                    </div>
                    <a href="/logout" class="dropdown-item">
                        <i class="ri-logout-box-line"></i> Đăng Xuất
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
