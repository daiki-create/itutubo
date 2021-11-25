<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include('../component/head.php') ?>
    <?php include ('../view/follow.php')?>
    <?php include ('../view/follower.php')?>
    <?php include ('../component/add.php')?>
    <?php include ('../component/bottom.html')?>
    <?php include('../component/nav.php') ?>
    <?php include('../action/createOthersPage.php') ?>

</head>
<body class="under-top-nav">
<?php




$userId=$_GET["id"];
$follower_count=0;
$stmt2=$pdo->query(("select * from following where follower_id='$userId'"));
foreach ($stmt2 as $row){
    $follower_count++;
}
$stmt3 = $pdo->query("SELECT * FROM users where userId='$userId'");

    foreach ($stmt3 as $row) {
        $icon_name = $row["icon_name"];
        $back_name=$row["back_name"];
        $name=$row["name"];
        $color=$row["color"];


        echo "<div style=\"position: relative;top:0px;left: 0px;\">
                    
                  <div style=\"position: relative;top:0px;left: 0px;\">
                        <img src=\"../back/$back_name\" alt=\"\"
                        class='others-back'
                        >
                  </div>
                        
                        
                       
                    <div style=\"position: absolute;\"
                    class='my-top-contents'>
                        <img class=\"figure-img img-fluid rounded-circle icon\"
                        src=\"../icon/$icon_name\"
                        >
                        <br>
                        <div class='name-id'>
                            <div style='text-align:center; color:$color;
                            font-size: 20px'>$name</div>
                            <div style='text-align:center; color:$color;
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
        <?php include('../component/othersCards.php') ?>
    </div>
</div>
</body>
<script src="../js/follow_toggle_ajax.js"></script>

</html>

