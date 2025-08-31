<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Cron List </h4>
                            </div>
                        </div>
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
                                                    <th> Người Thuê </th>
                                                    <th> URL </th>
                                                    <th> Server </th>
                                                    <th> Số Giây </th>
                                                    <th>Trạng Thái</th>
                                                    <th> MGD </th>
                                                    <th>Ngày Thuê</th>
                                                    <th>Ngày Hết Hạn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                    $query = $connect->query("SELECT * FROM list_url_cron");
                                                    foreach($query as $row){

                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['chunhan'];?></td>
                                                    <td> <?=$row['url'];?> </td>
                                                    <td><?=$row['id_server'];?></td>
                                                    <td> <?=$row['sogiay'];?></td>
                                                    <td>
                                                      <?=StatusCron($row['trangthai']);?>
                                                    </td>
                                                    <td> <?=$row['magd'];?></td>
                                                    <td> <?=ToTime($row['ngay_mua']);?></td>
                                                    <td> <?=ToTime($row['ngay_het']);?></td>
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