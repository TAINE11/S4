<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Danh Sách Thẻ Cào </h4>
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
                                                    <th> Người Nạp </th>
                                                    <th> Mã Thẻ </th>
                                                    <th> Mã Serial </th>
                                                    <th> Amount </th>
                                                    <th> Type </th>
                                                    <th> Thời Gian </th>
                                                    <th> Trạng Thái </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                    $query = $connect->query("SELECT * FROM DataCard ORDER BY id DESC");
                                                    foreach($query as $row){
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['username'];?></td>
                                                    <td><?=$row['pin'];?></td>
                                                    <td><?=$row['serial'];?></td>
                                                    <td><?=Price($row['amount']);?><sup>đ</sup></td>
                                                    <td><?=$row['type'];?></td>
                                                    <td><?=ToTime($row['time']);?></td>
                                                    <td><?=StatusCard($row['status']);?></td>
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