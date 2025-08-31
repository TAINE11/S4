<?php include('../app/header.php');
checkSession();
// Truy vấn dữ liệu
$sql = "SELECT * FROM Withdrawal_history";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Truy vấn không thành công: " . mysqli_error($connect));
}
?>
<title>Lịch Sử Rút Tiền - <?= htmlspecialchars($_SERVER['SERVER_NAME']); ?></title>
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <b class="mb-4 mb-md-0 card-title">Lịch Sử Rút Tiền</b>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                                <li class="breadcrumb-item" aria-current="page">Withdraw</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title mb-0">Danh Sách</h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive mb-4 rounded-1">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark">
                            <tr>
                                <th>ID</th>
                                <th>Người Rút</th>
                                <th>Ngân Hàng</th>
                                <th>Số Tài Khoản</th>
                                <th>Chủ Tài Khoản</th>
                                <th>Số Tiền Rút</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Rút</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['user_id']}</td>";
                                    echo "<td>{$row['bank_name']}</td>";
                                    echo "<td>{$row['account_number']}</td>";
                                    echo "<td>{$row['account_holder_name']}</td>";
                                    echo "<td>{$row['withdrawal_amount']}</td>";
                                    echo "<td>{$row['status']}</td>";
                                    echo "<td>{$row['withdrawal_date']}</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>Không có dữ liệu!</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../app/footer.php'); ?>

<?php
// Đóng kết nối
mysqli_close($connect);
?>