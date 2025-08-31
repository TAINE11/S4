<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Code Đã Bán </h4>
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
                                                    <th> Người Mua </th>
                                                    <th> Tên Code </th>
                                                    <th> Thời Gian Mua </th>
                                                    <th> Link Tải </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                    $query = $connect->query("SELECT * FROM DanhSachCode");
                                                    foreach($query as $row){
                                                        $theme = $connect->query("SELECT * FROM MaNguon WHERE id = '".$row['theme']."'")->fetch_array();
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['username'];?></td>
                                                    <td> <a href="/order-code/<?=$theme['id'];?>" target="_blank"><?=$theme['name'];?></a> </td>
                                                    <td><?=ToTime($row['time']);?></td>
                                                    <td> <a href="<?=$theme['linkcode'];?>" class="btn btn-info"> Tải Code </a> </td>
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