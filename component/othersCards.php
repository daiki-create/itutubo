<br>
<?php
foreach ($stmt as $row){
    $name=$row['name'];
    $img_name=$row['img_name'];
    $safe_img_name=htmlspecialchars($img_name,ENT_QUOTES,"UTF-8");
    $img_name_body=pathinfo($img_name)["filename"];

    $user_id=$row['user_id'];
    $created=$row['created'];

    $count_star=$row["star"];
    $star=null;
    $null_star=null;
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


    echo "<br><div class=\"col-md-4 col-6\" style='margin: 0px'>
                        <div class='card one-card'>
                                <a href=\"../view/itemPage.php?img_name=$safe_img_name\">
                                <img src=\"../images/$img_name\"  
                                class='card-img-top'>
                                </a>
                                <div class=\"card-footer\">
                                    <div style='color: black' class='card-title'>$name</div>
                                    <div style='color: #e83e8c;
                                    display: inline'>$star</div>
                                    <div style='color: lightgray;
                                    display: inline'>$null_star</div>
                                    <div style='float: right;
                                    font-size: small;
                                    color: lightgray;
                                    display: inline'>$created</div>
                                    
                                    <div style='display: flex;
                                    '>
                                        <div style='color: lightgray;
                                        cursor: pointer;
                                        font-size: 30px;
                                        '
                                        id='off_favorite$img_name_body'
                                        >♥</div>
                                        <div style='color: #7abaff;
                                        cursor: pointer;
                                        font-size: 30px;
                                        ;'
                                        class='hidden'
                                        id='on_favorite$img_name_body'>♥</div>
                                        <div style='margin-top: 10px'>$favorite</div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       
                      
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


