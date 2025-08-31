<?php
include('../app/header.php');
$query = $connect->query("SELECT * FROM GiaoDien WHERE id = '".$_GET['id']."'")->fetch_array();
if($_GET['id'] != $query['id']){
    echo json_api('Đơn hàng không tồn tại!','error');
    echo redirect('/web-design');
}
?>
<title>Thanh Toán Website #<?=$query['id'];?> - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>     
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
                      <li class="breadcrumb-item" aria-current="page">Order service
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
                        <span class="badge text-bg-success fs-2 fw-semibold">Create Website</span>
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
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-6 me-1" icon="flat-color-icons:money-transfer"></iconify-icon><h6 class="mb-0 fs-4">Gia hạn: <?=Price($query['exprice']);?><sup>đ</sup> /tháng</h6>
                      </div>
                      <hr>
                      <div class="d-sm-flex align-items-center gap-6 pt-8 mb-7">
                      <button data-bs-toggle="modal" data-bs-target="#pop-tool-modal" class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <iconify-icon class="fs-4 me-2" icon="pepicons-pop:cart-circle-filled"></iconify-icon>
                        Tạo Ngay
                      </button>
                      </div>
                      <p class="mb-0">Làm thế nào để vào Admin của shop?</p>
                      <a href="javascript:void(0)">Sau khi tạo website thành công chúng tôi sẽ cung cấp cho bạn tài khoản & mật khẩu Admin!</a>
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
                  <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">
                      Hướng Dẫn
                    </button>
                  </li>
                </ul>
                <div class="tab-content pt-4" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                        <p><?=$query['description'];?></p>
                  </div>
                  <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">
                    <a href="javascript:void(0)">Nếu bạn có tên miền riêng?</a>
                      <p class="mb-0">Nếu đã có tên miền riêng mua từ nơi khác, thì nhập trường chọn đuôi miền bất kì, sau đó trỏ vào 2 Namesever sau và liên hệ CSKH để được duyệt! </p>
                      <p class="mb-0">• Namesever 1: <b class="text-danger"><?=$system['ns1'];?></b></p>
                      <p class="mb-0">• Namesever 2: <b class="text-danger"><?=$system['ns2'];?></b></p>
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
               <div class="modal fade" onchange="check()" id="pop-tool-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h6 class="modal-title" id="myLargeModalLabel">
           Thông Tin Website
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="inputname" class="form-label">Tên Miền</label>
                          <input type="text" class="form-control" id="domain" placeholder="Nhập tên miền">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="inputlname" class="form-label">Đuôi Miền</label>
                         <select class="form-control" id="dot">
                            <option value="">-- Chọn đuôi miền --</option>
                            <?php
  $response = $connect->query("SELECT * FROM Dots");
  foreach($response as $row){
  ?> <option value="<?=$row['dot'];?>"> .<?=$row['dot'];?> - <?=Price($row['price']);?>đ </option> <?php
  } ?>
                         </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                          <label for="inputEmail3" class="form-label">Hạn Dùng</label>
                         <select class="form-control" id="hsd">
                            <option value="">-- Chọn Hạn Sử Dụng --</option>
                            <option value="1">1 Tháng - <?=Price($query['price'] * 1);?>đ </option>
                             <option value="3">3 Tháng - <?=Price($query['price'] * 3);?>đ </option>
                              <option value="5">5 Tháng - <?=Price($query['price'] * 5);?>đ </option>
                               <option value="7">7 Tháng - <?=Price($query['price'] * 7);?>đ </option>
                               <option value="9">9 Tháng - <?=Price($query['price'] * 9);?>đ </option>
                               <option value="12">1 Năm - <?=Price($query['price'] * 12);?>đ </option>
                         </select>
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
          <button id="submit" onclick="build()" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
            Thanh Toán - <span id="tong"> 0 <sup>đ</sup></span>
          </button>
        </div>
      </div>
    </div>
  </div>
    <script>
    function check(){
        var price = '<?=$query['price'];?>';
        var hsd = document.getElementById("hsd").value;
        var dot = document.getElementById("dot").value;
        
        var value_monney = price * hsd;
        
        <?php
        $dots = $connect->query("SELECT * FROM Dots");
        foreach($dots as $row){
        ?>
        
        if(dot == '<?=$row['dot'];?>'){
           var dot_price = <?=$row['price'];?>;
        } else
        
        <?php
        } 
        ?>
        
        { 
            var dot_price = 0;
        }
     
        let tongtien = value_monney + dot_price;
        let vndString = tongtien.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }); 
        let codeflow = vndString.replace('₫', '<sup>đ</sup>'); 
        document.getElementById('tong').innerHTML = codeflow;   
        }
            
      function build(){
          $('#submit').html('Đang xử lý...').prop('disabled', true);
          $.ajax({
            url: "/ajaxs/website.php",
            method: "POST",
            data: {
                domain: $("#domain").val(),
                dot: $("#dot").val(),
                hsd: $("#hsd").val(),
                coupon: $("#coupon").val(),
                id: '<?=$query['id'];?>'
            },
            success: function(response) {
                var data = JSON.parse(response);
                
                swal('Thông Báo', data.message, data.status);
                
                $('#submit').html('Thanh Toán - <span id="tong"> 0 </span>').prop('disabled', false);
                check();
            }
        });
      }
  </script>
<?php include('../app/footer.php'); ?>