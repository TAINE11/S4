<?php include('../app/header.php'); ?>
<title>Website Đã Tạo - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card card-body py-3">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                  <b class="mb-4 mb-md-0 card-title">WEBSITE ĐÃ TẠO</b>
                  <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                      <li class="breadcrumb-item" aria-current="page">Website manage
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
             <h5 class="card-title mb-0">Danh Sách Website</h5>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive mb-4 rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark">
                    <tr>
                      <th>ID</th>
                      <th>Tên Miền</th>
                      <th>Giá</th>
                      <th>Thông Tin Admin</th>
                      <th>Ngày Tạo</th>
                      <th>Ngày Hết Hạn</th>
                      <th>Trạng Thái</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $query = $connect->query("SELECT * FROM DanhSachWeb WHERE username = '".$getUser['username']."'");
                        foreach($query as $row){
                        $id+=1;
                        ?>
                    <tr>
                      <td><?=$id;?></td>
                      <td><a class="text-primary" href="//<?=$row['domain'];?>"><?=$row['domain'];?></a></td>
                      <td><?=Price($row['price']);?><sup>đ</sup></td>
                      
                      <td><?=$row['useradmin'];?> / <?=$row['password'];?></td>
                      <td><?=ToTime($row['time']);?></td>
                      <td><?=ToTime($row['orvertime']);?></td>
                      <td><?=StatusWeb($row['status']);?></td>
                      <td><span onclick="window.location.href='/extend/<?=$row['id'];?>';" class="mb-1 badge text-bg-dark">Gia hạn</span></td>
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