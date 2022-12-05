<?php
include_once "../db/base.php";
dd($_POST['subject']);
dd($_POST['subject_id']);
dd($_POST['optid']);
$subject=find('survey_subject',$_POST['subject_id']);
dd($subject);

update('survey_subject',['subject'=>$_POST['subject']],$_POST['subject_id']);
dd($_POST['opt']);
dd($_POST['opt_id']);
foreach($_POST['opt_id'] as $idx => $id){

    update('survey_options',['opt'=>$_POST['opt'][$idx]],$id);
}

header("location:../addmin_center.php?do=survey");

?>