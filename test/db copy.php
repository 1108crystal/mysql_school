<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自訂函式練習 【DB】</title>
</head>

<body>
    <h1>資料庫常用自訂函式</h1>
    <!-- <h3>all()-存取指定條件的多筆資料</h3> -->
    <hr>
<form action="./db.php" method="post">

</form>


    <?php
    include_once "../db/base.php";
//----- all()-給定資料表名後，會回傳整個資料表的資料-----/
    // $rows=all('students',' order by `id` desc ');
    // $rows = all('students', array('dept' => '3', 'graduate_at' => '23'), ' order by `id` desc');
//----- find()-會回傳資料表指定id的資料-----/
    // $rows = find('students', 3);
//----- update()-給定資料表的條件後，會去更新相應的資料。 -----/
    // $rows = update('students',array('name' => '方玉婷(改名字)', 'tel' => '02-55558823')  ,' `id` = 5');
//----- insert()-給定資料內容後，會去新增資料到資料表 -----/
    // $rows = insert('students', array('school_num' => '915084','name' => '郭小森','birthday' => '1975-08-25','uni_id' => 'F500000001',
    //     'addr' => '新北市泰山區',
    //     'parents' => '郭小小',
    //     'tel' => '02-26660000',
    //     'dept' => '5',
    //     'graduate_at' => '1',
    //     'status_code' => '001'
    // ));
//----- del()-給定條件後，會去刪除指定的資料 -----/
$rows = del('students',array('school_num' => '915084'));


    dd($rows);

    function dd($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }


    /**
     * pram table -資料表名稱
     * pram args[0] - where 條件(array)或sql字串
     * pram args[1] - order by limit 之類的sql字串
     */
    function all($table, ...$args)
    {
        global $pdo;
        $sql = "select * from $table";
        if (isset($args[0])) {
            if (is_array($args[0])) {
                //是陣列 ['acc'=>'mack','pw'=>'1234']
                //是陣列 ['product'=>'PC','price'=>'1000']

                foreach ($args[0] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                //是字串(非陣列)
                $sql = $sql . $args[0];
            }
        }

        if (isset($args[1])) {
            //是字串(非陣列)
            $sql = $sql . $args[1];
        }
        echo $sql;
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * find()-會回傳資料表指定id的資料
     */

    function find($table, $id)
    {
        global $pdo;
        $sql = "select * from $table";
        if (isset($args[0])) {
            if (is_array($args[0])) {
                //是陣列 ['acc'=>'mack','pw'=>'1234']
                //是陣列 ['product'=>'PC','price'=>'1000']

                foreach ($args[0] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                //是字串(非陣列)
 
            }
        }else{
            $sql = $sql ." where  `id`='$id'";
        }

        echo $sql;
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * update()-給定資料表的條件後，會去更新相應的資料。
     */
    function update($table, ...$args)
    {
        global $pdo;
        $sql = "update   $table";

        //更新的欄位資料
        if (isset($args[0])) {
            if (is_array($args[0])) {
                //是陣列 ['acc'=>'mack','pw'=>'1234']
                //是陣列 ['product'=>'PC','price'=>'1000']

                foreach ($args[0] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }
                $sql = $sql . " set " . join(" , ", $tmp);
            } else {
                //是字串(非陣列)
                $sql = $sql . $args[0];
            }
        }
        // 要更新條件
        if (isset($args[1])) {
            if (is_array($args[1])) {
                //是陣列 ['acc'=>'mack','pw'=>'1234']
                //是陣列 ['product'=>'PC','price'=>'1000']

                foreach ($args[1] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                //是字串(非陣列)
                $sql = $sql . " where " . $args[1];
            }
        }

        // echo $sql;
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * insert()-給定資料內容後，會去新增資料到資料表。
     */
    function insert($table, ...$args)
    {
        global $pdo;
        $sql = "insert into  $table ";

        //更新的欄位資料
        if (isset($args[0])) {
            if (is_array($args[0])) {
                //是陣列 ['acc'=>'mack','pw'=>'1234']
                //是陣列 ['product'=>'PC','price'=>'1000']

                foreach ($args[0] as $key => $value) {
                    $fildName[] = "`$key`";
                    $fildValue[] = "'$value'";
                }
                $sql = $sql . " (" . join(" , ", $fildName) . ")";
                $sql = $sql . " values  (" . join(" , ", $fildValue) . ")";
            } else {
                //是字串(非陣列)
                $sql = $sql . $args[0];
            }
        }
        echo $sql;
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * del()-給定條件後，會去刪除指定的資料
     */
    function del($table, ...$args)
    {
        global $pdo;
        $sql = "DELETE from  $table ";
        // 要更新條件
        if (isset($args[0])) {
            if (is_array($args[0])) {
                //是陣列 ['acc'=>'mack','pw'=>'1234']
                //是陣列 ['product'=>'PC','price'=>'1000']

                foreach ($args[0] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                //是字串(非陣列)
                $sql = $sql . " where " . $args[1];
            }
        }

         echo $sql;
        // return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    ?>
</body>

</html>