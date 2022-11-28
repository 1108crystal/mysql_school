<?php
date_default_timezone_set("Asia/Taipei");
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');
session_start();

?>