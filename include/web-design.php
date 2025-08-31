<?php include('../app/header.php'); ?>
<title>Mẫu Giao Diện - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
   <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                 <b class="mb-4 mb-md-0 card-title">MẪU GIAO DIỆN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Templates
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="card position-relative overflow-hidden">
            <div class="shop-part d-flex w-100">
              <div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
                <ul class="list-group pt-2 border-bottom rounded-0">
                  <h6 class="my-3 mx-4 fw-semibold">Thể Loại Web</h6>
<?php $iunnhu = $connect->query("SELECT * FROM MauGiaoDien");
      foreach($iunnhu as $nnhu){ ?>
                  <li class="list-group-item border-0 p-0 mx-4 mb-2">
                    <a class="d-flex align-items-center gap-6 list-group-item-action text-dark px-3 py-6 rounded-1" href="/category/<?=$nnhu['id'];?>">
                      <iconify-icon icon="formkit:arrowright" class="fs-4"></iconify-icon><?=$nnhu['name'];?>
                    </a>
                  </li>
 <?php } ?>
                </ul>
              </div>
              <div class="card-body p-4 pb-0">
                <div class="d-flex justify-content-between align-items-center gap-6 mb-4">
                  <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas" href="#filtercategory" role="button" aria-controls="filtercategory">
                    <iconify-icon icon="heroicons-outline:menu-alt-2" class="fs-6"></iconify-icon>
                  </a>
                  <h5 class="fs-5 mb-0 d-none d-lg-block">Danh Mục Website</h5>
                </div>
                <div class="row">
<?php $mphat = $connect->query("SELECT * FROM MauGiaoDien");
      foreach($mphat as $nnhucuti){
              $id+=1; ?>
                  <div class="col-sm-4 col-xxl-4">
                    <div class="card overflow-hidden rounded-2 border">
                      <div class="position-relative">
                        <a href="/category/<?=$nnhucuti['id'];?>" class="hover-img d-block overflow-hidden">
                          <img src="<?=$nnhucuti['image'];?>" class="card-img-top rounded-0" alt="Templates">
                        </a>
                        <a href="javascript:void(0)" class="text-bg-danger rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="I like it">
                          <iconify-icon icon="iconamoon:heart-fill" class="fs-4"></iconify-icon>
                        </a>
                      </div>
                      <div class="card-body pt-3 p-4">
                        <h6 class="fw-semibold fs-4"><?=$nnhucuti['name'];?></h6>
                        <br>
                        <div class="text-end">            
                         <a href="/category/<?=$nnhucuti['id'];?>" class="float-end btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <iconify-icon class="fs-4 me-2" icon="zondicons:view-show"></iconify-icon>
                        Xem Ngay
                      </a>
                        </div>
                      </div>
                    </div>
                  </div>
<?php } ?>
                </div>
              </div>
              <div class="offcanvas offcanvas-start" tabindex="-1" id="filtercategory" aria-labelledby="filtercategoryLabel">
                <div class="offcanvas-body shop-filters w-100 p-0">
                  <ul class="list-group pt-2 border-bottom rounded-0">
                    <h6 class="my-3 mx-4 fw-semibold">Thể Loại Web</h6>
<?php $iunnhu = $connect->query("SELECT * FROM MauGiaoDien");
      foreach($iunnhu as $nnhu){ ?>                    
                    <li class="list-group-item border-0 p-0 mx-4 mb-2">
                      <a class="d-flex align-items-center gap-6 list-group-item-action text-dark px-3 py-6 rounded-1" href="/category/<?=$nnhu['id'];?>">
                        <iconify-icon icon="formkit:arrowright" class="fs-4"></iconify-icon><?=$nnhu['name'];?></a>
                    </li>
<?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 <?php include('../app/footer.php'); ?>