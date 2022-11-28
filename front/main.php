<div class="main">

    <h1 class='text-center'>最新消息</h1>
    <ul class="list-gropu">
        <?php
        $all_news = "select * from `news`";
        $rows = $pdo->query($all_news)->fetchAll();
        foreach ($rows as $row) {
            echo "<li class='list-group-item list-gropu-item-action d-flex'>";
            echo "<div class='col-md-2'>";
            // echo $row['type'];
            echo "</div>";
            echo "<div class='col-md-8'>";
            echo $row['subject'];
            echo "</div>";
            echo "<div class='col-md-2 text-center'>";
            echo "<a class='btn btn-info mx-2' href='index.php?do=news_detail&id={$row['id']}'>...</a>";
            
            echo "</div>";
            echo "</li>";
        }
        ?>
    </ul>
</div>