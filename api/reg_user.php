<!-- 教師註冊 -->

<?php
include "./db/base.php";

$acc=trim(strip_tags($_POST['acc']));
$pw=trim($_POST['pw']);
$name=trim($_POST['name']);
$email=trim($_POST['email']);
$last_login=null;

$sql="insert into `users` (`acc`,`pw`,`name`,`email`,`last_login`) values ('$acc','$pw','$name','$email','$last_login')";

echo "acc==>".$acc."<br>";
echo "pw==>".$pw."<br>";
echo "name==>".$name."<br>";
echo "email==>".$email."<br>";

$pdo->exec($sql);
header("location:../login.php");

?>