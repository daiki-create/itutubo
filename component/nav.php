


<nav style="margin: auto;max-width: 100%;
padding: 0px" class="top-nav nav fixed-top nav-pills bg-dark">
        <div class="nav left-nav"
        style="margin-left: 30px;
        margin-top: 10px;
        padding-right: 0px">
            <div class="dropdown">
                <button class="nav-item btn btn-light dropdown-toggle"
                        id="dropdown1"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-toggle="dropdown">三</button>
                <div class="dropdown-menu" aria-labelledby="dropdown1">
                    <button class="dropdown-item" onclick="location.href='../user/view/signUp.php';
                    ">ログイン</button>
                    <button class="dropdown-item" onclick="location.href='../action/session_destroy.php';
                    ">ログアウト</button>
                    <button onclick="location.href='../view/edit.php'" class="dropdown-item">設定</button>
                    <button onclick="location.href='../view/query.php'" class="dropdown-item">問い合わせ</button>
                    <a style="cursor: pointer" id="retire" onclick="retire()" class="dropdown-item">退会</a>
                    <script>
                        function retire() {
                            var result=window.confirm("退会すると登録しているデータと投稿がすべて削除されます。" +
                                "よろしいですか？")
                            if (result){
                                document.getElementById("retire").href="../action/retire.php"
                            }
                        }
                    </script>
                </div>

            </div>
        </div>
        <div class="nav center-nav"
        style="margin-left: 30px;
        margin-top: 10px;
        margin-right: 0px;
        padding-right: 0px">
            <form  action="../view/users_list.php" method="post" style="display: flex">
                <input  class="form-control" type="text" placeholder="ID/名前" name="search"
                        >
                <input type="submit" value="検索"
                       >
            </form>
        </div>
        <div class="nav right-nav "
        style=" padding-right: 0px;
        margin-top: 10px;
        margin-bottom: 10px">
            <a class="nav-link" href="../view/lank.php">トレンド</a>
            <a class="nav-link" href="../index.php">新着</a>
            <a class="nav-item nav-link" href="../view/myPage.php">マイページ</a>
            <div id="nav-follow" onmouseover="mouseover()"
                 onmouseout="mouseout()"
                 onclick="open_follow_modal()"
                 class="nav-item" style="color: white;padding: 8px;cursor: pointer">フォロー</div>
            <div id="nav-follower" onmouseover="mouseover2()"
                 onmouseout="mouseout2()"
                 onclick="open_follower_modal()" class="nav-item" style="color: white;padding: 8px;cursor: pointer" data-toggle="modal" data-target="#follower">フォロワー</div>
        </div>


    <script>
        function mouseover() {
            document.getElementById("nav-follow").style.color="lightblue"
        }
        function mouseout() {
            document.getElementById("nav-follow").style.color=null
        }
        function mouseover2() {
            document.getElementById("nav-follower").style.color="lightblue"
        }
        function mouseout2() {
            document.getElementById("nav-follower").style.color=null
        }

        function open_follow_modal() {
            document.getElementById("follow-mask").style.display="block";
            document.getElementById("follow-modal-content").style.display="block";
        }

        function open_follower_modal() {
            document.getElementById("follower-mask").style.display="block";
            document.getElementById("follower-modal-content").style.display="block";
        }
    </script>
</nav>




