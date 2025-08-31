<?php
include('layouts/header.php');
?>


<div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"> Danh Sách Hosting </h4>
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
                                                    <th> Tên Miền </th>
                                                    <th> Gói </th>
                                                    <th> Thời Gian Mua </th>
                                                    <th> Thời Gian Hết Hạn </th>
                                                    <th> Trạng Thái </th>
                                                    <th> Hành Động </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $query = $connect->query("SELECT * FROM DanhSachHost");
                                                foreach($query as $row){
                                                    $server = $connect->query("SELECT * FROM Server WHERE uname = '".$row['server']."'")->fetch_array();
                                                ?>
                                                
                                                <tr>
                                                    <td> #<?=$row['id'];?></td>
                                                    <td><?=$row['username'];?></td>
                                                    <td><?=$row['domain'];?></td>
                                                    <td><?=$row['package'];?></td>
                                                    <td><?=ToTime($row['time']);?></td>
                                                    <td><?=ToTime($row['orvertime']);?></td>
                                                    <td><?=StatusHost($row['status']);?></td>
                                                    <td> <span onclick="xoaHosting(<?=$row['id'];?>)" class="badge bg-pink"> Xóa </span> <span onclick="window.open('<?=$server['hostname'];?>:2083/login/?user=<?=$row['taikhoan'];?>&pass=<?=$row['matkhau'];?>');" class="badge bg-info"> Truy Cập Cpanel </span> </td>
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
        
       <script>
            function xoaHosting(id){
                swal({
                  title: "Xác nhận?",
                  text: "Bạn có chắc chắn muốn xóa hosting này?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location.href="?delete_cpanel=" + id;
                  }
                });
            }
        </script>
        
<?php
if(isset($_GET['delete_cpanel'])){
    $getCpanel = $connect->query("SELECT * FROM DanhSachHost WHERE id = '".$_GET['delete_cpanel']."'")->fetch_array();
    $getName = $connect->query("SELECT * FROM Server WHERE uname = '".$getCpanel['server']."'")->fetch_array();
    
    $query = $getName['hostname'].':2087/json-api/removeacct?api.version=1&user='.$getCpanel['taikhoan'].'&password='.$getCpanel['matkhau'].'&enabledigest=0&db_pass_update=1';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_HEADER,0); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); 
    $header[0] = "Authorization: Basic " . base64_encode($getName['whmusername'].":".$getName['whmpassword']) . "\n\r";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($curl, CURLOPT_URL, $query); 
    $result = curl_exec($curl); 
    $result = curl_exec($curl);
    if ($result == false) {
        echo 'Không Thể Kết Nối Đến CPANEL';
    } else {
        $inTrue = $connect->query("DELETE FROM `DanhSachHost` WHERE `id` = '".$_GET['delete_cpanel']."'");
        if($inTrue){
            echo swal('Xóa Hosting '.$getCpanel['domain'].' thành công!');
            echo redirect('');
        } else {
            echo swal('Không thể lưu dữ liệu, đã xóa hosting '.$getCpanel['domain']);
        }
    }
}
include('layouts/footer.php');
?>