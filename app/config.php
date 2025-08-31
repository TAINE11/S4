<?php
session_start();

$localhost = 'localhost';
$database = 'localhost';
$userbase = 'localhost';
$passbase = 'localhost';

$connect = mysqli_connect($localhost, $database, $userbase, $passbase) or die('Unable to connect to database, contact author for support!');;
$connect->query("SET NAMES 'UTF8'");
date_default_timezone_set('Asia/Ho_Chi_Minh'); 

if(isset($_SESSION['users'])){
    $getUser = $connect->query("SELECT * FROM Users WHERE username = '".$_SESSION['users']."'")->fetch_array();
    if($_SESSION['users'] != $getUser['username']){
        unset($_SESSION['users']);
    }
    
    $connect->query("UPDATE `Users` SET `date_online`='".time()."'WHERE username = '".$getUser['username']."'");
}

$botToken = '6753889346:AAEZRyaZJrL7JqDrmA-iH2CYSWKnQLhq99s'; //Token của bot Telegram
$chatId = '1733329974'; // chat ID của bot Telegram 
include('function.php');
$system = $connect->query("SELECT * FROM System WHERE id = '1'")->fetch_array();
?>