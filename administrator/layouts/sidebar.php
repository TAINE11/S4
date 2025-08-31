<div class="leftside-menu">
    <a href="./" class="logo">
        <strong class="text-light"><?= inHoaString($_SERVER['SERVER_NAME']); ?></strong>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-title">BẢNG ĐIỀU KHIỂN</li>
            <li class="side-nav-item">
                <a href="./" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i> Trang Chủ
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i> Mã Nguồn
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li><a href="./source-code.php">Thêm / Xóa / Sửa</a></li>
                        <li><a href="./source-list.php">Mã Nguồn Đã Bán</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
