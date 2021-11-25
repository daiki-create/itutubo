<?php
if ($_SESSION["flag"]!=true){
    echo "
        <script>
        var result=window.alert(\"ログインしてください\");
        window.location.href=\"../user/view/signUp.php\";

    </script>";
}
