<h4 style='text-align:center'>教師登入</h4>
<hr>
<div class='log-msg'>
    <?php
    session_start();
    if (isset($_GET['error'])) {
        echo "帳號或密碼錯誤!";
        echo "登入嘗試" . $_SESSION['login_try'] . "次";
    }

    $wait = 0;
    if (isset($_session['login_try'])) {

        if ($_SESSION['login_try'] <= 3) {
            $wait = 0;
        } else {
            $wait = 1;
            echo "登入嘗試超過" . $_SESSION['login_try'] . "次，請等5分鐘後再試!";
        }
    }

    ?>
</div>

<?php if ($wait == 0) {
?>
    <div class="container mt-4 ">
        <form action="../api/chk_user.php" method="post">
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