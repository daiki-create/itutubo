<meta charset="UTF-8">




<meta name="viewport" content="width=device-width,shrink-to-fit=yes">
<title>itutubo</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<link rel="shortcut icon" href="../favicon.ico">
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/layout.css">
<link rel="stylesheet" href="../css/tablet_layout.css" media="screen and (max-width:700px)">
<link rel="stylesheet" href="../css/540.css" media="screen and (max-width:540px)">
<link rel="stylesheet" href="../css/420.css" media="screen and (max-width:420px)">
<script>
    /* ピッチインピッチアウトによる拡大縮小を禁止 */
    document.documentElement.addEventListener('touchstart', function (e) {
        if (e.touches.length >= 2) {e.preventDefault();}
    }, {passive: false});
    /* ダブルタップによる拡大を禁止 */
    var t = 0;
    document.documentElement.addEventListener('touchend', function (e) {
        var now = new Date().getTime();
        if ((now - t) < 350){
            e.preventDefault();
        }
        t = now;
    }, false);
</script>
<style>
    body , input , textarea , select {
        /* 入力欄にフォーカスが当たっても拡大しない */
        font-size:17px;
    }
</style>


