<?php
if (isset($_GET['id'])) {
    $subject = find('survey_subject', $_GET['id']);
    //dd($subject);
    $options = all('survey_options', ['subject_id' => $_GET['id']]);
    // dd($options);
} else {
    header("location:admin_center.php?do=survey&error=沒有指定調查id");
}
?>

<h3 class="text-center font-weight-bold">【<?= $subject['subject']; ?> 】調查結果</h3>

<ul class="list-group col-10 mx-auto">
    <?php
    foreach ($options as $idx => $option) {

        $division=($subject['vote']==0)?1:$subject['vote'];
        $width=round(($option['vote']/$division)*100,2);
        $option['vote']; 
    ?>
    <li class="d-flex list-group-item list-group-item-light list-group-item-action">
        <div class="col-6"><?=$option['opt'];?></div>
        <div class="col-6 d-flex align-items-center">
            <div class="bg-primary rounded" style="width:<?=$width;?>%">&nbsp;</div>
            <div><?=$width;?>%</div>
        </div>
    </li>
    <?php
    }
    ?>
</ul>
<div class="text-center mt-4">

    <a href="index.php?do=survey" class="btn btn-warning mx-1">返回</a>
</div>