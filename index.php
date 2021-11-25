<!DOCTYPE html>
<html lang="ja">
<head>

    <?php include('component/head2.php') ?>
    <?php include ('view/follow.php')?>
    <?php include ('view/follower.php')?>
    <?php include('component/nav.php') ?>
    <?php include ('component/add.php')?>
    <?php include ('component/bottom.html')?>


</head>
<body class="under-top-nav">
<div class="row">
    <div>
        <div class="top-contents" style="position: relative;top:0px;">
        <img src="back/back.png"
             class="top-image"
                 >
            <div class="top-text">
                <div style="color: #e83e8c;"
                class="itutubo"><strong>itutubo</strong></div>
                <div style="color: #e83e8c;"
                class="itutubo-paragraf">　　　あなただけの
                                        <br>　　　　五つ星アイテム
                                        <br>　　　　　を共有しよう</div>
                        </div>
        </div>
    </div>
</div>
<br>
<?php
$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";

$message=$_GET["message"];
$safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
echo "$safe_message";


?>
<a href="https://t.afi-b.com/visit.php?guid=ON&a=Y7654s-j259751p&p=d790665f" rel="nofollow"><img src="https://www.afi-b.com/upload_image/7654-1455263468-3.jpg" width="336" height="280" style="border:none;" alt="全国菓子大博覧会受賞店のホワイトデー" /></a><img src="https://t.afi-b.com/lead/Y7654s/d790665f/j259751p" width="1" height="1" style="border:none;" />
<div class="container" style="margin-bottom: 500px">
    <div class="row cards-row">
        <?php include('component/cards.php') ?>
    </div>
    <a href="https://t.afi-b.com/visit.php?guid=ON&a=Y7654s-a254891K&p=d790665f" rel="nofollow"><img src="https://www.afi-b.com/upload_image/7654-1457834062-3.jpg" width="300" height="250" style="border:none;" alt="サロンドロワイヤル" /></a><img src="https://t.afi-b.com/lead/Y7654s/d790665f/a254891K" width="1" height="1" style="border:none;" />
    <a href="https://t.afi-b.com/visit.php?guid=ON&a=Y7654s-d254893A&p=d790665f" rel="nofollow"><img src="https://www.afi-b.com/upload_image/7654-1458634662-3.jpg" width="300" height="250" style="border:none;" alt="サロンドロワイヤル" /></a><img src="https://t.afi-b.com/lead/Y7654s/d790665f/d254893A" width="1" height="1" style="border:none;" />
    <a href="https://t.afi-b.com/visit.php?guid=ON&a=Y7654s-X254890f&p=d790665f" rel="nofollow"><img src="https://www.afi-b.com/upload_image/7654-1457441862-3.jpg" width="300" height="250" style="border:none;" alt="サロンドロワイヤル" /></a><img src="https://t.afi-b.com/lead/Y7654s/d790665f/X254890f" width="1" height="1" style="border:none;" />
</div>

<script src="js/follow_toggle_ajax.js"></script>

</body>
</html>

