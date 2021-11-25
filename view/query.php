<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include('../component/head.php') ?>
    <?php include ('../view/follow.php')?>
    <?php include ('../view/follower.php')?>
    <?php include('../component/nav.php') ?>

</head>
<body style="margin-top: 150px">
<?php
$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";

$message=$_GET["message"];
$safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
echo "$safe_message";
?>
<br>
<form class="query-form" method="post" action="../action/send.php" >
    <input type="text" class="form-control"name="subject" placeholder="件名">
    <input class="form-control" type="text" name="name" placeholder="メールアドレス">
    <textarea placeholder="お問い合わせ内容" class="form-control" name="message" id=""  rows="10"></textarea>
    <input class="btn btn-outline-dark" type="submit" value="送信">
</form>
<script src="../js/follow_toggle_ajax.js"></script>

</body>
</html>
