
<?php
if ($_SESSION["flag"]!=true){
    echo "
        <script>
        var result=window.alert(\"ログインしてください\");
        window.location.href=\"../user/view/signUp.php\";

    </script>";
}
session_start();
$user_id=$_SESSION['name'];
$user_name=$_SESSION['user_name'];

$error="";

$name=$_POST['name'];
$comment=$_POST['comment'];
$star=$_POST["star"];
$safe_name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");
$safe_comment=htmlspecialchars($comment,ENT_QUOTES,"UTF-8");
$safe_star=htmlspecialchars($star,ENT_QUOTES,"UTF-8");

if(empty($_POST["name"])){
    $error="商品名が未入力です";
    header("location:../view/myPage.php?error=$error");
    exit();
}else if(empty($_POST["comment"])){
    $error="商品の紹介文が未入力です";
    header("location:../view/myPage.php?error=$error");
    exit();
}else if(empty($_POST["img"])){
    $error="画像の表示範囲が指定されていません";
    header("location:../view/myPage.php?error=$error");
    exit();
}elseif(strlen($_POST["name"])>50){
    $error="商品名は50文字以内です";
    header("location:../view/myPage.php?error=$error");
    exit();
}elseif(strlen($_POST["name"])>400){
    $error="紹介文は400文字以内です";
    header("location:../view/myPage.php?error=$error");
    exit();
}



$img_ext="png";
    #pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
if($img_ext!="png" && $img_ext!="jpg" && $img_ext!="gif" && $img_ext!="jpeg") {
    $error="画像ファイルのみ対応です";
    header("location:../view/myPage.php?error=$error");
    exit();
}else{
    $img_name=md5(uniqid(rand(),true)).'.'.$img_ext;
    $img_size=5;
        #$_FILES['img']['size'];

    $canvas = $_POST["img"];
    #$canvas = preg_replace("/data:[^,]+,/i","",$canvas);
    copy($canvas,"../images/$img_name");


    #$canvas=base64_decode($canvas);
    #$image=imagecreatefromstring($canvas);
    #imagepng($image,"../images/$img_name");


    $created=date("y/m/d G:i:s");

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



        $stmt = $pdo->prepare("INSERT INTO items (name,comment,img_size,img_ext,img_name,created,user_id,user_name,star) 
        VALUES (:name,:comment,:img_size,:img_ext,:img_name,:created,:user_id,:user_name,:star)");
        $params = array(':name' => $safe_name,
            ':comment' => $safe_comment,
            ':img_name' => $img_name,
            ':img_size' => $img_size,
            ':img_ext' => $img_ext,
            ':created' => $created,
            ':user_id' => $user_id,
            ':user_name'=>$user_name,
            ':star'=>$safe_star

        );
        $stmt->execute($params);

    $message = "アップロードしました。";
    header("location:../view/myPage.php?message=$message");

}
