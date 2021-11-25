<?php
password_hash();
session_start();

$error = "";
$message = "";
$reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";

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
$stmt=$pdo->query("select * from users");
foreach ($stmt as $row){
    if ($row["userId"]===$_POST["userId"]){
        $error = 'このユーザーIDはすでに使用されています';
        header("location:../view/signUp.php?error=$error");
        exit();
    }elseif ($row["mail"]===$_POST["mail"]){
        $error = 'このメールアドレスはすでに使用されています';
        header("location:../view/signUp.php?error=$error");
        exit();
    }
}
    if (empty($_POST["name"])) {
        $error= 'ユーザー名が未入力です';
        header("location:../view/signUp.php?error=$error");
        exit();
    } else if (empty($_POST["userId"])) {
        $error = 'ユーザーIDが未入力です';
        header("location:../view/signUp.php?error=$error");
        exit();
    } else if (strlen($_POST["pass"])<4) {
        $error = 'パスワードは4字以上です';
        header("location:../view/signUp.php?error=$error");
        exit();
    } else if (empty($_POST["pass2"])) {
        $error = '確認用パスワードが未入力です';
        header("location:../view/signUp.php?error=$error");
        exit();
    }else if (($_POST["pass"])!=($_POST["pass2"])) {
        $error = '確認パスワードが一致しません';
        header("location:../view/signUp.php?error=$error");
        exit();
    } else if (empty($_POST["mail"])) {
        $error = 'メールアドレスが未入力です';
        header("location:../view/signUp.php?error=$error");
        exit();
    }elseif (!preg_match($reg_str, $_POST["mail"])) {
        $error = 'メールアドレスが適切ではありません';
        header("location:../view/signUp.php?error=$error");
        exit();
    }

    if (!empty($_POST["userId"]) && !empty($_POST["pass"]) && !empty($_POST["pass2"]) && $_POST["pass"] === $_POST["pass2"]) {
        $userId = $_POST["userId"];
        $pass = $_POST["pass"];
        $mail=$_POST["mail"];
        $name=$_POST["name"];

        $safe_userId=htmlspecialchars($userId,ENT_QUOTES,"UTF-8");
        $safe_pass=htmlspecialchars($pass,ENT_QUOTES,"UTF-8");
        $safe_mail=htmlspecialchars($mail,ENT_QUOTES,"UTF-8");
        $safe_name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");



        $stmt=$pdo->prepare("insert into users(name,userId,pass,mail) 
                values (:name,:userId,:pass,:mail)");
        $params=array(
            ":name"=>$safe_name,
            ":userId"=>$safe_userId,
            ":pass"=>$safe_pass,
            ":mail"=>$safe_mail
        );
        $stmt->execute($params);


        $_SESSION["name"]=$userId;
        $_SESSION["flag"]=true;
        $_SESSION["user_name"] = $name;

        header("location:../../view/myPage.php");
        exit();






    }else if($_POST["password"] != $_POST["password2"]) {
        $error = 'パスワードが一致しません';
        header('location:../view/signUp.php?error=$error');
    }




