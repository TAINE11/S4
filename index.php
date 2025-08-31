<?php include('app/header.php');
$web = $connect->query("SELECT * FROM DanhSachWeb WHERE username = '".$getUser['username']."'")->num_rows;
$webUn = $connect->query("SELECT * FROM DanhSachWeb WHERE username = '".$getUser['username']."' AND status = '2'")->num_rows;
$webUn2 = $connect->query("SELECT * FROM DanhSachWeb WHERE username = '".$getUser['username']."' AND status = '3'")->num_rows;

$host = $connect->query("SELECT * FROM DanhSachHost WHERE username = '".$getUser['username']."'")->num_rows;
$hostUn = $connect->query("SELECT * FROM DanhSachHost WHERE username = '".$getUser['username']."' AND status = '2'")->num_rows;
$hostUn2 = $connect->query("SELECT * FROM DanhSachHost WHERE username = '".$getUser['username']."' AND status = '3'")->num_rows;

$logo = $connect->query("SELECT * FROM DanhSachLogo WHERE username = '".$getUser['username']."'")->num_rows;

$code = $connect->query("SELECT * FROM DanhSachCode WHERE username = '".$getUser['username']."'")->num_rows;

$serviceAll = $web + $host + $logo + $code;
$serviceUn = $webUn + $webUn2 + $hostUn + $hostUn2;
?>
<title><?=$system['title'];?></title>
  <!-- Toast -->
<?php if(isset($_SESSION['users'])){ ?>
  <div class="toast toast-onload align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body hstack align-items-start gap-6">
      <iconify-icon icon="gridicons:check-circle" class="fs-6"></iconify-icon>
      <div>
        <h5 class="text-white fs-3 mb-1">Thông báo!</h5>
        <h6 class="text-white fs-2 mb-0">Chúc bạn ngày mới vui vẻ!</h6>
      </div>
      <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
<?php } else { ?>
  <div class="toast toast-onload align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body hstack align-items-start gap-6">
      <iconify-icon icon="gridicons:notice" class="fs-6"></iconify-icon>
      <div>
        <h5 class="text-white fs-3 mb-1">Thông báo</h5>
        <h6 class="text-white fs-2 mb-0">Hãy đăng nhập để sử dụng dịch vụ trên Website</h6>
      </div>
      <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
<?php } ?>
      <div class="body-wrapper">
        <div class="container-fluid">
       <marquee><h7 style="color: #e31d12">
           <iconify-icon icon="fluent-emoji:bell" width="20" height="20"></iconify-icon> 
           <span style="color: #1262e3"> [ DICHVU.INFO ] </span> Chào Mừng Bạn Đến Với Trang Web Chúng Tôi! .Chúng Tôi Chuyên Cung Cấp Các Loại Mã Nguồn Ngon Số 1 Vn..!! 
           </h7></marquee>
      <div class="row">
       <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <b class="card-title mb-3">Trang Chủ</b>
                 <nav class="py-2" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <p style="text-align:center"><strong><span style="color:#ff0000">WEBSITE CHUYÊN CUNG CẤP VPS - HOSTING - MÃ NGUỒN GIÁ RẺ UY TÍN CHẤT LƯỢNG</span></strong></p>
                        <p style="text-align:center"><strong>Mã nguồn được chia sẻ trên website chỉ nhằm mục đích tìm hiểu, học hỏi.Nghiêm cấm các hình vi dùng để vi phạm pháp luật</strong></p>
                        <p style="text-align:center"><strong>Lưu ý : Mã nguồn khi mua trên website sẽ có một số code cần kích hoạt License nên cần phải liên hệ admin để được kích hoạt lần đầu tránh leak.</strong></p>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
       <div class="col-lg-12">
        <div class="row">
       <div class="col-lg-6">
        <div class="card">
         <div class="card-body">
          <div class="hstack align-items-center gap-3 mb-4">
           <span class="d-flex align-items-center justify-content-center round-48 bg-success-subtle rounded flex-shrink-0">
            <iconify-icon class="fs-7 text-success" icon="solar:wallet-broken">
            </iconify-icon>
           </span>
           <div>
            <p class="mb-1 text-dark">
             Số Dư Hiện Có
            </p>
            <h4 class="mb-0">
             <?=Price($getUser['money']);?><sup>đ</sup>
            </h4>
           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="col-lg-6">
        <div class="card">
         <div class="card-body">
          <div class="hstack align-items-center gap-3 mb-4">
           <span class="d-flex align-items-center justify-content-center round-48 bg-danger-subtle rounded flex-shrink-0">
            <iconify-icon class="fs-7 text-danger" icon="solar:wallet-2-broken">
            </iconify-icon>
           </span>
           <div>
            <p class="mb-1 text-dark">
             Tổng Tiền Đã Tiêu
            </p>
            <h4 class="mb-0">
             <?=Price($getUser['remoney']);?><sup>đ</sup>
            </h4>
           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="col-lg-6">
        <div class="card">
         <div class="card-body">
          <div class="hstack align-items-center gap-3 mb-4">
           <span class="d-flex align-items-center justify-content-center round-48 bg-primary-subtle rounded flex-shrink-0">
            <iconify-icon class="fs-7 text-primary" icon="solar:cart-3-broken">
            </iconify-icon>
           </span>
           <div>
            <p class="mb-1 text-dark">
             Tổng Dịch Vụ
            </p>
            <h4 class="mb-0">
             <?=Price($serviceAll);?>
            </h4>
           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="col-lg-6">
        <div class="card">
         <div class="card-body">
          <div class="hstack align-items-center gap-3 mb-4">
           <span class="d-flex align-items-center justify-content-center round-48 bg-warning-subtle rounded flex-shrink-0">
            <iconify-icon class="fs-7 text-warning" icon="lets-icons:time">
            </iconify-icon>
           </span>
           <div>
            <p class="mb-1 text-dark">
              Dịch Vụ Hết Hạn
            </p>
            <h4 class="mb-0">
             <?=Price($serviceUn);?>
            </h4>
           </div>
          </div>
         </div>
        </div>
       </div>
         </div>
        </div>
       </div>
       <div class="col-lg-12">
        <div class="card">
         <div class="card-body">
          <h5 class="card-title fw-semibold">
           Thống Kê
          </h5>
          <p class="card-subtitle mb-0">
           Thống kế dịch vụ của bạn
          </p>
          <div class="row mt-4">
           <div class="col-md-6">
            <div class="vstack gap-9 mt-2">
             <div class="hstack align-items-center gap-3">
              <div class="d-flex align-items-center justify-content-center round-48 rounded bg-success">
               <iconify-icon class="fs-7 text-white" icon="solar:cart-3-broken">
               </iconify-icon>
              </div>
              <div>
               <h6 class="mb-0">
                <?=Price($code);?>
               </h6>
               <span>
                Tổng Mã Nguồn
               </span>
              </div>
             </div>
             <div class="hstack align-items-center gap-3">
              <div class="d-flex align-items-center justify-content-center round-48 rounded bg-danger-subtle">
               <iconify-icon class="fs-7 text-danger" icon="solar:filters-outline">
               </iconify-icon>
              </div>
              <div>
               <h6 class="mb-0">
                <?=Price($host);?>
               </h6>
               <span>
                Tổng Hosting
               </span>
              </div>
             </div>
             <div class="hstack align-items-center gap-3">
              <div class="d-flex align-items-center justify-content-center round-48 rounded bg-primary-subtle flex-shrink-0">
               <iconify-icon class="fs-7 text-primary" icon="solar:shop-2-linear">
               </iconify-icon>
              </div>
              <div>
               <h6 class="mb-0 text-nowrap">
                <?=Price($web);?>
               </h6>
               <span>
                Tổng Website
               </span>
              </div>
             </div>
             <div class="hstack align-items-center gap-3">
              <div class="d-flex align-items-center justify-content-center round-48 rounded bg-secondary-subtle">
               <iconify-icon class="fs-7 text-secondary" icon="solar:pills-3-linear">
               </iconify-icon>
              </div>
              <div>
               <h6 class="mb-0">
                <?=Price($logo);?>
               </h6>
               <span>
                Tổng Logo
               </span>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      </div>
<?php include('app/footer.php'); ?>