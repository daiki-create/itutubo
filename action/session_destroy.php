<?php
session_start();
session_destroy();

$message="ログアウトしました";
header("location: ../user/view/signUp.php?message=$message");
