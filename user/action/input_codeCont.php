<?php

$error="";
$message="";
$code=$_POST["code"];
$safe_code=htmlspecialchars($code,ENT_QUOTES,"UTF-8");
$input_code=$_POST["input_code"];
$safe_input_code=htmlspecialchars($input_code,ENT_QUOTES,"UTF-8");
$referer="../view/input_code.php";

if ($safe_input_code!=$safe_code){
    $error="コードが違います";
    header("location:$referer?error=$error&code=$safe_code");
    exit();
}else{
    header("location:../view/input_new_pass.php");
    exit();
}
