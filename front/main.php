<h1 class="text-center">最新消息</h1>
<ul class="list-group">
<li class='list-group-item list-group-item-action d-flex text-center bg-info text-white'>

    <div class='col-md-1'></div>
            <div class='col-md-1'>類別</div>
            <div class='col-md-6'>主題</div>
            <div class='col-md-2'>點閱數</div>
            <div class='col-md-2'>發佈時間</div>
</li>    
<?php

/* $all_news="SELECT * FROM `news`  ORDER by `top` desc,`readed` desc ";
$rows=$pdo->query($all_news)->fetchAll(); */

$rows=all('news'," ORDER by `top` desc,`readed` desc");

//$hot=$pdo->query("SELECT `id` FROM `news` ORDER BY `readed` desc")->fetchColumn();
$hot=q("SELECT `id` FROM `news` ORDER BY `readed` desc");
foreach($rows as $row){
    echo "<li class='list-group-item list-gropu-item-action d-flex'>";
    echo "<div class='col-md-1 text-danger'>";
    echo ($row['top'] == 1) ? "TOP" : "";
    echo ($row['id'] == $hot) ? "hot!" : "";
    echo "</div>";
    echo "<div class='col-md-1'>";
    echo $row['type'];
    echo "</div>";
    echo "<div class='col-md-6'>";
    echo "<a href='index.php?do=news_detail&id={$row['id']}'>{$row['subject']}</a>";
    echo "</div>";
    echo "<div class='col-md-1 text-center'>";
    echo "<a class='btn btn-info mx-1' href='index.php?do=news_detail&id={$row['id']}'>{$row['readed']}</a>";
    echo "</div>";
    echo "<div class='col-md-3 text-center'>";
    echo "{$row['created_at']}";
    echo "</div>";
    echo "</li>";
}

?>

</ul>


