<h1 class="text-center">最新消息</h1>
<a class="btn btn-primary" href="admin_center.php?do=add_news">新增消息</a>

<hr>
<ul class="list-gropu">
    <li class='list-group-item list-gropu-item-action d-flex  bg-info' >
        <div class='col-md-1'>類別</div>
        <div class='col-md-4'>主題</div>
        <div class='col-md-1'>置頂</div>
        <div class='col-md-1'>點閱數</div>
        <div class='col-md-2'>發佈時間</div>
        <div class='col-md-3  text-center'>操作</div>
    </li>


<?php
$all_news="select * from `news` order by  `top` DESC  ";
$rows=$pdo->query($all_news)->fetchAll();
foreach($rows as $row){
    echo "<li class='list-group-item list-gropu-item-action d-flex'>";
    echo "<div class='col-md-1'>";
    echo $row['type'];
    echo "</div>";
    echo "<div class='col-md-4'>";
    echo $row['subject'];
    echo "</div>";
    echo "<div class='col-md-1'>";
    echo ($row['top']==1)?"TOP":"";
    echo "</div>";    
    echo "<div class='col-md-1'>";
    echo $row['readed'];
    echo "</div>";
    echo "<div class='col-md-2'>";
    echo $row['created_at'];
    echo "</div>";
    echo "<div class='col-md-3 text-center'>";
    echo "<a class='btn btn-info mx-2' href='admin_center.php?do=news_edit&id={$row['id']}'>編輯</a>";
    echo "<a class='btn btn-danger mx-2' href='admin_center.php?do=news_del&id={$row['id']}'>刪除</a>";
    echo "</div>";
    echo "</li>";
}
?>


</ul>