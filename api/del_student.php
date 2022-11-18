<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$student=$pdo->query("select * from `students` where `id`='{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);

$sql_class="delete from class_student where `school_num`='{$student['school_num']}'";

$sql="delete from  `students` where `id`='{$_GET['id']}' ";
echo $sql_class."<br>";
echo $sql."<br>";
// $pdo->query($sql);
// $res=$pdo->exec($sql);

echo "新增成功:".$res;

?>