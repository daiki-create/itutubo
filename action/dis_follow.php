


<?php
$user_id=$_POST['session'];
$dis=$_POST["follower"];

$safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");
$safe_dis=htmlspecialchars($dis,ENT_QUOTES,"UTF-8");

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
$stmt = $pdo -> prepare("delete from following where follower_id=:follower_id and user_id=:user_id");
$params=array(
    ":follower_id"=>$safe_dis,
    ":user_id"=>$safe_user_id
);
$stmt->execute($params);
