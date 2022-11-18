<?php
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');
    if(isset($_GET['code'])){
        $sql_students="SELECT `students`.`id` as 'id' ,
                    `students`.`school_num` as '學號',
                     `students`.`name` as '姓名',
                     `students`.`birthday` as '生日',
                     `students`.`graduate_at` as '畢業國中'
              FROM `class_student`,`students` 
              WHERE `class_student`.`school_num`=`students`.`school_num` && 
                    `class_student`.`class_code`='{$_GET['code']}' ";
    }else{
        //建立撈取學生資料的語法，限制只撈取前20筆
        $sql_students="SELECT `students`.`id` as 'id' ,
                     `students`.`school_num` as '學號',
                     `students`.`name` as '姓名',
                     `students`.`birthday` as '生日',
                     `students`.`graduate_at` as '畢業國中'
              FROM `students` ";
    }

    $div=10;
    $total=$pdo->query($sql_students)->fetchColumn();
    $pages=ceil($total/$div);
    $now=(isset($_GET['page']))?$_GET['page']:1;
    $start=($now-1)*$div;
    $sql=$sql . "LIMIT $start,$div";
?>    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生成績管理系統</title>
    <!-- 載入css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>學生成績管理系統</h1>
    <nav>
        <a href="add.php">新增學生</a>
        <a href="reg.php">教師註冊</a>
        <a href="login.php">教師登入</a>

    </nav>
    <nav>
    <ul class="class-list">
        <?php
        //從`classes`資料表中撈出所有的班級資料並在網頁上製作成下拉選單的項目
        $sql = "SELECT `id`,`code`,`name` FROM `classes`";
        $classes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($classes as $row) {
            echo "<li><a href='?code={$row['code']}'>{$row['name']}</a></il>";
           
            if($_GET['code']=$row['code']){
                $classesName=$row['name'];
            }else{
                $classesName='';
            }
        }
        ?>
    </ul>
    </nav>
    <?php
    // $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    // $pdo = new PDO($dsn, 'root', '');
    // $sql = "select * from `students` ORDER BY  id DESC limit 25";

    // $rows=$pdo->query($sql)->fetchAll(pdo::FETCH_NUM);//索引值取出欄位
    $rows = $pdo->query($sql_students)->fetchAll(pdo::FETCH_ASSOC); //欄位名稱取出欄位
    // $rows=$pdo->query($sql)->fetchAll(pdo::FETCH_NAMED);//欄位名稱取出欄位


    // echo "<pre>";
    // print_r($rows);
    // echo "</pre>";
    ?>
    <table class="list-students">

        <?php
        echo "<tr>";

        echo "<td colspan=8 >{$classesName}</td>";

        echo "</tr>";

        echo "<tr>";
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
            echo "<td><a href='../api/del_student.php?id={$row['id']}'><i class='bi bi-trash'></i>刪除 </a></td>";
            // echo "<td><a href='del.php?id={$row['id']}'><i class='bi bi-trash'></i>刪除 </a></td>";
            echo "<td><a href=''> </a></td>";
            echo "</tr>";
        }

        ?>
    </table>
</body>

</html>