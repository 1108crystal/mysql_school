<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}
include "./db/base.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台管理中心</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_GET['del'])) {
        echo "<div class='del-msg'>";
        echo $_GET['del'];
        echo "</div>";
    }
    ?>
    <!-- 抬頭表題 -->
    <?php include "./layouts/header.php" ?>
    <h4 style='text-align:center'>後台管理中心</h4>

    <hr>
    <div class="main">
    <article style="width:40%;">

    </article>
    <section>
        <?php
        $do = $_GET['do'] ?? 'main';
        $file = './back/' . $do . ".php";

        if (file_exists($file)) {
            include $file;
        } else {
            include "./back/main.php";
        }
        ?>
    </section>
    </div>

</body>

</html>