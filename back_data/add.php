<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生</title>
</head>

<body>
    <h1>新增學生</h1>

    <form action="./api/add_student.php" method="post">
        <table>

            <tr>
                <td>school_num</td>
                <?php
                $sql = "select max(`school_num`)  from `students`";
                $max = $pdo->query($sql)->fetchcolumn();


                ?>
                <td><input type="text" name="school_num"  value="<?=$max+1?>" readonly ></td>
            </tr>
            <tr>
                <td>姓名</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>生日</td>
                <td><input type="date" name="birthday" ></td>
            </tr>
            <tr>
                <td>uni_id</td>
                <td><input type="text" name="uni_id" ></td>
            </tr>
            <tr>
                <td>地址</td>
                <td><input type="text" name="addr" ></td>
            </tr>
            <tr>
                <td>parents</td>
                <td><input type="text" name="parents" ></td>
            </tr>
            <tr>
                <td>tel</td>
                <td><input type="text" name="tel" ></td>
            </tr>
            <tr>
                <td>dept</td>
                <td>
                    <select name="dept">
                        <?php
                        $sql = "select * from dept ";
                        $depts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($depts as $dept) {
                            echo "<option value='{$dept['id']}'>{$dept['name']}</option>";
                        }
                        ?>

                    </select>

                </td>
            </tr>
            <tr>
                <td>畢業國中</td>
                <td>
                    <select name="graduate_at">
                        <?php
                        $sql = "select * from graduate_school ";
                        $grads = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($grads as $grad) {
                            echo "<option value='{$grad['id']}'>{$grad['county']}{$grad['name']}</option>";
                        }
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>status_code</td>
                <td>
                    <select name="status_code">
                        <?php
                        $sql = "select * from status";
                        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row) {
                            echo "<option value='{$row['code']}'>{$row['status']}{$row['note']}</option>";
                        }
                        ?>

                    </select>

                </td>
            </tr>
            <tr>
                <td>班級</td>
                <td>
                    <select name="classes">
                        <?php
                        $sql = "SELECT * FROM `classes`";
                        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td><input type="submit" value="確認新增"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>

</html>