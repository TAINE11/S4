<?php
include('../app/config.php');
$domain = $_GET['domain'];
$_SESSION['domain'] = $domain;
echo redirect('/paydomain');
?>