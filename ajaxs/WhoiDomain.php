<?php
include('../app/config.php');

$domain = AntiXss($_POST['domain']);
$explode = explode(".", $domain);
$query = $connect->query("SELECT * FROM DomainPackages WHERE name = '".$explode[1]."'")->fetch_array();

if(empty($explode[0])){
    echo swal('Vui lòng nhập miền hợp lệ','error');
} else if(empty($explode[1])){
    
        $checkQuery = $connect->query("SELECT * FROM DomainPackages WHERE name != '".$explode[1]."'");
            foreach($checkQuery as $row){
                $domain = $explode[0].'.'.$row['name'];
                if (isDomainRegistered($domain)) {
                     echo resultDomain($domain,$row['price'], 'true');
                } else {
                    echo resultDomain($domain,$row['price'], 'false');
                }
            }
            
} else if($explode[1] == $query['name']){
    
    if(isDomainRegistered($domain)){
        echo resultDomain($domain,$query['price'], 'true');
        
        $checkQuery = $connect->query("SELECT * FROM DomainPackages WHERE name != '".$explode[1]."'");
            foreach($checkQuery as $row){
                $domain = $explode[0].'.'.$row['name'];
                if (isDomainRegistered($domain)) {
                     echo resultDomain($domain,$row['price'], 'true');
                } else {
                    echo resultDomain($domain,$row['price'], 'false');
                }
            }
    
    } else {
        echo resultDomain($domain,$query['price'], 'false');
        
        $checkQuery = $connect->query("SELECT * FROM DomainPackages WHERE name != '".$explode[1]."'");
            foreach($checkQuery as $row){
                $domain = $explode[0].'.'.$row['name'];
                if (isDomainRegistered($domain)) {
                     echo resultDomain($domain,$row['price'], 'true');
                } else {
                    echo resultDomain($domain,$row['price'], 'false');
                }
            }
    }  
    
    } else {
        echo resultDomain($domain,$query['price'], 'null');
        
        $checkQuery = $connect->query("SELECT * FROM DomainPackages WHERE name != '".$explode[1]."'");
            foreach($checkQuery as $row){
                $domain = $explode[0].'.'.$row['name'];
                if (isDomainRegistered($domain)) {
                     echo resultDomain($domain,$row['price'], 'true');
                } else {
                    echo resultDomain($domain,$row['price'], 'false');
                }
            }
    }
?>