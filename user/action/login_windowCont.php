<?php
password_verify();
session_start();
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
$error = "";


if (empty($_POST["userId"])) {
    $error = 'ユーザーネームが未入力です。';
    header("location:../view/signUp.php?error=$error");
    exit();
} else if (empty($_POST["pass"])) {
    $error = 'パスワードが未入力です。';
    header("location:../view/signUp.php?error=$error");
    exit();
}

if (!empty($_POST["userId"]) && !empty($_POST["pass"])) {
    $userId = $_POST["userId"];
    $safe_userId=htmlspecialchars($userId,ENT_QUOTES,"UTF-8");


        $pass = $_POST["pass"];
        $safe_pass=htmlspecialchars($pass,ENT_QUOTES,"UTF-8");
        $stmt=$pdo->query("select * from users
            where pass='$safe_pass' && userId='$safe_userId'");



        foreach ($stmt as $user){
            if($user['pass']===$pass){
                $_SESSION["name"] = $user["userId"];
                $_SESSION["flag"]=true;
                $_SESSION["user_name"] = $user["name"];

                header("location:../../view/myPage.php");
                exit();
            }
        }
        $error="パスワードが違います";
        header("location:../view/signUp.php?error=$error");

        exit();


}

