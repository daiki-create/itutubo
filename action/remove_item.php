


<?php
$message="";
$img_name=$_GET["img_name"];
$safe_img_name=htmlspecialchars($img_name,ENT_QUOTES,"UTF-8");

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
$stmt = $pdo -> prepare("DELETE FROM items WHERE img_name=:img_name ");
$params=array(":img_name"=>$safe_img_name);
$stmt->execute($params);

unlink("../images/$safe_img_name");
$message="投稿を削除しました";
header("location: ../view/myPage.php?message=$message");
