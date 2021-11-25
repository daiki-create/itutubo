<?php


$user_id=$_POST['session'];
$follower_id=$_POST["follower"];

$safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");
$safe_follower_id=htmlspecialchars($follower_id,ENT_QUOTES,"UTF-8");

$message="";
$error="";
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


    $stmt = $pdo->prepare("INSERT INTO following (user_id,follower_id) VALUES (:user_id,:follower_id)");

    $params = array(':user_id' => $safe_user_id,
        ':follower_id' => $safe_follower_id
    );

    $stmt->execute($params);

