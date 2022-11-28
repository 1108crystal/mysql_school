<?php
$news = $pdo->query("select * from `news` where `id`='{$_GET['id']}' ")->fetch();

?>

<h2 class="text-center">編輯消息</h2>
<form action="./api/edit_news.php" method="post">
    
    <input type="hidden" class="form-control col-md-10" name="id" value="<?= $news['id'] ?>">
    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">主題</label>
        <input type="text" class="form-control col-md-10" name="subject" value="<?= $news['subject'] ?>">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">置頂</label>
        <div class="form-control col-md-5">

            <input class="" type="radio" name="top" <?= ($news['top'] == 1) ? 'checked' : ''; ?> value='1'>YES
        </div>
        <div class="form-control col-md-5">
            <input class="" type="radio" name="top" <?= ($news['top'] == 0) ? 'checked' : ''; ?> value='0'>NO
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">觀看次數</label>
        <input type="number" class="form-control col-md-10" name="readed" value="<?= $news['readed'] ?>">
    </div>

    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">內容</label>
        <textarea class="form-control col-md-10" name="content" style="height:200px"><?= $news['content'] ?>
                </textarea>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">類別</label>
        <input type="text" class="form-control col-md-10" name="type" value="<?=$news['type']?>">
    </div>


    <div class="text-right text-secondary">發佈時間:<?=$news['created_at']?></div>
    <br><br>
    <div class="text-center">
        <input class="btn btn-primary mx-2" type="submit" value="確定修改">
        <input class="btn btn-warning mx-2" type="reset" value="重置">
    </div>
</form>