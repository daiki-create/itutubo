<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include('../component/head.php') ?>
    <?php include ('../view/follow.php')?>
    <?php include ('../view/follower.php')?>
    <?php include ('../component/add.php')?>
    <?php include ('../component/bottom.html')?>
    <?php include('../component/nav.php') ?>
    <?php include('../action/createMyPage.php') ?>

</head>
<body class="under-top-nav">
<?php



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
    $userId=$_SESSION["name"];
    $follower_count=0;
    $stmt3=$pdo->query(("select * from following where follower_id='$userId'"));
    foreach ($stmt3 as $row){
        $follower_count++;
    }

    $stmt2 = $pdo->query("SELECT * FROM users where userId='$userId'");

        foreach ($stmt2 as $row) {
            $icon_name = $row["icon_name"];
            $back_name=$row["back_name"];
            $name=$row["name"];
            $color=$row["color"];

            echo "<div style=\"position: relative;top:0px;left: 0px;\">
                   
                      <div style=\"position: relative;top:0px;left: 0px;\">

                        <img src=\"../back/$back_name\" alt=\"\"
                        class='my-back'
                        >
                      </div>

                    
                    <div style=\"position: absolute;\"
                    class='my-top-contents'>
                        <img class=\"figure-img img-fluid rounded-circle icon\"
                        src=\"../icon/$icon_name\"
                        >
                        <br>
                        <div class='name-id'>
                            <div style='text-align:center;color:$color;
                            white-space: nowrap;
                            font-size: 20px'>$name</div>
                            <div style='text-align:center;color:$color;
                            white-space: nowrap;
                            font-size: 20px'>(フォロワー$follower_count)</div>

                        </div>
                        
                    </div>
                </div>";

        }

$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";

$message=$_GET["message"];
$safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
echo "$safe_message";

 ?>



<div class="container" style="margin-bottom: 500px;margin-top: 20px">
    <div class="row cards-row">
        <?php include('../component/mycards.php') ?>
    </div>
</div>
<script src="../js/follow_toggle_ajax.js"></script>

</body>
</html>


