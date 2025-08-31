<?php include('../app/header.php');
checkSession(); ?>

<title>Lấy Link Hình Ảnh - <?= inHoaString($_SERVER['SERVER_NAME']); ?></title>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <b class="mb-4 mb-md-0 card-title">Lấy Link Hình Ảnh</b>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                      <li class="breadcrumb-item d-flex align-items-center">
                        <a class="text-muted text-decoration-none d-flex" href="/">
                            <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                         </a>
                        </li>
                                <li class="breadcrumb-item" aria-current="page">Lấy Link Hình Ảnh</li>
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
                            <h5 class="mb-3">Lấy Link Hình Ảnh</h5>

                            <!-- Form Upload Hình Ảnh -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Chọn hình ảnh để upload</label>
                                    <input type="file" name="image" class="form-control" id="image" required>
                                </div>
                                <button type="submit" name="upload" class="btn btn-primary">Upload và Lấy Link</button>
                            </form>

                            <!-- Ô riêng để hiển thị link hình ảnh và nút sao chép -->
                            <div id="image-link-box" class="mt-4 p-3 border border-info rounded" style="display: none;">
                                <h6 class="text-info">Link hình ảnh:</h6>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" id="copy-button">Sao chép</button>
                                    <input type="text" class="form-control" id="image-link" readonly>
                                </div>
                            </div>

                            <!-- Thông báo Toast -->
                            <div id="toast-notification" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 1050; display: none;">
                                <div class="toast-body hstack align-items-start gap-6">
                                    <iconify-icon icon="gridicons:notice" class="fs-6"></iconify-icon>
                                    <div>
                                        <h5 class="text-white fs-3 mb-1">Thông báo</h5>
                                        <h6 class="text-white fs-2 mb-0">Đã sao chép link thành công!</h6>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>

                            <?php
                            if (isset($_POST['upload'])) {
                                // Client ID từ Imgur
                                $client_id = '3352c129079eb4b'; //

                                // Đọc file ảnh
                                $image = file_get_contents($_FILES['image']['tmp_name']);
                                $image_base64 = base64_encode($image);

                                // Gửi yêu cầu POST lên API của Imgur
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
                                curl_setopt($ch, CURLOPT_POST, TRUE);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
                                curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => $image_base64));

                                // Lấy phản hồi từ Imgur
                                $response = curl_exec($ch);
                                curl_close($ch);

                                // Giải mã JSON trả về
                                $data = json_decode($response, true);

                                if ($data['success']) {
                                    // Link hình ảnh
                                    $image_link = $data['data']['link'];
                                    echo "<script>
                                            document.getElementById('image-link-box').style.display = 'block';
                                            document.getElementById('image-link').value = '$image_link';
                                          </script>";
                                } else {
                                    echo "<p class='mt-3 text-danger'>Upload thất bại!</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Hàm sao chép link vào clipboard và hiển thị thông báo
    document.getElementById('copy-button').addEventListener('click', function() {
        var copyText = document.getElementById('image-link');
        copyText.select();
        document.execCommand('copy');
        
        // Hiển thị toast thông báo
        var toast = document.getElementById('toast-notification');
        toast.style.display = 'block';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 3000);
    });
</script>

<?php include('../app/footer.php'); ?>
