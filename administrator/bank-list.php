<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Lịch Sử Nạp Tiền Qua Momo </h4>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong> Chú Ý - </strong> Bạn Cần Chạy Link Cron Sau Để Hệ Thống Có Thể Nạp Giao Dịch Mới<br><br>
                            <div class="form-control"> https://<?=$_SERVER['SERVER_NAME'];?>/api/cron.php </div>
                        </div>
                        
                                    
                   <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Mã Giao Dịch </th>
                                                    <th> Mệnh Giá </th>
                                                    <th> Nội Dung </th>
                                                    <th> Người Nạp </th>
                                                    <th> Thời Gian </th>
                                                    <th> Trạng Thái </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                    $query = $connect->query("SELECT * FROM TranIDMomo ORDER BY id DESC");
                                                    foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['requestid'];?></td>
                                                    <td><?=Price($row['amount']);?> <sup>đ</sup></td>
                                                    <td><?=$row['comment'];?></td>
                                                    <td><?=$row['nameBank'];?></td>
                                                    <td><?=ToTime($row['time']);?></td>
                                                    <td><?=StatusMomo($row['status']);?></td>
                                                </tr>
            
                                            <?php } ?>
                                            
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>   
                                
                            </div>
                        
                        </div>
                     
                    </div>
                    
                    
                </div> 

            </div> 
        </div>
        
        
<?php
include('layouts/footer.php');
?>