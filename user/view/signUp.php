<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
        <title>iTuTuBo</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/layout.css">
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="../../favicon.ico">

    </head>
    <body>
    <?php
    @session_destroy();
    $error=$_GET["error"];
    $safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
    echo "$safe_error";

    $message=$_GET["message"];
    $safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
    echo "$safe_message";
    ?>

    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <br>
                <h3 style="text-align: center">新しいユーザーを作成</h3>
            </div>
        </div>

        <div class="row">

            <form name="form" style="margin: auto; " action="../action/signUpCont.php" method="post" >
                <div id="message" style="color: red">
                </div>
                <div class="align-items-center">
                    <lavel for="text">ユーザー名</lavel>
                    <input type=text"" class="form-control" name="name" placeholder="氏名またはニックネーム">
                </div>
                <div class="form-group">
                    <lavel for="text">ID</lavel>
                    <div id="id_check" style="color: red">
                    </div>
                    <input type="text" placeholder="半角英数字" name="userId" class="form-control">
                </div>
                <div class="form-group">
                    <lavel for="password">パスワード</lavel>
                    <div id="pass_check" style="color: red">
                    </div>
                    <input minlength="4" type="password" placeholder="半角英数字" name="pass" class="form-control">
                </div>
                    <div class="form-group">
                    <lavel for="password">パスワード再入力</lavel>
                    <input minlength="4" type="password" placeholder="半角英数字" name="pass2" class="form-control">
                </div>
                <div class="form-group">
                    <lavel for="email">メールアドレス</lavel>
                    <input type="email" class="form-control" name="mail" placeholder="">
                </div>
                <div class="form-group">
                    <input type="submit" value="新規登録" class="btn btn-dark"
                    onclick="return checkForm()">
                </div>
            </form>
        </div>
        <br>

        <div class="row">
            <button style="margin: auto; " type="button" class="btn btn-outline-dark"
                    onclick="$('#login-dialog').modal('show')">
                ログインはこちらから
            </button>
        </div>
        <br>
    </div>

    <?php include ('login_window.php') ?>

    </body>
    <script>
        function checkForm(){
            document.getElementById("id_check").textContent=""
            document.getElementById("pass_check").textContent=""
            document.getElementById("message").textContent=""

            if(document.form.name.value==""
            || document.form.userId.value==""
            || document.form.pass.value==""
            || document.form.pass2.value==""
            || document.form.mail.value==""){
                var message=document.getElementById("message")
                message.textContent="未入力欄があります"
                return false;
            }
            if(!document.form.userId.value.match(/^[0-9a-zA-Z]+$/)){
                var id_check=document.getElementById("id_check")
                id_check.textContent="半角英数字で入力してください"
                return false;
            }
            if(document.form.pass.value!=document.form.pass2.value){
                var pass_check=document.getElementById("pass_check")
                pass_check.textContent="パスワードが一致していません"
                return false;
            }

            else {
                return true;
            }
        }
    </script>
</html>

