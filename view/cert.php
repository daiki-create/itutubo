

<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include('../component/head.php') ?>
</head>

<body>
<?php
$mail=$_GET["mail"];
$safe_mail=htmlspecialchars($mail,ENT_QUOTES,"UTF-8");

$user_id=$_GET["user_id"];
$safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");

$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";

$message=$_GET["message"];
$safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
echo "$safe_message";
echo "<br><br>
<div class=\"row\">
    <div class=\"col-md-2 \">

    </div>
    <div class=\"col-md-8 col-12\">
        <form method=\"post\" action=\"../action/certCont.php\"
              style=\"max-width: 100%\">
            <input type=\"hidden\" name=\"mail\" value=$safe_mail>
            <input type=\"hidden\" name=\"user_id\" value=$safe_user_id>
            <input type=\"password\" name=\"pass\" placeholder=\"パスワード\" class='form-control'>
            <input type=\"password\" name=\"pass2\" placeholder=\"パスワード(再入力)\" class='form-control'>
            <input type=\"submit\" value=\"メールアドレス変更\" class='btn btn-primary'>
        </form>
    </div>
</div>";
?>

</body>
</html>


