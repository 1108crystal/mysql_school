
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教師登入</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>教師登入</h1>
    <hr>
    <div class='log-msg'>
        <?php
        session_start();
        if (isset($_GET['error'])) {
            echo "帳號或密碼錯誤!";
            echo "登入嘗試" . $_SESSION['login_try'] . "次";
        }
        ?>

        <?php
    $wait=0;
        echo $_SESSION['login_try'];
        if($_SESSION['login_try'] <=3){
            $wait = 0;
        }else{
            $wait = 1;
            echo "登入嘗試超過" . $_SESSION['login_try'] . "次，請等5分鐘後再試!";
        }
        ?>
    </div>

    <?php if ($wait == 0) {
    ?>
        <div class="container mt-4 ">
            <form action="./api/chk_user.php" method="post">
                <div class="mb-3 mt-3"><label for="acc">帳號：<input type="text" name="acc" id="" class="form-control"></label></div>
                <div class="mb-3 mt-3"><label for="pw">密碼：<input type="password" name="pw" id="" class="form-control"></label></div>
                <div class="mb-3 mt-3">

                    <label for=""><input type="submit" name="登入" id="" class="btn btn-primary"></label>
                    <label for=""><input type="reset" value="重置" class="btn btn-primary"></label>

                </div>
            </form>
            <div class="mb-2 mt-2"><a href="#"><small>忘記密碼</small></a></div>
        </div>

    <?php
    }
    ?>


</body>

</html>