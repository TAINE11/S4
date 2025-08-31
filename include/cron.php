<?php include('../app/header.php'); ?>
<title>Thuê Cron - <?=inHoaString($_SERVER['SERVER_NAME']);?></title>
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <b class="mb-4 mb-md-0 card-title">THUÊ CRONJOBS</b>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="/">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Cronjobs</li>
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
                        <h5 class="card-title">Thuê Cron</h5>
                        <div class="alert bg-danger-subtle text-info alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center text-danger">
                                Sau khi thuê link cron, thì mặc định cron sẽ được duy trì trong 1 tháng.
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="fname3" class="form-label">Link Cron</label>
                                    <input type="text" class="form-control" id="url" placeholder="Nhập link cron">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title2" class="form-label">Số Giây</label>
                                    <input type="number" min="1" id="sogiay" placeholder="Nhập số giây" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Máy Chủ</label>
                                    <select class="form-select" id="server" onchange="tongtien()">
                                        <option value="">Chọn máy chủ</option>
                                        <?php
                                        $server = $connect->query("SELECT * FROM `server_cron_auto`");
                                        foreach ($server as $row) {
                                        ?>
                                        <option value="<?=$row['id'];?>"><?=$row['name'];?> - <?=Price($row['rate']);?>đ</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-top">
                        <div class="d-flex flex-wrap gap-6 align-items-center">
                            <div class="ms-auto d-flex flex-wrap gap-6 align-items-center">
                                <div class="btn-group">
                                    <button id="btn-rent-cron" onclick="recharge()" class="btn mb-1 btn-rounded btn-primary d-flex align-items-center">
    <iconify-icon icon="solar:card-2-bold-duotone" class="fs-4 me-2"></iconify-icon>
    Thuê Ngay
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
                                <h5>Lịch Sử Cron</h5>
                            </div>
                        </div>
                        <div class="table-responsive rounded-1">
                            <table class="table text-nowrap customize-table mb-0 align-middle">
                                <thead class="text-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Link Cron</th>
                                        <th>Số Giây</th>
                                        <th>Máy Chủ</th>
                                        <th>Trạng Thái</th>
                                        <th>Response</th>
                                        <th>Hạn Dùng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = 0;
                                    $query = $connect->query("SELECT * FROM list_cron WHERE username = '".$getUser['username']."' ORDER BY id DESC");
                                    foreach ($query as $row) {
                                        $id += 1; ?>
                                        <tr>
                                            <td><?=$id;?></td>
                                            <td><?=$row['url'];?></td>
                                            <td><?=$row['interval_seconds'];?></td>
                                            <td><?=$row['server_cron'];?></td>
                                            <td><?=StatusCron($row['status']);?></td>
                                            <td><?=$row['response'];?> Lần chạy gần nhất: <?= date('d/m/Y - H:i:s', strtotime($row['last_cron'])); ?></td>
                                            <td><?=ToTime($row['ngay_het']);?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($id < 1): ?>
                        <p class="text-center text-black">Không có dữ liệu!</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
</div>

<script>
function recharge() {
    $('#btn-rent-cron').html('Đang xử lý...').prop('disabled', true);
    
    $.ajax({
        url: "/ajaxs/chaycron.php",
        method: "POST",
        data: {
            server: $('#server').val(),
            url: $('#url').val(),
            sogiay: $('#sogiay').val()
        },
        success: function(response) {
            console.log('Phản hồi từ server:', response); // Kiểm tra phản hồi

            try {
                var data = JSON.parse(response);
                swal('Thông Báo', data.message, data.status);
                if (data.status === 'success') {
                    window.location.href = "/cron";
                }
            } catch (e) {
                console.error('Lỗi phân tích JSON:', e);
                swal('Thông Báo', 'Lỗi xử lý dữ liệu.', 'error');
            }

            $('#btn-rent-cron').html('<iconify-icon icon="solar:card-2-bold-duotone" class="fs-4 me-2"></iconify-icon>Thuê Ngay').prop('disabled', false);
        },
        error: function(xhr, status, error) {
            console.error('Lỗi yêu cầu:', status, error);
            swal('Thông Báo', 'Lỗi yêu cầu: ' + error, 'error');

            $('#btn-rent-cron').html('<iconify-icon icon="solar:card-2-bold-duotone" class="fs-4 me-2"></iconify-icon>Thuê Ngay').prop('disabled', false);
        }
    });
}

</script>

<?php include('../app/footer.php'); ?>
