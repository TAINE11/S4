<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Cài Đặt </h4>
                            </div>
                        </div>
                    </div>
                    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title"> Thông Tin Trang Web </h4>
                </div>
    
                <div class="card-body">
                    <div class="needs-validation" novalidate="">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="name"> Tiêu Đề </label>
                                    <input type="text" class="form-control" id="title" placeholder="Tiêu Đề" value="<?=$system['title'];?>">
                                </div>
    
                                <div class="col-6">
                                    <label class="form-label" for="uname"> Mô tả trang web </label>
                                    <input type="text" class="form-control" id="description" placeholder="Mô tả trang web"  value="<?=$system['description'];?>">
                                      </div>
                                </div>
                             
                            </div>
                        </div>
    
                        <br><div class="mb-3">
                            <div class="row">
    
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername"> Keywords </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="keywords" placeholder="Keywords"  value="<?=$system['keywords'];?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername">Facebook Hỗ Trợ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="facebook" placeholder="Facebook Hỗ Trợ"  value="<?=$system['facebook'];?>">
                                    </div>
                                </div>
                             
                            </div>
                        </div>
    
                        <br><div class="mb-3">
                            <div class="row">
    
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername">Telegram Hỗ Trợ </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="telegram" placeholder="Telegram Hỗ Trợ"  value="<?=$system['telegram'];?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername"> Nhóm Zalo </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="zalo_group" placeholder="Nhóm Zalo"  value="<?=$system['zalo_group'];?>">
                                    </div>
                                </div>
                             
                            </div>
                        </div>
    
                        <br><div class="mb-3">
                            <div class="row">
    
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername"> Logo </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="logo" placeholder=""  value="<?=$system['logo'];?>">
                                    </div>
                                    </div>
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername"> Ảnh Mô Tả </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="image" placeholder=""  value="<?=$system['image'];?>">
                                    </div>
                                </div>
                             
                            </div>
                        </div>
    
                        <br><div class="mb-3">
                            <div class="row">
    
                                <div class="col-6">
                                    <label class="form-label" for="validationCustomUsername"> Shortcut Icon </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="shortcut" placeholder=""  value="<?=$system['shortcut'];?>">
                                    </div>
                                    
                                </div>
                            </div>
                        
                        <br><div class="mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label" for="validationCustomUsername">  Thông Báo Trang chủ ( chưa sửa ) </label>
                                    <div class="input-group">
                                        <textarea id="modal" class="form-control" rows="4" cols="50"><?=$system['modal'];?></textarea>
                                    </div>
                                </div>
                        


    
                      
                      
    
                               
                            </div>
                        </div>
                            </div>
                        </div>
    
    
                        <button class="btn btn-primary" onclick="ThemMayChu()"> Cập Nhật </button>
                    </div>
                </div>
            </div>
        </div>
       
    
                    </div> 
    
                </div> 
            </div>
            
            
          
            

            <script>
                function ThemMayChu(){
                      $.ajax({
                        url: "/administrator/ajaxs/system.php",
                        method: "POST",
                        data: {
                            type: 'setting',
                            title: $("#title").val(),
                            description: $("#description").val(),
                            keywords: $("#keywords").val(),
                            facebook: $("#facebook").val(),
                            telegram: $("#telegram").val(),
                            zalo_group: $("#zalo_group").val(),
                            logo: $("#logo").val(),
                            image: $("#image").val(),
                            shortcut: $("#shortcut").val(),
                            modal: $("#modal").val(),
                        },
                        success: function(response) {
                           $("#msg").html(response);
                           console.log(response);
                        }
                    });
                }
                
                
            </script>
            
<?php
include('layouts/footer.php');
?>