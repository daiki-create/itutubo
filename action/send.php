<?php

$error="";
if (empty($_POST["subject"])){
    $error="件名を入力してください。";
    header("location:../view/query.php?error=$error");
    exit();
}if (empty($_POST["name"])){
    $error="お名前を入力してください。";
    header("location:../view/query.php?error=$error");
    exit();
}if (empty($_POST["message"])){
    $error="お問い合わせ内容を入力してください。";
    header("location:../view/query.php?error=$error");
    exit();
}
$from="info@itutubo.com";

$to="odai93169@gmail.com";
$subject=$_POST["subject"];
$safe_subject=htmlspecialchars($subject,ENT_QUOTES,"UTF-8");
$name=$_POST["name"];
$message=$_POST["message"];

$safe_name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");
$safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");

$message="name:".$safe_name."/".$safe_message;
$headers="From: {$from}";
$parameters="-f{$from}";

mb_send_mail($to,$safe_subject,$message,$headers);
$message="送信しました。";
header("location:../view/query.php?message=$message");