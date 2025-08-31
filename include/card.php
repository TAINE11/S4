<?php include('../app/header.php'); ?>
	<title>Nạp Thẻ - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
	<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">NẠP THẺ CÀO</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Recharge
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <!-- row -->
          <div class="row">
            <div class="col-12">
              <!-- start Event Registration -->
              <div class="card">
               
                  <div class="card-body">
                    <h5 class="card-title">Nạp Thẻ Cào</h5>
                    <div class="alert bg-danger-subtle text-info alert-dismissible fade show" role="alert">
                      <div class="d-flex align-items-center text-danger">
                      Lưu ý - Nạp thẻ có chiết khấu, Đây là chiết khấu từ trang gạch thẻ tự động lấy phí chứ không phải hệ thống lấy phí nhé, nên đọc trước khi liên hệ hỗ trợ.
                      </div>
                    </div>
                  </div>
                  <div class="card-body border-top">
                    <div class="row">
                      <div class="col-12">
                        <div class="mb-3">
                          <label for="fname3" class="form-label">Mã Thẻ</label>
                          <input type="text" class="form-control" id="pin" placeholder="Nhập mã thẻ">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="mb-3">
                          <label for="title2" class="form-label">Số Serial</label>
                          <input type="text" class="form-control" id="serial" placeholder="Nhập số serial">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="mb-3">
                          <label class="form-label">Loại Thẻ</label>
                          <select class="form-select" id="type">
                          <option value="">-- Chọn loại thẻ --</option>
              		        <option value="VIETTEL">VIETTEL</option>
              		        <option value="MOBIFONE">MOBIFONE</option>
              		        <option value="VINAPHONE">VINAPHONE</option>
              		        <option value="VIETNAMOBILE">VIETNAMOBILE</option>
              		        <option value="ZING">ZING</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="mb-3">
                          <label class="form-label">Mệnh Giá</label>
                      <select class="form-select" id="amount">
                        <option value="">-- Chọn mệnh giá --</option>
                        <option value="10000">10,000đ</option>
                        <option value="20000">20,000đ</option>
                        <option value="30000">30,000đ</option>
                        <option value="50000">50,000đ</option>
                        <option value="100000">100,000đ</option>
                        <option value="200000">200,000đ</option>
                        <option value="300000">300,000đ</option>
                        <option value="500000">500,000đ</option>
                        <option value="1000000">1,000,000đ</option>
                        </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="p-3 border-top">
                    <div class="d-flex flex-wrap gap-6 align-items-center">
                      <div class="ms-auto d-flex flex-wrap gap-6 align-items-center">
                        <div class="btn-group">
                          <button id="napthe" onclick="recharge()" class="btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                            <iconify-icon icon="solar:card-2-bold-duotone" class="fs-4 me-2"></iconify-icon>
                            Nạp Ngay
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                
              </div>
              <!-- end Event Registration -->
            </div>
          </div>
          <div class="row">
            <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-2 align-items-center">
                <div>
                  <h5>Lịch Sử Nạp Thẻ</h5>
                </div>
              </div>
              <div class="table-responsive rounded-1">
                <table class="table text-nowrap customize-table mb-0 align-middle">
                  <thead class="text-dark">
                    <tr>
                      <th>ID</th>
                      <th>Mã Thẻ</th>
                      <th>Serial</th>
                      <th>Loại Thẻ</th>
                      <th>Mệnh Giá</th>
                      <th>Trạng Thái</th>
                      <th>Thời Gian Nạp</th>
                    </tr>
                  </thead>
                  <tbody>
<?php $query = $connect->query("SELECT * FROM DataCard WHERE username = '".$getUser['username']."' ORDER BY id DESC");
      foreach($query as $row){
              $id+=1; ?>
                    <tr>
                      <td><?=$id;?></td>
                      <td><?=$row['pin'];?></td>
                      <td><?=$row['serial'];?></td>
                      <td><?=$row['type'];?></td>
                      <td><?=Price($row['amount']);?><sup>đ</sup></td>
                      <td><?=StatusCard($row['status']);?></td>
                      <td><?=ToTime($row['time']);?></td>
                    </tr>
<?php } ?>
                  </tbody>
                </table>
              </div>
<?php if($id < 1):?>
               <p class="text-center text-black">Không có dữ liệu!</p>
              <?php endif?>
            </div>
          </div>
            </div>
          </div>
          <!-- End row -->
        </div>
      </div>
     <script>
      function recharge(){
          $('#napthe').html('Đang xử lý...').prop('disabled', true);
          $.ajax({
            url: "/ajaxs/recharge.php",
            method: "POST",
            
            data: {
                pin: $("#pin").val(),
                serial: $("#serial").val(),
                amount: $("#amount").val(),
                type: $("#type").val()
            },
                success: function(response) {
                var data = JSON.parse(response);
                
                swal('Thông Báo', data.message, data.status);
                
                if(data.status == 'success'){
                    window.location.href="";
                }
                $('#napthe').html('<iconify-icon icon="solar:card-2-bold-duotone" class="fs-4 me-2"></iconify-icon>Nạp Ngay').prop('disabled', false);
            }
        });
      }
      </script>      
<?php include('../app/footer.php'); ?>