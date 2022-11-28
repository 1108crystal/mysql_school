<?php
$sql="select * from `news` where `id`='{$_GET['id']}'";
$news=$pdo->query($sql)->fetch();
?>

<h3 class="text-left font-weight-bolder"><?=$news['subject'] ?></h3>
<div class="text-right text-secondary">
發佈時間:<?=$news['created_at']?>
</div>
<div class="text-left"><h4>[<?=$news['type'];?>]</h4></div>
<div style="font-size:20 ;"><?=nl2br($news['content'])?></div>


</div>