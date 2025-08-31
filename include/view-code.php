<?php include('../app/header.php'); ?>
<?php checkSession(); ?>

<title>Xem Mã Nguồn - <?= htmlspecialchars($_SERVER['SERVER_NAME']); ?></title>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <b class="mb-4 mb-md-0 card-title">Xem Mã Nguồn</b>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="/">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Xem Mã Nguồn</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border">
                        <div class="card-body">
                            <h5 class="mb-3">Xem Mã Nguồn HTML</h5>

                            <!-- Form Nhập URL -->
                            <form action="view-code.php" method="GET" class="mb-4">
                                <div class="mb-3">
                                    <label for="url" class="form-label">Nhập URL</label>
                                    <input type="text" name="url" id="url" class="form-control" placeholder="Nhập URL" value="<?= htmlspecialchars($_GET['url'] ?? ''); ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Xem Mã Nguồn</button>
                            </form>

                            <!-- Ô riêng để hiển thị mã nguồn HTML và nút sao chép -->
                            <?php if (isset($_GET['url']) && !empty($_GET['url'])): ?>
                                <?php
                                $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
                                if (filter_var($url, FILTER_VALIDATE_URL)) {
                                    $html = @file_get_contents($url);
                                    if ($html !== FALSE) {
                                        echo '<h6 class="text-info">Mã nguồn HTML:</h6>';
                                        echo '<div class="code-box">';
                                        echo '<textarea id="html-code" readonly>' . htmlspecialchars($html) . '</textarea>';
                                        echo '</div>';
                                        echo '<button class="btn btn-outline-secondary mt-2" id="copy-button">Sao Chép</button>';
                                    } else {
                                        echo '<p class="mt-3 text-danger">Không thể lấy mã nguồn từ URL.</p>';
                                    }
                                } else {
                                    echo '<p class="mt-3 text-danger">URL không hợp lệ.</p>';
                                }
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .code-box {
        border: 1px solid #ddd;
        padding: 15px;
        background-color: #f8f9fa;
        overflow-x: auto;
    }

    #html-code {
        width: 100%;
        height: 300px;
        border: none;
        background-color: #f8f9fa;
        overflow-y: auto;
    }
</style>

<script>
    // Hàm sao chép mã nguồn vào clipboard
    document.getElementById('copy-button').addEventListener('click', function() {
        var copyText = document.getElementById('html-code');
        copyText.select();
        document.execCommand('copy');

        // Hiển thị thông báo sao chép thành công
        alert('Mã nguồn đã được sao chép vào clipboard!');
    });
</script>

<?php include('../app/footer.php'); ?>
