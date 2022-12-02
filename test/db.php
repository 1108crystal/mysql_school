<?php
include_once "../db/base.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_TableName = TRIM($_POST['TableName']);
    $v_dbFUN = TRIM($_POST['dbFUN']);
    $v_valueArray = $$_POST['valueArray'];
    $v_where = $$_POST['where'];

    // echo $v_TableName;
    // echo "<br>";
    // echo $v_dbFUN;
    // echo "<br>";
    echo $v_valueArray;
    echo "<br>";
    echo $v_where;
    echo "<br>";
    Fun_DB($v_TableName, $v_dbFUN, $v_valueArray, $v_where);
    
}
//----- all()-給定資料表名後，會回傳整個資料表的資料-----/
// $rows=all('students',' order by `id` desc ');
// $rows = all('students', array('dept' => '3', 'graduate_at' => '23'), ' order by `id` desc');
//----- find()-會回傳資料表指定id的資料-----/
// $rows = find('students', 3);
//----- update()-給定資料表的條件後，會去更新相應的資料。 -----/
// $rows = update('students',array('name' => '方玉婷(改)', 'tel' => '03-55558823')  ,' `id` = 5');
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
// $rows = del('students', array('school_num' => '915084'));


// dd($rows);

function Fun_DB($TableName, $dbFUN, $valueArray, $where)
{
    switch ($dbFUN) {
        case "all":
            $rows = all($TableName, $where);
            break;
        case "find":
            $rows = find($TableName, $where);
            break;
        case "update":
            $rows = update($TableName, $valueArray, $where);
            break;
        case "insert":
            $rows = insert($TableName, $valueArray);
            break;
        case "del":
            $rows = del($TableName, $where);
            break;
    }
    dd($rows);
}



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
            $sql = $sql . " ".$args[0];
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
    } else {
        $sql = $sql . " where  `id`='$id'";
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
            $sql = $sql ." " . $args[0];
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

    echo $sql;
    // return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $pdo->exec($sql);
}



/**
 * insert()-給定資料內容後，會去新增資料到資料表。
 */
// ------------insert  用function的方法(一)------------------/
function insert($table, ...$args)
{
    global $pdo;
    $keys=array_keys($args[0]);
    
    $sql = "insert into  $table (`". join("`,`",$keys) ."`) values('" . join("','",$args[0]) . "')";

    echo $sql;
    return $pdo->exec($sql);
}
// ------------insert  用function的方法(二 )------------------/
function insert_02($table, ...$args)
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
            $sql = $sql ." ". $args[0];
        }
    }
    echo $sql;
    // return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $pdo->exec($sql);
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
    return $pdo->exec($sql);
}


?>





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
    <div>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>

                    <td>
                        <label for="">資料表名稱:</label>
                        <input type="text" name="TableName" id="">
                    </td>
                    <td></td>
                </tr>
                <tr>

                    <td colspan="2">
                        <hr>
                        <div>
                            <input type="radio" name="dbFUN" id="all" value="all" checked>
                            <label for="all">all()-給定資料表名後，會回傳整個資料表的資料</label>
                        </div>
                        <div>
                            <input type="radio" name="dbFUN" id="all" value="find">
                            <label for="find">find()-會回傳資料表指定id的資料</label>
                        </div>
                        <div>
                            <input type="radio" name="dbFUN" id="all" value="update">
                            <label for="update">update()-給定資料表的條件後，會去更新相應的資料。</label>
                        </div>
                        <div>
                            <input type="radio" name="dbFUN" id="all" value="insert">
                            <label for="insert">insert()-給定資料內容後，會去新增資料到資料表</label>
                        </div>
                        <div>
                            <input type="radio" name="dbFUN" id="all" value="del">
                            <label for="del">del()-給定條件後，會去刪除指定的資料</label>
                        </div>
                    </td>
                    <!-- <td></td> -->
                </tr>

                <tr>
                    <td>
                        <hr>
                        <label for="">輸入你想要更新或新增的資料內容:</label><BR>
                        <textarea cols="50" rows="17" name="valueArray"></textarea>
                    </td>
                    <td>
                        <hr>
                        <div>輸入的範例:</div>
                        <div>
                            <ul>
                                <li> insert:<BR>array('school_num' => '915084','name' => '郭小森','birthday' => '1975-08-25','uni_id' => 'F500000001',
                                    'addr' => '新北市泰山區',
                                    'parents' => '郭小小',
                                    'tel' => '02-26660000',
                                    'dept' => '5',
                                    'graduate_at' => '1',
                                    'status_code' => '001'
                                    )</li>
                                <li>update():<BR>array('name' => '方玉婷(改名字)', 'tel' => '02-55558823') </li>
                            </ul>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <hr>
                        <label for="">輸入你想要...查詢條件:</label><BR>
                        <textarea cols="50" rows="8" name="where"></textarea>
                    </td>
                    <td>
                        <hr>
                        <div>輸入條件的範例:</div>
                        <div>
                            <ul>
                                <li>字串方式:<br>order by `id` desc</li>
                                <li>陣列查詢多個條件:<br> array('dept' => '3', 'graduate_at' => '23')</li>
                            </ul>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <input type="submit" value="執行">
                        <input type="reset" value="取消">
                    </td>
                    <td>

                    </td>
                </tr>




            </table>
        </form>
    </div>

</body>

</html>