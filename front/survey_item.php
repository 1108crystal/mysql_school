<?php
if (isset($_GET['id'])) {
    $subject = find('survey_subject', $_GET['id']);
    // dd($subject);
    $options = all('survey_options', ['subject_id' => $_GET['id']]);
    // dd($options);
} else {
    // header("location:admin_center.php?do=survey&error=沒有指定調查id");
    $error = "請回到問卷首頁選擇正確的目來進行";
}
?>
<?php
if (!isset($error)) { ?>
    <h3 class="text-center font-weight-bold"><?= $subject['subject']; ?></h3>
<?php
}
?>



<form action="./api/survey_vote.php" method="post">
    <div class="col-8 mx-auto mt-4">
        <?php
        if (isset($error)) {
            echo "<span style='color:red'>" . $error . "</span>";
        } else {


        ?>
            <!--列表項目-->
            <?php
            foreach ($options as $idx => $option) {
            ?>
                <div class="input-group" style="margin-top:-1px">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" name="option" value="<?= $option['id']; ?>">
                        </div>
                    </div>
                    <div class="form-control">
                        <?= $option['opt']; ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="text-center mt-4">
        <input type="submit" class="btn btn-primary mx-1" value="投票">
        <a href="index.php?do=survey" class="btn btn-warning mx-1">取消返回</a>
    </div>
</form>