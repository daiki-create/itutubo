




    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <?php include('../component/head.php') ?>
        <?php include ('../view/follow.php')?>
        <?php include ('../view/follower.php')?>
        <?php include ('../component/add.php')?>
        <?php include ('../component/bottom.html')?>
        <?php include('../component/nav.php') ?>
        <?php include ('../component/toLogin.php')?>

    </head>
    <body style="margin-top: 100px">
        <br>
        <table class="table " style="margin-bottom: 100px">

        <?php
        $error=$_GET["error"];
        $safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
        echo "$safe_error";

        $message=$_GET["message"];
        $safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
        echo "$safe_message";

            $search=$_POST['search'];
            $safe_search=htmlspecialchars($search,ENT_QUOTES,"UTF-8");

            session_start();
            $session = $_SESSION['name'];
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


            if ($_POST['search']!=null) {
                $stmt = $pdo->query("SELECT * FROM users where userId like '%$safe_search%' or name like '%$safe_search%'");

                foreach ($stmt as $row) {
                    $user_id=$row["userId"];
                    $safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");


                    $user_id3="th".$row["userId"];
                    $icon=$row["icon_name"];
                    $user_name=$row["name"];

                    if ($user_id!=$session){
                        echo "
                            <tr class='search-tr'>
                                <td width='100px' height='100px'>
                                
                                        <img class=\"figure-img img-fluid rounded-circle\"
                                        src=\"../icon/$icon\"
                                        width=\"70ox\"
                                        height='70px'>
                                    
                                <td>
                                    <a href='../view/othersPage.php?id=$safe_user_id'>
                                        <h3>$user_name</h3>
                                    </a>
                                </td>
                                <td>
                                    <button
                                        id='f$user_id3'
                                        type='button'
                                        class='hidden'
                                        style='border:solid 2px #e83e8c;
                                        color: #e83e8c;
                                        background-color: white;
                                        border-radius: 20px;
                                        padding: 5px;
                                        white-space: nowrap'
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
                                        white-space: nowrap'>
                                        はずす</button>
                                </td>
                            </tr>
                            
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

                    }




                }
            }



            ?>
        </table>



    </body>
    </html>





