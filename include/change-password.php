<?php include('../app/header.php'); ?>
<title>Đổi Mật Khẩu - <?= inHoaString($_SERVER['SERVER_NAME']); ?></title>
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <b class="mb-4 mb-md-0 card-title">ĐỔI MẬT KHẨU</b>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="/">Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Change password
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
                        <h5 class="card-title">Đổi Mật Khẩu</h5>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="fname3" class="form-label">Mật Khẩu Hiện Tại</label>
                                    <input type="password" class="form-control" id="oldpass" placeholder="Nhập mật khẩu hiện tại">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title2" class="form-label">Nhập Mật Khẩu Mới</label>
                                    <input type="password" id="newpass" placeholder="Nhập mật khẩu mới" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title2" class="form-label">Xác Nhận Mật Khẩu Mới</label>
                                    <input type="password" id="renewpass" placeholder="Nhập lại mật khẩu mới" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-top">
                        <div class="d-flex flex-wrap gap-6 align-items-center">
                            <div class="ms-auto d-flex flex-wrap gap-6 align-items-center">
                                <div class="btn-group">
                                    <button id="change" onclick="change()" class="btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                                        Đổi Mật Khẩu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Event Registration -->
            </div>
        </div>
    </div>
</div>

<script>
function change() {
    $('#change').html('Đang xử lý...').prop('disabled', true);
    $.ajax({
        url: "/ajaxs/auth.php",
        method: "POST",
        data: {
            type: 'change-password',
            oldpass: $("#oldpass").val(),
            newpass: $("#newpass").val(),
            renewpass: $("#renewpass").val()
        },
        success: function(response) {
            var data = JSON.parse(response);
            swal('Thông Báo', data.message, data.status);
            if (data.status == 'success') {
                window.location.href = "/change-password";
            }
            $('#change').html('Đổi Mật Khẩu').prop('disabled', false);
        }
    });
}
</script>

<?php include('../app/footer.php'); ?>
