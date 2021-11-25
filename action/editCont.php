<?php
password_hash();
session_start();
$user_id=$_SESSION['name'];
$safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");

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

if ($_POST["img"]) {
    $img_ext = "png";
    $img_name = md5(uniqid(rand(), true)) . '.' . $img_ext;
    $img_size = 5;
    $canvas = $_POST["img"];
    $safe_canvas=htmlspecialchars($canvas,ENT_QUOTES,"UTF-8");
    copy($safe_canvas,"../icon/$img_name");
    $stmt = $pdo->prepare("update users set
        icon_name='$img_name',
        icon_ext='$img_ext',
        icon_size='$img_size'
        where userId='$user_id'");

    $stmt->execute();
    $message="プロフィール画像を変更しました。";
    header("location:../view/edit.php?message=$message");
    exit();
}elseif ($_POST["back"]) {
    $back_ext = "png";
    $back_name = md5(uniqid(rand(), true)) . '.' . $back_ext;
    $back_size = 5;
    $canvas = $_POST["back"];
    $safe_canvas=htmlspecialchars($canvas,ENT_QUOTES,"UTF-8");

    copy($safe_canvas,"../back/$back_name");
    $stmt = $pdo->prepare("update users set
        back_name='$back_name',
        back_size='$back_size'
        where userId='$user_id'");

    $stmt->execute();
    $message="背景画像を変更しました。";
    header("location:../view/edit.php?message=$message");
    exit();
}
elseif ($_POST["mail"]){
    $from="info@itutubo.com";
    $to=$_POST["mail"];
    $safe_to=htmlspecialchars($to,ENT_QUOTES,"UTF-8");
    $subject="iTuTuBo メールアドレス変更";
    $body="
    (このメールアドレスは送信専用です。)
    以下のリンクよりメールアドレスの変更を完了してください。
    
    https://itutubo.com/view/cert.php?mail=$safe_to&user_id=$safe_user_id
    ";
    $headers="From: {$from}";
    mb_send_mail($safe_to,$subject,$body,$headers);
    $message="変更をご希望のメールアドレスにメールを送信しました。操作を完了してください。";
    header("location:../view/myPage.php?message=$message");
    exit();
}elseif ($_POST["pass"]){
    $pass=$_POST["pass"];
    $safe_pass=htmlspecialchars($pass,ENT_QUOTES,"UTF-8");

    $stmt=$pdo->query("select * from users where userId='$user_id'");
    foreach ($stmt as $row){
        if ($pass!=$row["pass"]){
            $error="現在のパスワードが間違っています。";
            header("location:../view/edit.php?error=$error");
            exit();
        }
    }
    if ($_POST["edit-pass"]===$_POST["edit-pass2"]){
        $e_pass=$_POST["edit-pass"];
        $safe_e_pass=htmlspecialchars($e_pass,ENT_QUOTES,"UTF-8");

        $stmt=$pdo->prepare("update users set pass='$safe_e_pass' where userId='$user_id'");
        $stmt->execute();
        $message="パスワードを変更しました。";
        header("location:../view/edit.php?message=$message");
        exit();
    }elseif (strlen($_POST["edit-pass"])<4){
        $error="パスワードが4文字未満です。";
        header("location:../view/edit.php?error=$error");
        exit();
    }elseif($_POST["edit-pass"]!=$_POST["edit-pass2"]){
        $error="確認用パスワードが一致しません";
        header("location:../view/edit.php?error=$error");
        exit();
    }
}elseif ($_POST["color"]){
    $color=$_POST["color"];
    $safe_color=htmlspecialchars($color,ENT_QUOTES,"UTF-8");

    $stmt=$pdo->prepare("update users set color='$safe_color' where userId='$user_id'");
    $stmt->execute();
    $message="マイページの文字色を変更しました。";
    header("location:../view/edit.php?message=$message");
    exit();
}elseif ($_POST["name"]){
    if ($_POST["name"]==""){
        $message="ユーザー名が未入力です";
        header("location:../view/edit.php?message=$message");
        exit();
    }
    $name=$_POST["name"];
    $safe_name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");
    $stmt=$pdo->prepare("update users set name='$safe_name' where userId='$user_id'");
    $stmt->execute();
    $message="ユーザー名を変更しました";
    header("location:../view/edit.php?message=$message");
    exit();
}
else{
    header("location:../view/edit.php");

}

