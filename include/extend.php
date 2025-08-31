<?php
include('../app/header.php');
checkSession();

$query = $connect->query("SELECT * FROM DanhSachWeb WHERE id = '".$_GET['id']."'")->fetch_array();
$products = $connect->query("SELECT * FROM GiaoDien WHERE id = '".$query['theme']."'")->fetch_array();
if($_GET['id'] != $query['id']){
    echo redirect('/');
}
?>
<title>Gia Hạn Website #<?=$query['id'];?> - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>     
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">GIA HẠN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Extend
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

                    <div style="padding-top:5px">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="shop-content">
                      <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge text-bg-success fs-2 fw-semibold">Extend Website</span>
                        <span class="fs-2">#<?=$query['id'];?></span>
                      </div>
                      <h4><?=inHoaString($query['domain']);?></h4>
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
                      </div>
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-7 me-1 text-success" icon="solar:wallet-money-bold"></iconify-icon><h6 class="mb-0 fs-4">Giá Tiền: <?=Price($query['price']);?><sup>đ</sup></h6>
                      </div>
                      <div style="padding-bottom:4px" class="d-flex">
                        <iconify-icon class="fs-7 me-1 text-warning" icon="solar:cart-4-bold"></iconify-icon><h6 class="mb-0 fs-4">Gia Hạn: <?=Price($query['exprice']);?></h6>
                      </div>                  
                      <hr>
                      <div class="d-sm-flex align-items-center gap-6 pt-8 mb-7">
                      <button data-bs-toggle="modal" data-bs-target="#pop-tool-modal" class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                        <iconify-icon class="fs-4 me-2" icon="pepicons-pop:cart-circle-filled"></iconify-icon>
                        Gia Hạn
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
               <div class="modal fade" onchange="check()" id="pop-tool-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h6 class="modal-title" id="myLargeModalLabel">
           Gia Hạn Website
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                          <label for="inputname" class="form-label">Tên Miền</label>
                          <input type="text" class="form-control" value="<?=inHoaString($query['domain']);?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                          <label for="inputEmail3" class="form-label">Hạn Dùng</label>
                         <select class="form-control" id="hsd">
<option value="0">-- Chọn Hạn Sử Dụng --</option>
                      <option value="1">1 Tháng (<?=Price($products['price'] * 1);?>đ)</option>
                      <option value="2">2 Tháng (<?=Price($products['price'] * 2);?>đ)</option>
                      <option value="3">3 Tháng (<?=Price($products['price'] * 3);?>đ)</option>
                      <option value="4">4 Tháng (<?=Price($products['price'] * 4);?>đ)</option>
                      <option value="5">5 Tháng (<?=Price($products['price'] * 5);?>đ)</option>
                      <option value="6">6 Tháng (<?=Price($products['price'] * 6);?>đ)</option>
                      <option value="7">7 Tháng (<?=Price($products['price'] * 7);?>đ)</option>
                      <option value="8">8 Tháng (<?=Price($products['price'] * 8);?>đ)</option>
                         </select>
                        </div>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="justify-content-center btn mb-1 btn-rounded btn-dark d-flex align-items-center" data-bs-dismiss="modal">
            Hủy
          </button>
          <button id="thanhtoan" onclick="submit()" class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
            Thanh Toán - <span id="tong"> 0 <sup>đ</sup></span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function check(){
    var price = '<?=$products['price'];?>';
        var hsd = document.getElementById("hsd").value;
        
        let tongtien = price * hsd;
        let vndString = tongtien.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }); 
        let codeflow = vndString.replace('₫', ''); 
        document.getElementById('tong').innerHTML = codeflow;   
        }
        
        
    function submit(){
          $('#thanhtoan').html('Đang xử lí...').prop('disabled', true);
          $.ajax({
            url: "/ajaxs/extend.php",
            method: "POST",
            data: {
                
                hsd: $("#hsd").val(),
                id: '<?=$query['id'];?>'
            },
            success: function(response) {
                var data = JSON.parse(response);
                
                swal('Thông Báo', data.message, data.status);
                
                $('#thanhtoan').html('Thanh Toán - <span id="tong"> 0 <sup>đ</sup></span>').prop('disabled', false);
                check();
            }
        });
      }
      
</script>

<?php include('../app/footer.php'); ?>