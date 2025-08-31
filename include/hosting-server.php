<?php include('../app/header.php'); ?>
<title>Server Hosting - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">SERVER HOSTING</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Packages
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
                   <?php 
              if(!isset($_GET['server'])){
                  $getName = $connect->query("SELECT * FROM Server")->fetch_array();
                  $query = $connect->query("SELECT * FROM HostPackage WHERE server = '".$getName['uname']."'");
              } else {
                  $getName = $connect->query("SELECT * FROM Server WHERE uname = '".$_GET['server']."'")->fetch_array();
                  $query = $connect->query("SELECT * FROM HostPackage WHERE server = '".$getName['uname']."'");
              }
              
              foreach($query as $row){
              ?>     
            <div class="col-sm-6 col-lg-4">
              <div class="card">
                <div class="card-body pt-6">
                                  <div class="text-end">
                    <span class="badge fw-bolder py-1 bg-warning-subtle text-warning text-uppercase fs-2 rounded-3">CPANEL</span>
                  </div>
                  <span class="fw-bolder text-uppercase fs-3 d-block mb-7">GÓI <?=inHoaString($row['package']);?></span>
                  <div class="my-4">
                    <img src="https://www.hyyat.com/zasogooh/2019/04/cPanel-logo.png.webp" alt="Package" class="img-fluid" width="80" height="80">
                    </div>
                  <h5 class="fw-bolder mb-3"><?=Price($row['price']);?><sup>đ</sup> /30 ngày</h5>
                  <ul class="list-unstyled mb-7">
                    <li class="d-flex align-items-center gap-2 py-2">
                      <i class="ti ti-check text-primary fs-4"></i>
                      <span class="text-dark">Dung Lượng: <b><?=$row['disk'];?> MB</b></span>
                    </li>
                    <li class="d-flex align-items-center gap-2 py-2">
                      <i class="ti ti-check text-primary fs-4"></i>
                      <span class="text-dark">Băng Thông: <b><?=$row['bandwidth'];?></b></span>
                    </li>
                    <li class="d-flex align-items-center gap-2 py-2">
                      <i class="ti ti-check text-primary fs-4"></i>
                      <span class="text-dark">Miền Khác: <b><?=$row['addondomain'];?></b></span>
                    </li>
                    <li class="d-flex align-items-center gap-2 py-2">
                      <i class="ti ti-check text-primary fs-4"></i>
                      <span class="text-dark">Miền Bí Danh: <b><?=$row['subdomain'];?></b></span>
                    </li>
                    <li class="d-flex align-items-center gap-2 py-2">
                      <i class="ti ti-check text-primary fs-4"></i>
                      <span class="text-dark">Backup: <b><?=$getName['backup'];?></b></span>
                    </li>
                    <li class="d-flex align-items-center gap-2 py-2">
                      <i class="ti ti-check text-primary fs-4"></i>
                      <span class="text-dark">SSL: <b><?php if($getName['ssl_key'] == 'true_ssl'){ echo 'Miễn Phí Chứng Chỉ SSL'; } else { echo 'Không Có Sẵn'; } ;?></b></span>
                    </li>
                  </ul>
                  <button onclick="buy(<?=$row['id'];?>)" class="btn btn-primary fw-bolder py-6 w-100 text-capitalize">Mua Ngay</button>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
<script>
      
      
      function buy(url){
          window.location.href="/order-hosting/" + url;
      }
</script>
<?php include('../app/footer.php'); ?>