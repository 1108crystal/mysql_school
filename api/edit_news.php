<?php

include "../db/base.php";
$sql="update  `news` set 
    `subject`='{$_POST['subject']}',
    `content`='{$_POST['content']}',
    `type`='{$_POST['type']}',
    `readed`='{$_POST['readed']}',
    `top`='{$_POST['top']}'
    where `id`={$_POST['id']}
";

    $pdo->exec($sql);
    header("location:../admin_center.php?do=news");
?>