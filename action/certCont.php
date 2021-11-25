<?php
session_start();

$mail=$_POST["mail"];
$user_id=$_POST["user_id"];

$safe_mail=htmlspecialchars($mail,ENT_QUOTES,"UTF-8");
$safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");

$message="";
try {
    $pdo = new PDO('mysql:host=mysql1024.db.sakura.ne.jp;dbname=whitecattle2_itutubo;charset=utf8',
        'whitecattle2',
        'Yd10989286',
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
}catch (Exception $e){
    $error="接続に失敗しました";
    header("location:../view/myPage.php?error=$error");
    exit();
}

if (empty($_POST["pass"]) || empty($_POST["pass2"])) {
    $message = "入力してください。";
    header("location:../view/cert.php?message=$message&mail=$mail&user_id=$user_id");
    exit();
}elseif ($_POST["pass"]!=$_POST["pass2"]){
    $message="確認パスワードが一致していません";
    header("location:../view/cert.php?message=$message&mail=$mail&user_id=$user_id");
    exit();
}

$stmt=$pdo->query("select * from users where userId='$user_id'");

foreach ($stmt as $row){
    $pass=$row["pass"];
    if($pass!=$_POST["pass"]) {
        $message="パスワードが一致しません。";
        header("location:../view/cert.php?message=$message&mail=$mail&user_id=$user_id");
        exit();
    }
}


    $stmt2=$pdo->prepare("update users set mail='$safe_mail'
            where userId='$safe_user_id'");
    $stmt2->execute();
    $message="登録メールアドレスを変更しました。";
    $_SESSION["name"]=$safe_user_id;
    header("location:../view/myPage.php?message=$message");

