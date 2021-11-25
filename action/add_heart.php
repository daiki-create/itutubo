<?php
session_start();
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
$img_name=$_POST["img_name"];
$safe_img_name=htmlspecialchars($img_name,ENT_QUOTES,"UTF-8");

$stmt = $pdo->prepare("insert into favorites
(user_id,img_name) values (:user_id,:img_name)");
$params=array(
    ":user_id"=>$user_id,
    ":img_name"=>$safe_img_name
);
$stmt->execute($params);

$stmt=$pdo->prepare("update items set favorite=favorite+1 where img_name=:img_name");
$params=array(
    ":img_name"=>$safe_img_name
);
$stmt->execute($params);

