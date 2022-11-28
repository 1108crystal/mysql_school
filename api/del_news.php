<?php

include "../db/base.php";

$pdo->exec("delete from `news` where `id`='{$_GET['id']}' ");
// $sql="delete from `news` where `id`='{$_GET['id']}'";
// echo $sql;
header("location:../admin_center.php?do=news");

?>