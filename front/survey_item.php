<?php
if (isset($_GET['id'])) {
    $subject = find('survey_subject', $_GET['id']);
    //dd($subject);
    $options = all('survey_options', ['subject_id' => $_GET['id']]);
    //dd($options);
} else {
    header("location:admin_center.php?do=survey&error=沒有指定調查id");
}
?>

<h3 class="text-center font-weight-bold"><?= $subject['subject']; ?></h3>

<form action="./api/survey_vote.php">
    <div class="col-8 mx-auto mt-4">
        <?php
        foreach ($options as $idx => $option) {
        ?>
            <div class="input-group" style="margin-top:-1px">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="radio" name="option">
                    </div>
                </div>
                <div class="form-control">
                    <?= $option['opt']; ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="text-center mt-4">
        <input type="submit" class="btn btn-primary mx-1" value="投票">
        <a href="index.php?do=survey" class="btn btn-warning mx-1">取消返回</a>
    </div>
</form>