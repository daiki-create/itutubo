<link rel="shortcut icon" href="../../favicon.ico">

<?php include('../../component/head.php');
$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";
?>
<div>登録しているメールアドレスを入力してください</div>
<form method="post" action="../action/input_mailCont.php">
    <input type="email" name="mail" class="form-control" placeholder="メールアドレス">
    <input type="submit" value="次へ" class="btn btn-primary">
</form>
