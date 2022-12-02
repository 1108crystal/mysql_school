<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>練習function (PHP)</title>
</head>

<body>


    <h1>使用函式來印圖形 </h1>
    <hr>
    <pre>
<form action="./start.php" method="post">
    <table>
        <tr>
        <td>
    <select name="shape" id="">
        <option value="正三角形" >正三角形</option>
        <option value="菱形">菱形</option>
        <option value="矩形">矩形</option>
        <option value="直角三角形">直角三角形</option>
    </select>
</td>
        <td><label for="">數值</label><input type="number" name="size" id=""></div></td>
        <td><label for="">內容符號</label><input type="text" name="str" id=""></div></td>
        <td><button type="submit">產生</button></td>
    </tr>
    </table>
    </form>
    <hr>
<?php

$shape = $_POST['shape'];
$str = $_POST['str'];
$size = $_POST['size'];
fun_shape($shape, $str, $size);


// statrs(10, "$");
// echo "<hr>";
// diamond(22, "$");

function fun_shape($shape = '正三角形', $str = '*', $size = 7)
{
    // echo $shape;
    switch ($shape) {
        case "正三角形":
            echo "<h2><?shape?></h2>";
            statrs($size, $str);
            break;
        case "菱形":
            diamond($size, $str);
            break;
        case "矩形":
            diamond($size, $str);
            break;
        case "直角三角形":
            triangle($size, $str);
            break;
    }
}



function statrs($size, $str)
{
    for ($i = 1; $i <= $size; $i++) {

        for ($k = 1; $k <= ($size - $i); $k++) {
            echo "&nbsp;";
        }

        for ($j = 1; $j <= (2 * $i - 1); $j++) {
            echo $str;
        }
        echo "<br>";
    }
}

function diamond($size, $str)
{
    $temp = 0;
    $space = round($size / 2, 0);
    for ($i = 1; $i <= $size; $i++) {

        if ($i > $space) {
            $temp = $temp - 1;
        } else {
            $temp = $i;
        }

        for ($j = 1; $j <= ($space - 1 + $temp); $j++) {
            if ($j <= ($space - $temp)) {
                echo "&nbsp;";
            } else {
                echo $str;
            }
        }
        echo "<br>";
    }
}

function Distance($size, $str)
{
    for ($i = 1; $i <= $size; $i++) {

        for ($j = 1; $j <= $size; $j++) {

            if ($i == 1 || $i == $size) {

                echo $str;
            } else if ($j == 1 || $j == $size) {

                echo $str;
            } else {

                echo "&nbsp;";
            }
        }

        echo "<br>";
    }
}

function triangle($size, $str)
{
    for ($i = 1; $i <= $size; $i++) {

        for ($j = 1; $j <= $i; $j++) { //在內圈中，我們把外圈的變數$i當成內圈次數的限制
            echo $str;
        }
        echo "<br>";
    }
}

?>
</pre>
</body>

</html>