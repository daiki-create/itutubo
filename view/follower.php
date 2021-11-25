



<div class="follow-mask" id="follower-mask">

</div>
<div class="follow-modal-content" id= "follower-modal-content">
    <div style="
        margin-bottom: 0px">
        <h4>
            フォロワー
        </h4>

    </div>
    <script>

        document.getElementById("follower-mask").addEventListener("click",function () {
            document.getElementById("follower-mask").style.display="none"
            document.getElementById("follower-modal-content").style.display="none"

        })
    </script>
                <table class="table follow-table"
                >
                <?php
                session_start();
                $session=$_SESSION["name"];
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

                $stmt=$pdo->query("SELECT * FROM following where follower_id='$session'");

                foreach ($stmt as $row){

                    $user_id=$row['user_id'];
                    $safe_user_id=htmlspecialchars($user_id,ENT_QUOTES,"UTF-8");

                    $user_id2="sc".$row['user_id'];

                    $stmt2=$pdo->query("SELECT * FROM users where userId='$safe_user_id'");
                    foreach ($stmt2 as $row2){
                        $user_name=$row2["name"];
                        $icon=$row2["icon_name"];
                    }

                    echo "
                        
                            <tr class='follow-tr'>
                    <td class='follow-left'
                     style='padding: 10px 0 0 0;
                     width: 100px'>
                    
                            <img class=\"figure-img img-fluid rounded-circle\"
                            src=\" ../icon/$icon\"
                            width=\"70px\"
                            height='70px'>
                        
                    </td>
                    <td class='follow-center'
                    style='padding: 10px 0 0 0;'>
                        <a href='../view/othersPage.php?id=$safe_user_id'>
                            <h3>$user_name</h3>
                        </a>
                    </td>
                     <td style='padding: 10px 0 0 0;
                                width: 100px;
                                white-space: nowrap'>
                                    <button
                                        id='f$user_id2'
                                        type='button'
                                        class='hidden'
                                        style='border:solid 2px #e83e8c;
                                        color: #e83e8c;
                                        background-color: white;
                                        border-radius: 20px;
                                        padding: 5px'
                                    >フォロー</button>
                        
                                    <button
                                        type='button'
                                        class='hidden'
                                        id='d$user_id2'
                                        style='color: white;
                                        background-color: #e83e8c;
                                        border: none;
                                        border-radius: 20px;
                                        padding: 5px'>
                                        はずす</button>
                                </td>
                </tr>
                        
                    ";
                    if (array_search($user_id,$followers)===false){
                        echo "
                            <script type='text/javascript' >
                                var user_id2='$user_id2';
                                $(\"#f\"+user_id2).toggleClass('hidden');
                            </script >
                            ";
                    }else{
                        echo "
                            <script type='text/javascript' > 
                                var user_id2='$user_id2';
                                $(\"#d\"+user_id2).toggleClass('hidden');
                            </script >
                            ";
                    }

                    echo "
                        <script>
                        
                          
                        var session='$session';
                        
                            $('#f$user_id2').on('click',function () {
                               
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
                                $('#dth$user_id').toggleClass('hidden');
                                $('#fth$user_id').toggleClass('hidden');
                        
                        
                            });
                        
                            $('#d$user_id2').on('click',function () {
                                
                        
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
                                $('#dth$user_id').toggleClass('hidden');
                                $('#fth$user_id').toggleClass('hidden');
                        
                        
                            })
                            ;
                        
                        
                        </script>
                       ";



                }
                ?>
                </table>

            </div>
        </div>
    </div>
</div>

