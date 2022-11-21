<?php
session_start();
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

$acc = $_POST['acc'];
$pw = $_POST['pw'];

$sql = "select count(`id`) from `users` where `acc`='$acc' && `pw`='$pw'";
$chk = $pdo->query($sql)->fetchColumn();
if ($chk == 1) {
    // 有此使用者
    $sql = "select `id`,`acc`,`name`,`last_login` from `users` where `acc`='$acc' && `pw`='$pw'";
    $user=$pdo->query($sql)->fetch();

    $_SESSION['login'] = $user;

    
} else {
    // 查無此使用者
    if(isset($_SESSION['login_try'])){
        $_SESSION['login_try']++;
    }else{

        $_SESSION['login_try']=1;
    }
    header("location:../login.php?error=login");
}
