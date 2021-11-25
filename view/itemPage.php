<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include('../component/head.php') ?>
    <?php include ('../view/follow.php')?>
    <?php include ('../view/follower.php')?>
    <?php include('../component/nav.php') ?>
    <?php include ('../component/add.php')?>
    <?php include ('../component/bottom.html')?>

</head>
<body style="margin-top: 60px">
<?php
$error=$_GET["error"];
$safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
echo "$safe_error";

$message=$_GET["message"];
$safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
echo "$safe_message";

session_start();
$session=$_SESSION["name"];
$img_name=$_GET["img_name"];
$safe_img_name=htmlspecialchars($img_name,ENT_QUOTES,"UTF-8");
$img_name_body=pathinfo($img_name)["filename"];

$stmt=$pdo->query("SELECT * FROM items where img_name='$safe_img_name'");


foreach ($stmt as $row) {
    $comment= $row["comment"];
    $name=$row["name"];
    $user_id=$row["user_id"];
    $user_id3="th".$row["user_id"];
    $count_star=$row["star"];

    $star=null;
    for ($i=0;$i<$count_star;$i++){
        $star.="★";
    }
    if ($count_star==0){
        $null_star.="★";
    }

    $stmt=$pdo->query("select *from favorites
where  img_name='$img_name'");
    $data=$stmt->fetchAll();
    $favorite=count($data);

    $stmt=$pdo->query("SELECT * FROM users where userId='$user_id'");
    foreach ($stmt as $row){
        $user_name=$row["name"];
        $icon_name=$row["icon_name"];
    }


    echo "
        <br>
<div class='row' style='margin-bottom: 100px;
margin-top: 30px'>
    <div class='col-md-1'>
            
    </div>
    <div class='col-md-10'>
        <img class='item-image' 
         src='../images/$img_name'
         >
        <br>
        <div style='font-size: 40px;
        margin-left: 20px'>
            $name
        </div>
        
        <div style='color: #e83e8c;
        font-size: 80px;
        margin-left: 20px'>$star</div>
        <div style='color: lightgray;
display: inline;
font-size: 50px;
margin-left: 20px'>$null_star</div>

        <div style='word-wrap: break-word;
        white-space: pre-wrap;
       
        margin-left: 10px;
        margin-right: 10px;
        font-size: 30px'
        class='item-comment'>$comment</div>
        <br>
        <br>
        
        <div style='display: flex;
        margin-left: 10px'
        class='item-bottom'>
            <img class=\"figure-img img-fluid rounded-circle itemPage-icon\"
                        src=\"../icon/$icon_name\">
            <div style='display: inline-flex;
             padding-top:8px;
              font-size:30px;
               margin-left: 20px'> <a href='othersPage.php?id=$user_id'>$user_name</a></div>     
                        
       ";
    if ($user_id!=$session){
        echo "
            <button
                id='f$user_id3'
                type='button'
                class='hidden'
                style='border:solid 2px #e83e8c;
                color: #e83e8c;
                background-color: white;
                border-radius: 20px;
                padding: 5px;
                margin-left: 50px;
                white-space: nowrap;
                height: 40px'
            >フォロー</button>
    
            <button
                type='button'
                class='hidden'
                id='d$user_id3'
                style='color: white;
                background-color: #e83e8c;
                border: none;
                border-radius: 20px;
                padding: 5px;
                margin-left: 50px;
                white-space: nowrap;
                height: 40px'>
                はずす</button>
        ";
        if (array_search($user_id,$followers)===false){
            echo "
            <script type='text/javascript' >
                var user_id3='$user_id3';
                $(\"#f\"+user_id3).toggleClass('hidden');
            </script >
            ";
        }else{
            echo "
            <script type='text/javascript' > 
                var user_id3='$user_id3';
                $(\"#d\"+user_id3).toggleClass('hidden');
            </script >
            ";
        }

        echo "
        <script>
        
          
        var session='$session';
        
            $('#f$user_id3').on('click',function () {
               
                $.ajax({
                    type:\"POST\",
                    url:\"../action/createFollowing.php\",
                    datatype:\"json\",
                    data:{
                       \"session\":session,
                        \"follower\":'$user_id'
                    },
                    done:function(){
                        console.log(\"followしました\")
        
                    },
                    fail:function () {
                        console.log(\"接続に失敗しました\")
                    }
                })
                $('#d$user_id').toggleClass('hidden');
                $('#f$user_id').toggleClass('hidden');
                $('#d$user_id2').toggleClass('hidden');
                $('#f$user_id2').toggleClass('hidden');
                $('#d$user_id3').toggleClass('hidden');
                $('#f$user_id3').toggleClass('hidden');
                        
        
            });
        
            $('#d$user_id3').on('click',function () {
                
        
                $.ajax({
                    type:\"POST\",
                    url:\"../action/dis_follow.php\",
                    datatype:\"json\",
                    data:{
                        \"session\":session,
                        \"follower\":'$user_id'
                    },
                    done:function(){
                        console.log(\"unfollowしました\")
        
                    },
                    fail:function () {
                        console.log(\"接続に失敗しました\")
                    }
                })
                $('#d$user_id').toggleClass('hidden');
                $('#f$user_id').toggleClass('hidden');
                $('#d$user_id2').toggleClass('hidden');
                $('#f$user_id2').toggleClass('hidden');
                $('#d$user_id3').toggleClass('hidden');
                $('#f$user_id3').toggleClass('hidden');
                        
        
            })
            ;
        
        
        </script>
        ";
    }else{
        echo "<a href=''
                 style='color: red;'
                 id='delete'
                 onclick='delete_mess()'><div style='padding-top: 8px;
                 margin-left: 50px;
                 white-space: nowrap'>投稿を削除</div></a>
                 
             <script>
                function delete_mess() {
                    
                  var result=window.confirm(\"投稿を削除してもよろしいですか？\");
                  if (result){
                      document.getElementById('delete').href='../action/remove_item.php?img_name=$img_name';
                      
                  }
                }
            </script>";

    }
echo "  
            <div style='color: lightgray;
            cursor: pointer;
            font-size: 30px;
            margin-left:40px '
            id='off_favorite$img_name_body'
            >♡</div>
            <div style='color: #7abaff;
            cursor: pointer;
            font-size: 30px;
            margin-left: 40px'
            class='hidden'
            id='on_favorite$img_name_body'>♥</div>
            <div style='margin-top: 10px'>$favorite</div>
        
       
        <script>
        $('#off_favorite$img_name_body').on('click',function() {
          $.ajax({
                type:\"POST\",
                url:\" ../action/add_heart.php\",
                datatype:\"json\",
                data:{
                    \"img_name\":'$img_name'
                },
                done:function(){
                    
                },
                fail:function () {
                }
            })
            $('#off_favorite$img_name_body').toggleClass('hidden');
            $('#on_favorite$img_name_body').toggleClass('hidden')
        })
        
        $('#on_favorite$img_name_body').on('click',function() {
          $.ajax({
                type:\"POST\",
                url:\" ../action/remove_heart.php\",
                datatype:\"json\",
                data:{
                    \"img_name\":'$img_name'
                },
                done:function(){
                    
                },
                fail:function () {
                }
            })
            $('#off_favorite$img_name_body').toggleClass('hidden');
            $('#on_favorite$img_name_body').toggleClass('hidden')
        })
    </script>";
    $stmt=$pdo->query("select *from favorites
where user_id='$session' && img_name='$img_name'");
    $flag=0;
    foreach ($stmt as $row){
        $flag=1;
        break;
    }
    if ($flag!=0){
        echo "<script>
                 $('#off_favorite$img_name_body').toggleClass('hidden')
                 $('#on_favorite$img_name_body').toggleClass('hidden')
        </script>
";
    }
}
?>
        </div>
    </div>

</div>

</body>
</html>



