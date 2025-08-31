<?php include('../app/header.php'); ?>
<title>Mẫu Logo - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">MẪU LOGO</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Logo design
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
<?php $bdt = $connect->query("SELECT * FROM Logo");
      foreach($bdt as $bdtZ){
              $id+=1; ?>
            <div class="col-lg-4 col-md-6">
              <div class="card">
                <img class="card-img-top img-responsive" src="<?=$bdtZ['image'];?>" alt="Source Code"/>
                <div class="card-body">
                  <h4 class="card-title"><?=$bdtZ['name'];?></h4>
                  <div class="d-flex card-text">
                    <iconify-icon icon="solar:tag-price-bold-duotone" class="fs-4 me-1 text-success"></iconify-icon><span class="me-1">Giá:</span><span class="text-success"><?=Price($bdtZ['price']);?><sup>đ</sup></span>
                  </div>
                  <div class="d-flex card-text">
                    <iconify-icon icon="solar:cart-3-bold" class="fs-4 me-1 text-warning"></iconify-icon><span class="me-1">Đã Tạo:</span><span class="text-warning"><?=Price($bdtZ['sold']);?></span>
                  </div>
                  <a href="/create-logo/<?=$bdtZ['id'];?>" class="float-end btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <iconify-icon class="fs-4 me-2" icon="solar:cart-bold"></iconify-icon>
                        Tạo Ngay
                      </a>
                </div>
              </div>
              <!-- Card -->
            </div>
<?php } ?>
          </div>
        </div>
      </div>
<?php include('../app/footer.php'); ?>