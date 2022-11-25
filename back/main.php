<?php

$classesName = '';
if (isset($_GET['code'])) {
    $sql_students = "SELECT `students`.`id` as 'id' ,
                    `students`.`school_num` as '學號',
                     `students`.`name` as '姓名',
                     `students`.`birthday` as '生日',
                     `students`.`graduate_at` as '畢業國中'
              FROM `class_student`,`students` 
              WHERE `class_student`.`school_num`=`students`.`school_num` && 
                    `class_student`.`class_code`='{$_GET['code']}' ";


    $sql_total = "SELECT count(`students`.`id`)
          FROM `class_student`,`students` 
          WHERE `class_student`.`school_num`=`students`.`school_num` && 
                `class_student`.`class_code`='{$_GET['code']}'";
    //從`classes`資料表中撈出所有的班級資料並在網頁上製作成下拉選單的項目
    $sql = "SELECT `id`,`code`,`name` FROM `classes` where `code`='{$_GET['code']}'";
    $classes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($classes as $row) {

        if ($_GET['code'] = $row['code']) {
            $classesName = $row['name'];
        } else {
            $classesName = '';
        }
    }
} else {
    //建立撈取學生資料的語法，限制只撈取前20筆
    $sql_students = "SELECT `students`.`id` as 'id' ,
                     `students`.`school_num` as '學號',
                     `students`.`name` as '姓名',
                     `students`.`birthday` as '生日',
                     `students`.`graduate_at` as '畢業國中'
              FROM `students` ";

    $sql_total = "SELECT count(`students`.`id`)
FROM `students`";
}

$div = 10;
$total = $pdo->query($sql_total)->fetchColumn();
$pages = ceil($total / $div);
$now = (isset($_GET['page'])) ? $_GET['page'] : 1;
$start = ($now - 1) * $div;
$sql_students = $sql_students . "LIMIT $start,$div";


if (isset($_GET['code'])) {
    $sql_students = "SELECT `students`.`id` as 'id' ,
                    `students`.`school_num` as '學號',
                     `students`.`name` as '姓名',
                     `students`.`birthday` as '生日',
                     `students`.`graduate_at` as '畢業國中'
              FROM `class_student`,`students` 
              WHERE `class_student`.`school_num`=`students`.`school_num` && 
                    `class_student`.`class_code`='{$_GET['code']}' ";


    $sql_total = "SELECT count(`students`.`id`)
          FROM `class_student`,`students` 
          WHERE `class_student`.`school_num`=`students`.`school_num` && 
                `class_student`.`class_code`='{$_GET['code']}'";
    //從`classes`資料表中撈出所有的班級資料並在網頁上製作成下拉選單的項目
    $sql = "SELECT `id`,`code`,`name` FROM `classes` where `code`='{$_GET['code']}'";
    $classes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $classesName = '';
    foreach ($classes as $row) {

        if ($_GET['code'] = $row['code']) {
            $classesName = $row['name'];
        }
    }
} else {
    $classesName = "全部年級資料";
    //建立撈取學生資料的語法，限制只撈取前20筆
    $sql_students = "SELECT `students`.`id` as 'id' ,
                     `students`.`school_num` as '學號',
                     `students`.`name` as '姓名',
                     `students`.`birthday` as '生日',
                     `students`.`graduate_at` as '畢業國中'
              FROM `students` ";

    $sql_total = "SELECT count(`students`.`id`)
FROM `students`";
}

$div = 10;
$total = $pdo->query($sql_total)->fetchColumn();
$pages = ceil($total / $div);
$now = (isset($_GET['page'])) ? $_GET['page'] : 1;
$start = ($now - 1) * $div;
$sql_students = $sql_students . "LIMIT $start,$div";

$rows = $pdo->query($sql_students)->fetchAll(pdo::FETCH_ASSOC); //欄位名稱取出欄位
?>



<div class="pages">
    <?php
    //上一頁
    //當前頁碼-1,可是不能小於0,最小是1,如果是0,不顯示
    if (($now - 1) >= 1) {
        $prev = $now - 1;
        if (isset($_GET['code'])) {
            echo "<a href='?page=$prev&code={$_GET['code']}'> ";
            echo "&lt; ";
            echo " </a>";
        } else {

            echo "<a href='?page=$prev'> ";
            echo "&lt; ";
            echo " </a>";
        }
    }

    ?>
    <?php
    //顯示第一頁
    if ($now >= 4) {
        if (isset($_GET['code'])) {
            echo "<a href='?page=1&code={$_GET['code']}'> ";
            echo "1 ";
            echo " </a>...";
        } else {

            echo "<a href='?page=1'> ";
            echo "1 ";
            echo " </a>...";
        }
    }
    ?>
    <?php
    //頁碼區
    //只顯示前後四個頁碼

    if ($now >= 3 && $now <= ($pages - 2)) {  //判斷頁碼在>=3 及小於最後兩頁的狀況
        $startPage = $now - 2;
    } else if ($now - 2 < 3) { //判斷頁碼在1,2頁的狀況
        $startPage = 1;
    } else {  //判斷頁碼在最後兩頁的狀況
        $startPage = $pages - 4;
    }

    for ($i = $startPage; $i <= ($startPage + 4); $i++) {
        $nowPage = ($i == $now) ? 'now' : '';
        if (isset($_GET['code'])) {
            echo "<a href='?page=$i&code={$_GET['code']}' class='$nowPage'> ";
            echo $i;
            echo " </a>";
        } else {
            echo "<a href='?page=$i' class='$nowPage'> ";
            echo $i;
            echo " </a>";
        }
    }


    //全部頁碼顯示
    /*     for($i=1;$i<=$pages;$i++){
        $nowPage=($i==$now)?'now':'';
        if(isset($_GET['code'])){
            echo "<a href='?page=$i&code={$_GET['code']}' class='$nowPage'> ";
            echo $i;
            echo " </a>";
            
        }else{
            
            echo "<a href='?page=$i' class='$nowPage'> ";
            echo $i;
            echo " </a>";
        }
    } */
    ?>
    <?php
    //顯示第一頁
    if ($now <= ($pages - 3)) {
        if (isset($_GET['code'])) {
            echo "...<a href='?page=$pages&code={$_GET['code']}'> ";
            echo "$pages";
            echo " </a>";
        } else {

            echo "...<a href='?page=$pages'> ";
            echo "$pages";
            echo " </a>";
        }
    }
    ?>
    <?php
    //下一頁
    //當前頁碼+1,可是不能超過總頁數,最大是總頁數,如果超過總頁數,不顯示
    if (($now + 1) <= $pages) {
        $next = $now + 1;
        if (isset($_GET['code'])) {
            echo "<a href='?page=$next&code={$_GET['code']}'> ";
            //echo "< ";
            echo "&gt; ";
            echo " </a>";
        } else {
            echo "<a href='?page=$next'> ";
            //echo " >";
            echo "&gt; ";
            echo " </a>";
        }
    }

    ?>
</div>




<table class="list-students">

    <?php
    echo "<tr>";

    echo "<th colspan=8 >{$classesName}</th>";

    echo "</tr>";

    echo "<tr class='table-primary'>";
    echo "<td>學號</td>";
    echo "<td>姓名</td>";
    echo "<td>生日</td>";
    echo "<td>學校代號</td>";
    echo "<td>年齡</td>";
    echo "<td colspan=3 >操作</td>";
    // echo "<td></td>";
    // echo "<td</td>";
    echo "</tr>";
    foreach ($rows as $row) {
        echo "<tr >";
        echo "<td>{$row['學號']}</td>";
        echo "<td>{$row['姓名']}</td>";
        echo "<td>{$row['生日']}</td>";
        echo "<td>{$row['畢業國中']}</td>";
        echo "<td>" . (date('Y') - date('Y', strtotime($row['生日']))) . "</td>";
        echo "<td><a href='edit.php?id={$row['id']}'><i class='bi bi-pencil-fill'></i>編輯 </a></td>";
        echo "<td><a href='./confim_del.php?id={$row['id']}'><i class='bi bi-trash'></i>刪除 </a></td>";
        // echo "<td><a href='del.php?id={$row['id']}'><i class='bi bi-trash'></i>刪除 </a></td>";
        echo "<td><a href=''> </a></td>";
        echo "</tr>";
    }

    ?>
</table>