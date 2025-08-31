<?php include('../app/header.php'); ?>
<title>Miền Đã Mua - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">MIỀN ĐÃ MUA</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Domain manage
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
             <h5 class="card-title mb-0">Danh Sách Miền</h5>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive mb-4 rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark">
                    <tr>
                      <th>ID</th>
                      <th>Tên Miền</th>
                      <th>NS</th>
                      <th>Hạn Dùng</th>
                      <th>Trạng Thái</th>
                      <th>Ngày Mua</th>
                      <th>Ngày Hết Hạn</th>
                    </tr>
                  </thead>
                  <tbody>
                                  <?php
                                  $query = $connect->query("SELECT * FROM Domain WHERE username = '".$getUser['username']."' ORDER BY id DESC");
                                  foreach($query as $row){
                                      $id+=1;
                                  ?>
                                  
                               <tr>
                                <td> #<?=$id;?> </td>
                                <td><a href="https://<?=($row['domain']);?>" target="_blank"> <?=inHoaString($row['domain']);?> </a></td>
                                <td> <?=$row['ns'];?> </td>
                                <td> <?=$row['hsd'];?> Năm </td>
                                <td> <?=StatusDomain($row['status']);?> </td>
                                <td> <?=ToTime($row['time']);?>  </td>
                                <td><?=ToTime($row['overtime']);?></td>
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
<?php include('../app/footer.php'); ?>