<h1 class="text-center">最新消息</h1>
<a class="btn btn-primary" href="admin_center.php?do=add_news">新增消息</a>

<hr>
<ul class="list-gropu">
<?php
$all_news="select * from `news`";
$rows=$pdo->query($all_news)->fetchAll();
foreach($rows as $row){
    echo "<li class='list-group-item list-gropu-item-action d-flex'>";
    echo "<div class='col-md-2'>";
    echo $row['type'];
    echo "</div>";
    echo "<div class='col-md-6'>";
    echo $row['subject'];
    echo "</div>";
    echo "<div class='col-md-4 text-center'>";
    echo "<a class='btn btn-info mx-2' href='admin_center.php?do=news_edit&id={$row['id']}'>編輯</a>";
    echo "<a class='btn btn-danger mx-2' href='admin_center.php?do=news_edit&id={$row['id']}'>刪除</a>";
    echo "</div>";
    echo "</li>";
}
?>


</ul>