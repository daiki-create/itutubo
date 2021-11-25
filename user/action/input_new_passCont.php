<?php
session_start();
password_hash();
$error="";
$message="";
$referer="../view/input_new_pass.php";
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
    header("location:../view/signUp.php?error=$error");
    exit();
}
if ($_POST["pass"] && $_POST["pass2"]){
    if (strlen($_POST["pass"])<8){
        $error="パスワードは8字以上です";
        header("location:$referer?error=$error");
        exit();
    } elseif ($_POST["pass"] != $_POST["pass2"]){
        $error="確認パスワードが一致しません";
        header("location:$referer?error=$error");
        exit();
    }else{
        $pass=$_POST["pass"];
        $safe_pass=htmlspecialchars($pass,ENT_QUOTES,"UTF-8");

        $mail=$_SESSION["mail"];
        $stmt=$pdo->prepare("update users set pass='$safe_pass' where mail='$mail'");
        $stmt->execute();
        $message="パスワードを変更しました";
        header("location:../view/signUp.php?message=$message");
        exit();
    }
}else{
    $error="パスワードを入力してください";
    header("location:$referer?error=$error");
}