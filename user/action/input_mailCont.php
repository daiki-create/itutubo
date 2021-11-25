<?php
session_start();
$error="";
$message="";
$referer="../view/input_mail.php";
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
if ($_POST["mail"]){

    $code="";
    for ($i=0;$i<6;$i++){
        $code.=mt_rand(0,9);
    }
    $from="info@itutubo.com";
    $to=$_POST["mail"];
    $safe_to=htmlspecialchars($to,ENT_QUOTES,"UTF-8");

    $subject="iTuTuBo　コード:$code";
    $body="
    
    (このメールアドレスは送信専用です。)
    
    iTuTuBoのパスワードリセットが要求されました。
    以下のコードを入力してください。
    
    コード:$code
    ";
    $headers="From: {$from}";
    $stmt=$pdo->query("select * from users where mail='$safe_to'");
    $stmt->execute();
    $count=$stmt->rowCount();
    if ($count==0){
            $error="このメールアドレスは登録されていません";
            header("location:$referer?error=$error ");
            exit();
    }else{

        $_SESSION["mail"]=$safe_to;

        $safe_code=htmlspecialchars($code,ENT_QUOTES,"UTF-8");
        mb_send_mail($safe_to,$subject,$body,$headers);
        header("location:../view/input_code.php?code=$safe_code&mail=$safe_to");

    }




}else{
    $error="メールアドレスを入力してください";
    header("location:$referer?error=$error ");
    exit();
}

