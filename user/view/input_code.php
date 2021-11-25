<link rel="shortcut icon" href="../../favicon.ico">

<?php include('../../component/head.php') ;
$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";

$code=$_GET["code"];
$safe_code=htmlspecialchars($code,ENT_QUOTES,"UTF-8");


?>

<p>
    メールに送信されたコードを入力してください
</p>
<form method="post" action="../action/input_codeCont.php?code=$code">
    <input type="text" name="input_code" class="form-control" placeholder="コード">
    <?php echo "<input type=\"hidden\" name=\"code\" value=\"$safe_code\">"?>
    <input type="submit" value="次へ" class="btn btn-primary">
</form>