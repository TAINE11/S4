<?php include('../app/header.php');
checkSession(); ?>
<title>Chuyển Khoản - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">CHUYỂN KHOẢN</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Banks
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
        <?php 
        $query = $connect->query("SELECT * FROM Banks");
        foreach($query as $row){
        ?>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                              <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                <img src="<?=$row['image'];?>" class="d-block fs-7" width="65" height="50" alt="Banks">
                              </div>
                              <div>
                                <h5 class="fs-4 fw-semibold"><?=$row['name'];?></h5>  
                                <span style="padding-top:3px">Tối thiểu: <?=Price($row['toithieu']);?><sup>đ</sup></span>
                              </div>
                            </div>
                            <hr>
                    <ul>
                      <li class="py-2">
                        <p class="fw-normal text-dark mb-0">
                          Số Tài Khoản:
                          <span class="copyText"><b class="text-dark ms-1"><?=$row['sotaikhoan'];?></b><iconify-icon class="fs-4 me-1 text-dark" icon="solar:copy-bold-duotone"></iconify-icon></span>
                        </p>
                      </li>
                      <li class="py-2">
                        <p class="fw-normal text-dark mb-0">
                          Chủ Tài Khoản:
                         <b class="text-dark ms-1"><?=$row['chutaikhoan'];?></b>
                        </p>
                      </li>
                      <li class="py-2">
                        <p class="fw-normal text-dark mb-0">
                          Nội Dung:
                          <span class="copyText"><b class="text-danger ms-1">naptien<?=$getUser['id'];?></b><iconify-icon class="fs-4 me-1 text-danger" icon="solar:copy-bold-duotone"></iconify-icon></span>
                        </p>
                      </li>
                    </ul>
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