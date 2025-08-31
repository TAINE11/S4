<?php
include('../app/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    
    $query = $connect->query("SELECT * FROM DanhSachHost WHERE id = '$id' AND username = '".$getUser['username']."'")->fetch_array();
    $getName = $connect->query("SELECT * FROM Server WHERE uname = '".$package['server']."'")->fetch_array();

    if ($type == 'reset') {
        $username = $query['taikhoan'];
        $domain = $query['domain'];
        
        // WHM API credentials
        $whm_server = 'https://103.252.137.101:2087';
        $whm_user = 'cmuahostvn';
        $whm_token = 'XQNZ7MMP4GKSLSDC49HYM1YBA3CJ096A';
        
        $command = 'removeacct';
        $params = [
            'username' => $username,
        ];
        
        $url = "$whm_server/json-api/$command?" . http_build_query($params);
        
        $headers = [
            'Authorization: whm ' . $whm_user . ':' . $whm_token
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo json_api('Lỗi cURL: ' . curl_error($ch), 'error');
            curl_close($ch);
            exit;
        }

        curl_close($ch);
        
        $resultData = json_decode($result, true);
        
        if (!$resultData) {
            echo json_api('Lỗi khi giải mã JSON từ WHM API: ' . json_last_error_msg(), 'error');
            echo '<pre>' . htmlspecialchars($result) . '</pre>';
        } elseif (isset($resultData['status']) && $resultData['status'] == 1) {
            // If account removal is successful, recreate the account
            $command = 'createacct';
            $params = [
                'username' => $username,
                'domain' => $domain,
                'password' => $query['matkhau'],
                'plan' => $query['package'],
                'contactemail' => $query['email']
            ];
            
            $url = "$whm_server/json-api/$command?" . http_build_query($params);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            
            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                echo json_api('Lỗi cURL: ' . curl_error($ch), 'error');
                curl_close($ch);
                exit;
            }

            curl_close($ch);
            
            $resultData = json_decode($result, true);
            
            if (isset($resultData['status']) && $resultData['status'] == 1) {
                echo json_api('Đặt lại Hosting thành công','success');
            } else {
                echo json_api('Đặt lại Hosting thất bại!','error');
                echo '<pre>' . htmlspecialchars($result) . '</pre>';
            }
        } else {
            echo json_api('WHM API trả về lỗi: ' . htmlspecialchars($result), 'error');
        }
    }
}
?>