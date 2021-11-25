<link rel="shortcut icon" href="../../favicon.ico">




<?php include('../../component/head.php') ;
$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";
        ?>



<form method="post" action="../action/input_new_passCont.php">
    <input type="password" name="pass" class="form-control" placeholder="新しいパスワード">
    <input type="password" name="pass2" class="form-control" placeholder="確認">
    <input type="submit" value="次へ" class="btn btn-primary">
</form>