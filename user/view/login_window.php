

<body>
<div  class="modal" id="login-dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ログイン</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <br>
                <form action="../action/login_windowCont.php" method="post">
                    <input  class="form-control" name="userId" type="text" placeholder="ユーザーID"  ><br>
                    <input  class="form-control" name="pass" type="password" placeholder="パスワード" ><br>
                    <input class="btn btn-outline-dark" type="submit" value="ログイン">
                </form>
                <br>
                <a href="input_mail.php">パスワードを忘れた場合</a>




            </div>
        </div>
    </div>
</div>

</body>

