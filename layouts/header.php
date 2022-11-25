<div>

    <h1 style='text-align:center'>泰山職訓中心</h1>

</div>

<header>
    <nav>
        <?php
        $local = str_replace(["/", ".php"], "", $_SERVER['PHP_SELF']);

        switch ($local) {
            case 'index':
                echo "<a href='reg.php'>教師註冊</a>";
                echo "<a href='login.php'>教師登入</a>";
                break;
            case 'admin_center':
                echo  " <a href='admin_center.php?do=add'>新增學生</a>";
                echo  "<a href='logout.php'>教師登出</a>";
                break;
            default:
                echo  " <a href='admin_center.php?do=add'>新增學生</a>";
                echo  "<a href='logout.php'>教師登出</a>";
                break;
        }
        ?>


    </nav>
</header>