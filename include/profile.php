<?php include('../app/header.php');
checkSession(); ?>
<title>Trang Cá Nhân - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">TÀI KHOẢN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Account
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body p-0">
              <div class="row align-items-center">
                <div class="col-lg-12 mt-n3 order-lg-2 order-1">
                  <div class="mt-n5">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                      <div class="d-flex align-items-center justify-content-center round-110">
                        <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                          <img src="<?php if($getUser['level'] == 'admin') echo 'https://imgur.com/cgcWqIO.png'; else echo 'https://imgur.com/cgcWqIO.png'; ?>" alt="Avatar" class="w-100 h-100">
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <h5 class="mb-0"><b><?=$getUser['Name'];?></b> <img class="img-fluid" src="https://i.imgur.com/Fcupuom.gif" style="max-width: 17px;"></h5>
                      <p class="mb-0"><?=$getUser['email'];?></p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 order-last">
                  <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-0 gap-3">
                    <li>
                      <a href="/banks" class="btn btn-primary text-nowrap">Nạp Tiền</a>
                    </li>
                    <li>
                      <a href="/change-password" class="btn btn-primary text-nowrap">Đổi Mật Khẩu</a>
                    </li>
                  </ul>
                </div>
                <hr>
              </div>
              <div style="padding-bottom:10px"></div>
            </div>
          </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="card shadow-none border">
                    <div class="card-body">
                     <h5 class="mb-3">Thông tin cá nhân</h5>
                      <p class="card-subtitle">Quý khách xin vui lòng bảo mật các thông tin cá nhân không tiết lộ cho người lạ, tránh mất tài khoản.</p>
                      <div class="vstack gap-3 mt-4">
                        <div class="hstack gap-6">
                          <iconify-icon icon="ph:user" class="fs-6 text-dark"></iconify-icon>
                          <h6 class=" mb-0"><b>Username:</b> <?=$getUser['username'];?></h6>
                        </div>
                        <div class="hstack gap-6">
                          <iconify-icon icon="mage:email" class="fs-6 text-dark"></iconify-icon>
                          <h6 class=" mb-0"><b>Email:</b> <?=$getUser['email'];?></h6>
                        </div>
                        <div class="hstack gap-6">
                          <iconify-icon icon="eos-icons:admin-outlined" class="fs-6 text-dark"></iconify-icon>
                          <h6 class=" mb-0"><b>Chức Vụ:</b> <?php if($getUser['level'] == 'admin') { echo 'Quản Trị Viên'; } ?><?php if($getUser['level'] == 'member') { echo 'Thành Viên'; } ?></h6>
                        </div>
                        <div class="hstack gap-6">
                          <iconify-icon icon="solar:wallet-broken" class="fs-6 text-dark"></iconify-icon>
                          <h6 class=" mb-0"><b>Hiện Có:</b> <?=Price($getUser['money']);?><sup>đ</sup></sup></h6>
                        </div>
                        <div class="hstack gap-6">
                          <iconify-icon icon="solar:wallet-broken" class="fs-6 text-dark"></iconify-icon>
                          <h6 class=" mb-0"><b>Đã Tiêu:</b> <?=Price($getUser['remoney']);?><sup>đ</sup></sup></h6>
                        </div>                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      
<?php include('../app/footer.php'); ?>