<?php

session_start();
$message="";
$user_id=$_SESSION["name"];
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
$stmt=$pdo->prepare("delete from users where userId=:userId");
$params=array(
    ":userId"=>$user_id
);
$stmt->execute($params);

$stmt=$pdo->prepare("delete from following where user_id=:userId; ");
$stmt->execute($params);

$stmt=$pdo->prepare("delete from following where follower_id=:userId; ");
$stmt->execute($params);

$stmt=$pdo->prepare("delete from favorites where user_id=:userId ");
$stmt->execute($params);

$stmt=$pdo->prepare("delete from items where user_id=:userId ");
$stmt->execute($params);

session_destroy();
$message="退会しました";
header("location: ../user/view/signUp.php?message=$message");
