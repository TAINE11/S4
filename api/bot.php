<?php
$botToken = '6753889346:AAEZRyaZJrL7JqDrmA-iH2CYSWKnQLhq99s'; // Token của bot Telegram 
$webhookUrl = 'https://'.$_SERVER['SERVER_NAME'].'/api/bdt.php';

$url = "https://api.telegram.org/bot$botToken/setWebhook?url=$webhookUrl";

$response = file_get_contents($url);
echo $response;
?>