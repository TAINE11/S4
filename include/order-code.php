<?php
include('../app/header.php');
$query = $connect->query("SELECT * FROM MaNguon WHERE id = '".$_GET['id']."'")->fetch_array();
if($_GET['id'] != $query['id']){
    echo redirect('/source-code');
}
?>
<title>Mua Mã Nguồn #<?=$query['id'];?> - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>     
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
                      <li class="breadcrumb-item" aria-current="page">Thanh Toán
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
                        <span class="badge text-bg-success fs-2 fw-semibold">Source Code</span>
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
                        <a href="javascript:void(0)">(<?=Price($query['sold']);?> lượt đã bán)</a>
                      </div>
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-7 me-1 text-success" icon="solar:wallet-money-bold"></iconify-icon><h6 class="mb-0 fs-4">Giá Tiền: <?=Price($query['price']);?><sup>đ</sup></h6>
                      </div>
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-7 me-1 text-warning" icon="solar:cart-4-bold"></iconify-icon><h6 class="mb-0 fs-4">Đã Bán: <?=Price($query['sold']);?></h6>
                      </div>                  
                      <hr>
                      <div class="d-sm-flex align-items-center gap-6 pt-8 mb-7">
                      <button onclick="order()" id="pay" class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <iconify-icon class="fs-4 me-2" icon="pepicons-pop:cart-circle-filled"></iconify-icon>Mua Ngay
                      </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body p-4">
                <ul class="nav nav-pills user-profile-tab border-bottom" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                      Mô Tả
                    </button>
                  </li>
                </ul>
                <div class="tab-content pt-4" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                        <p><?=$query['description'];?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="related-products pt-7">
              <h6 class="mb-3 fw-semibold">Ảnh mô tả</h6>
              <div class="row">
                
                <div class="col-sm-6 col-xxl-3">
                  <div class="card overflow-hidden rounded-2">
                    <div class="position-relative">
                      <a href="javascript:void(0)" class="hover-img d-block overflow-hidden">
                        <img src="<?=$query['images'];?>" class="card-img-top rounded-0" alt="Ảnh Mô Tả">
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
<script>
function order() {
    $('#pay').html('Đang xử lý...').prop('disabled', true);
    $.ajax({
        url: "/ajaxs/source-code.php",
        method: "POST",
        data: {
            id: '<?=$query['id'];?>'
        },
        success: function(response) {
            try {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    swal('Thông Báo', data.message, data.status);
                } else {
                    swal('Thông Báo', data.message, data.status);
                }
            } catch (e) {
                swal('Thông Báo', 'Lỗi khi xử lý dữ liệu từ máy chủ!', 'error');
            } finally {
                $('#pay').html('<iconify-icon class="fs-4 me-2" icon="pepicons-pop:cart-circle-filled"></iconify-icon>Mua Ngay').prop('disabled', false);
            }
        },
        error: function(xhr, status, error) {
            swal('Thông Báo', 'Lỗi khi gửi yêu cầu đến máy chủ: ' + error, 'error');
            $('#pay').html('<iconify-icon class="fs-4 me-2" icon="pepicons-pop:cart-circle-filled"></iconify-icon>Mua Ngay').prop('disabled', false);
        }
    });
}

  </script>
<?php include('../app/footer.php'); ?>