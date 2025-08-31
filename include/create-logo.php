<?php
include('../app/header.php');
$query = $connect->query("SELECT * FROM Logo WHERE id = '".$_GET['id']."'")->fetch_array();
if($_GET['id'] != $query['id']){
    echo redirect('/logo-design');
}
?>
<title>Thanh Toán Logo #<?=$query['id'];?> - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>     
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">THANH TOÁN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Order serrvice
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="shop-detail">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div id="sync1" class="owl-carousel owl-theme">
                      <div class="item rounded overflow-hidden">
                        <img src="<?=$query['image'];?>" alt="<?=$query['name'];?>" class="img-fluid">
                      </div>
                    </div>

                    <div style="padding-top:5px">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="shop-content">
                      <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge text-bg-success fs-2 fw-semibold">Logo Design</span>
                        <span class="fs-2">#<?=$query['id'];?></span>
                      </div>
                      <h4><?=$query['name'];?></h4>
                      <div class="d-flex align-items-center gap-8 pb-4">
                        <ul class="list-unstyled d-flex align-items-center mb-0">
                          <li>
                            <a class="me-1" href="javascript:void(0)">
                              <i class="ti ti-star text-warning fs-4"></i>
                            </a>
                          </li>
                          <li>
                            <a class="me-1" href="javascript:void(0)">
                              <i class="ti ti-star text-warning fs-4"></i>
                            </a>
                          </li>
                          <li>
                            <a class="me-1" href="javascript:void(0)">
                              <i class="ti ti-star text-warning fs-4"></i>
                            </a>
                          </li>
                          <li>
                            <a class="me-1" href="javascript:void(0)">
                              <i class="ti ti-star text-warning fs-4"></i>
                            </a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">
                              <i class="ti ti-star text-warning fs-4"></i>
                            </a>
                          </li>
                        </ul>
                        <a href="javascript:void(0)">(<?=Price($query['sold']);?> lượt đã tạo)</a>
                      </div>
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-7 me-1 text-success" icon="solar:wallet-money-bold"></iconify-icon><h6 class="mb-0 fs-4">Giá Tiền: <?=Price($query['price']);?><sup>đ</sup></h6>
                      </div>
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-7 me-1 text-warning" icon="solar:cart-4-bold"></iconify-icon><h6 class="mb-0 fs-4">Lượt Tạo: <?=Price($query['sold']);?></h6>
                      </div>                  
                      <hr>
                      <div class="d-sm-flex align-items-center gap-6 pt-8 mb-7">
                      <button data-bs-toggle="modal" data-bs-target="#pop-tool-modal" class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <iconify-icon class="fs-4 me-2" icon="pepicons-pop:cart-circle-filled"></iconify-icon>
                        Tạo Ngay
                      </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="pop-tool-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h6 class="modal-title" id="myLargeModalLabel">
           Thông Tin Logo
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
                    <div class="row">
                     <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                          <label for="inputname" class="form-label">Tên Logo</label>
                          <input type="text" class="form-control" id="name" placeholder="Nhập tên logo (VD - DICHVUREAT.NET)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                          <label for="inputEmail3" class="form-label">Mã Giảm Giá (Nếu Có)</label>
                         <input type="text" class="form-control" id="coupon" placeholder="Nhập mã giảm giá (nếu có)">
                        </div>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="justify-content-center btn mb-1 btn-rounded btn-dark d-flex align-items-center" data-bs-dismiss="modal">
            Hủy
          </button>
          <button id="submit" onclick="create()" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
            Thanh Toán - <?=Price($query['price']);?><sup>đ</sup>
          </button>
        </div>
      </div>
    </div>
  </div>
<script>
      function create(){
          $('#submit').html('Đang xử lý...').prop('disabled', true);
          $.ajax({
            url: "/ajaxs/logo.php",
            method: "POST",
            data: {
                name: $("#name").val(),
                coupon: $("#coupon").val(),
                id: '<?=$query['id'];?>'
            },
            success: function(response) {
                var data = JSON.parse(response);
                
                swal('Thông Báo', data.message, data.status);
                
                $('#submit').html('Thanh Toán - <?=Price($query['price']);?><sup>đ</sup>').prop('disabled', false);
                check();
            }
        });
      }
  </script>
<?php include('../app/footer.php'); ?>