<?php
include_once "../db/base.php";

/*$subject=$_POST['subject'];
$type= 1;
$vote=0;
$active=0;*/
$subject=['subject'=>$subject,
'type'=>$type,
'ovte'=>$vote,
'active'=>$active];

insert('survey_subject',$subject);

// insert('survey_options');



?>