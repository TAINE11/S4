<?php include('../app/header.php');
 ?>
<title>Mã Giảm Giá - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">MÃ GIẢM GIÁ</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">
                        Giftcode
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
          <?php
           $gift = $connect->query("SELECT * FROM MaGiamGia");
           foreach($gift as $ptt) {
             $id+=1;
            $tmp = $ptt['max'] - $ptt['sold'];
           ?>
<div class="col-lg-6 d-flex align-items-stretch">
              <div class="d-block w-100">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
   <div class="pb-1 mb-2 border-bottom d-flex align-items-center">
                     <div class="bg-danger-subtle text-danger fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center me-2 fs-6">
                    <iconify-icon class="text-danger" icon="mingcute:coupon-fill"></iconify-icon>
                          </div>  
                        <h6 class="mb-1">MÃ GIẢM GIÁ</h6>
                     
                    </div>
                      <div>
                        <span class="badge bg-primary border text-end">Giảm <?php if($ptt['type'] == 'money'){ echo Price($ptt['amount']).'<sup>đ</sup>'; } else if($ptt['type'] == 'perce'){ echo $ptt['amount'].'%'; }; ?></span>
                      </div>
                    </div>
                    <p class="text-center">Gói: <b class="text-primary"><?=$ptt['service'];?></b></p>
                    <p class="text-center">Lượt dùng còn lại: <b class="text-primary"><?=Price($tmp);?></b></p>
                    <hr>
                    <div class="my-8"></div>
                    <p class="mb-0 text-center"><b>MÃ: </b><b class="text-success ms-1 copyText"><?=$ptt['code'];?><iconify-icon class="fs-4 me-1 text-success" icon="solar:copy-bold-duotone"></iconify-icon></b></p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            </div>
        </div>
      </div>
                  <script>
          document.addEventListener('DOMContentLoaded', function() {
            const copyTextElements = document.querySelectorAll('.copyText');
            const copyButtonElements = document.querySelectorAll('.copyButton');
            function copyToClipboard(text, message) {
              navigator.clipboard.writeText(text).then(() => {
              }).catch(err => {
                
              });
            }
            copyTextElements.forEach(element => {
              element.addEventListener('click', function() {
                const text = element.innerText;
                swal("Thông Báo", "Đã sao chép " + text, "success");
                copyToClipboard(text);
              });
            });
          });
        </script>
<?php include('../app/footer.php'); ?>