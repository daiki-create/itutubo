<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include('../component/head.php') ?>
    <?php include ('../view/follow.php')?>
    <?php include ('../view/follower.php')?>
    <?php include('../component/nav.php') ?>

</head>
<body style="margin-top: 100px">
<br><br>

<div class="row edit-form">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <?php
        $error=$_GET["error"];
        $safe_error=htmlspecialchars($error,ENT_QUOTES,"UTF-8");
        echo "<div style='color: red'>$safe_error</div>";

        $message=$_GET["message"];
        $safe_message=htmlspecialchars($message,ENT_QUOTES,"UTF-8");
        echo "<div style='color: red'>$safe_message</div>";
        ?>
        <table class="table table-bordered"
        style="max-width: 100%;" ">
            <tr>
                <td>
                    <form id="form" action="../action/editCont.php" method="post" enctype="multipart/form-data">
                        <label>プロフィール画像</label><br>
                        <input id="set_img" type="file" >
                        <input type="hidden" name="img" id="img">
                        <button type="button" onclick="submit1()"
                                style="float: right">変更</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form id="form2" action="../action/editCont.php" method="post" enctype="multipart/form-data">
                        <label>背景画像</label><br>
                        <input id="set_back" type="file" >
                        <input type="hidden" name="back" id="back">
                        <button type="button" onclick="submit2()"
                                style="float: right">変更</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form  action="../action/editCont.php" method="post" enctype="multipart/form-data">
                        <input placeholder="メールアドレス" style="border: none" name="mail" type="email">
                        <input style="float: right" value="変更" type="submit" >
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form  action="../action/editCont.php" method="post" enctype="multipart/form-data">
                        <input placeholder="ユーザー名" style="border: none" name="name" type="text">
                        <input style="float: right" value="変更" type="submit" >
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form  action="../action/editCont.php" method="post" enctype="multipart/form-data">
                        <input placeholder="現在のパスワード" style="border: none" name="pass" type="password" ><br><br>
                        <input placeholder="変更パスワード(8字以上)" style="border: none" name="edit-pass" type="password" ><br><br>
                        <input placeholder="変更パスワード(再入力)" style="border: none" name="edit-pass2" type="password" >
                        <input style="float: right" value="変更" type="submit" >
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form  action="../action/editCont.php" method="post" enctype="multipart/form-data">
                        <label for="color">マイページの文字色</label>
                        <input type="color" name="color" id="color">
                        <input style="float: right " value="変更" type="submit" >
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-2">

    </div>
</div>
<div class="icon-mask" id="icon-mask"
onclick="close_icon_modal()">

</div>
<div class="icon-modal" id="icon-modal">
    <div style="display: flex">
        <div>拡大縮小</div>
        <input id='scal' type='range' value='' min='10' max='400' oninput="scaling(value)" style='width: 300px;'><br>

    </div>
    <canvas id='cvs' width='400' height='400'></canvas><br>

    <button type="button" onclick='crop_img();close_icon_modal()'>決定</button><br>
    <canvas class="hidden" id='out' width='300' height='300'></canvas>


    <script type="text/javascript">
        const cvs = document.getElementById( 'cvs' )
        const cw = cvs.width
        const ch = cvs.height
        const out = document.getElementById( 'out' )
        const oh = out.height
        const ow = out.width

        let ix = 0    // 中心座標
        let iy = 0
        let v = 1.0   // 拡大縮小率



        const img  = new Image()
        img.onload = function( _ev ){   // 画像が読み込まれた
            ix = img.width  / 2
            iy = img.height / 2
            let scl = parseInt( cw / img.width * 100 )
            document.getElementById( 'scal' ).value = scl
            scaling( scl )
        }
        function load_img( _url ){  // 画像の読み込み
            img.src = ( _url ? _url : '' )
        }
        load_img()
        function scaling( _v ) {        // スライダーが変った
            v = parseInt( _v ) * 0.01
            draw_canvas( ix, iy )       // 画像更新
        }

        function draw_canvas( _x, _y ){     // 画像更新
            const ctx = cvs.getContext( '2d' )
            ctx.fillStyle = 'rgb(200, 200, 200)'
            ctx.fillRect( 0, 0, cw, ch )    // 背景を塗る
            ctx.drawImage( img,
                0, 0, img.width, img.height,
                (cw/2)-_x*v, (ch/2)-_y*v, img.width*v, img.height*v,
            )
            ctx.strokeStyle = 'rgba(0, 0, 0, 0.8)'
            ctx.strokeRect( (cw-ow)/2, (ch-oh)/2, ow, oh ) // 赤い枠
        }
        function crop_img(e){                // 画像切り取り
            const ctx = out.getContext( '2d' )
            ctx.fillStyle = 'rgb(200, 200, 200)'
            ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
            ctx.drawImage( img,
                0, 0, img.width, img.height,
                (ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,
            )
            if (out.msToBlob) { //for IE
                var blob = out.msToBlob();
                window.navigator.msSaveBlob(blob, 'download.png');
            } else {
                var image_data = out.toDataURL("image/png");
                $('#img').val(image_data);

            }


        }

        function submit1(){
            var form=document.forms.form;
            form.submit();
        }





        let mouse_down = false      // canvas ドラッグ中フラグ
        let sx = 0                  // canvas ドラッグ開始位置
        let sy = 0
        let xm = 0                  // canvas ドラッグ開始位置
        let ym = 0
        cvs.ontouchstart =function ( _ev ){     // canvas ドラッグ開始位置
            mouse_down = true
            sx = _ev.changedTouches[0].pageX
            sy = _ev.changedTouches[0].pageY
            return false // イベントを伝搬しない
        }
        cvs.ontouchmove =function ( _ev ){     // canvas ドラッグ中
            if ( mouse_down == false ) return
            xm = _ev.changedTouches[0].pageX
            ym = _ev.changedTouches[0].pageY
            draw_canvas( ix + (sx-xm)/v, iy + (sy-ym)/v )
            return false // イベントを伝搬しない
        }

        cvs.onmousedown = function ( _ev ){     // canvas ドラッグ開始位置
            mouse_down = true
            sx = _ev.pageX
            sy = _ev.pageY
            return false // イベントを伝搬しない
        }

        cvs.onmouseout =
            cvs.onmouseup = function ( _ev ){       // canvas ドラッグ終了位置
                if ( mouse_down == false ) return
                mouse_down = false
                draw_canvas( ix += (sx-_ev.pageX)/v, iy += (sy-_ev.pageY)/v )
                return false // イベントを伝搬しない
            }

        cvs.onmousemove = function ( _ev ){     // canvas ドラッグ中
            if ( mouse_down == false ) return
            draw_canvas( ix + (sx-_ev.pageX)/v, iy + (sy-_ev.pageY)/v )
            return false // イベントを伝搬しない
        }
        cvs.onmousewheel = function ( _ev ){    // canvas ホイールで拡大縮小
            let scl = parseInt( parseInt( document.getElementById( 'scal' ).value ) + _ev.wheelDelta * 0.05 )
            if ( scl < 10  ) scl = 10
            if ( scl > 400 ) scl = 400
            document.getElementById( 'scal' ).value = scl
            scaling( scl )
            return false // イベントを伝搬しない
        }

        $('#set_img').change(function (e) {

            var result=e.target.files[0];

            var reader=new FileReader();
            reader.readAsDataURL(result);
            reader.addEventListener('load',function () {
                load_img(reader.result);
            })
            document.getElementById("icon-mask").style.display="block"
            document.getElementById("icon-modal").style.display="block"

        });
        function close_icon_modal() {
            document.getElementById("icon-mask").style.display="none"
            document.getElementById("icon-modal").style.display="none"

        }


    </script>

</div>

<div class="back-mask" id="back-mask"
onclick="close_back_modal()">

</div>
<div class="back-modal" id="back-modal">

        <div>
            <div style="display: flex">拡大縮小</div>
            <input id='scal2' type='range' value='' min='10' max='400' oninput="scaling2(value)" style='width: 300px;'><br>

        </div>
        <canvas id='cvs2' width='450' height='300'></canvas><br>
        <button type="button" onclick='crop_img2();close_back_modal()'>決定</button><br>
        <canvas class="" id='out2' width='450' height='140'></canvas>


        <script type="text/javascript">
            const cvs2 = document.getElementById( 'cvs2' )
            const cw2 = cvs2.width
            const ch2 = cvs2.height
            const out2 = document.getElementById( 'out2' )
            const oh2 = out2.height
            const ow2 = out2.width

            let ix2 = 0    // 中心座標
            let iy2 = 0
            let v2 = 1.0   // 拡大縮小率



            const img2  = new Image()
            img2.onload = function( _ev ){   // 画像が読み込まれた
                ix2 = img2.width  / 2
                iy2 = img2.height / 2
                let scl2 = parseInt( cw2 / img2.width * 100 )
                document.getElementById( 'scal2' ).value = scl2
                scaling2( scl2 )
            }
            function load_img2( _url ){  // 画像の読み込み
                img2.src = ( _url ? _url : '' )
            }
            load_img2()
            function scaling2( _v2 ) {        // スライダーが変った
                v2 = parseInt( _v2 ) * 0.01
                draw_canvas2( ix2, iy2 )       // 画像更新
            }

            function draw_canvas2( _x, _y ){     // 画像更新
                const ctx2 = cvs2.getContext( '2d' )
                ctx2.fillStyle = 'rgb(200, 200, 200)'
                ctx2.fillRect( 0, 0, cw2, ch2 )    // 背景を塗る
                ctx2.drawImage( img2,
                    0, 0, img2.width, img2.height,
                    (cw2/2)-_x*v2, (ch2/2)-_y*v2, img2.width*v2, img2.height*v2,
                )
                ctx2.strokeStyle = 'rgba(0, 0, 0, 0.8)'
                ctx2.strokeRect( (cw2-ow2)/2, (ch2-oh2)/2, ow2, oh2 ) // 赤い枠
            }
            function crop_img2(e){                // 画像切り取り
                const ctx2 = out2.getContext( '2d' )
                ctx2.fillStyle = 'rgb(200, 200, 200)'
                ctx2.fillRect( 0, 0, ow2, oh2 )    // 背景を塗る
                ctx2.drawImage( img2,
                    0, 0, img2.width, img2.height,
                    (ow2/2)-ix2*v2, (oh2/2)-iy2*v2, img2.width*v2, img2.height*v2,
                )
                //ctx2.globalAlpha("0.4")
                if (out2.msToBlob) { //for IE
                    var blob2 = out2.msToBlob();
                    window.navigator.msSaveBlob(blob2, 'download.png');
                } else {
                    var image_data2 = out2.toDataURL("image/png");
                    $('#back').val(image_data2);

                }


            }

            function submit2(){
                var form2=document.forms.form2;
                form2.submit();
            }





            let mouse_down2 = false      // canvas ドラッグ中フラグ
            let sx2 = 0                  // canvas ドラッグ開始位置
            let sy2 = 0
            let xm2 = 0                  // canvas ドラッグ開始位置
            let ym2 = 0
            cvs2.ontouchstart =function ( _ev ){     // canvas ドラッグ開始位置
                mouse_down2 = true
                sx2 = _ev.changedTouches[0].pageX
                sy2 = _ev.changedTouches[0].pageY
                return false // イベントを伝搬しない
            }
            cvs2.ontouchmove =function ( _ev ){     // canvas ドラッグ中
                if ( mouse_down2 == false ) return
                xm2 = _ev.changedTouches[0].pageX
                ym2 = _ev.changedTouches[0].pageY
                draw_canvas2( ix2 + (sx2-xm2)/v2, iy2 + (sy2-ym2)/v2 )
                return false // イベントを伝搬しない
            }
            cvs2.onmousedown = function ( _ev ){     // canvas ドラッグ開始位置
                mouse_down2 = true
                sx2 = _ev.pageX
                sy2 = _ev.pageY
                return false // イベントを伝搬しない
            }
            cvs2.onmouseout =
                cvs2.onmouseup = function ( _ev ){       // canvas ドラッグ終了位置
                    if ( mouse_down2 == false ) return
                    mouse_down2 = false
                    draw_canvas2( ix2 += (sx2-_ev.pageX)/v2, iy2 += (sy2-_ev.pageY)/v2 )
                    return false // イベントを伝搬しない
                }

            cvs2.onmousemove = function ( _ev ){     // canvas ドラッグ中
                if ( mouse_down2 == false ) return
                draw_canvas2( ix2 + (sx2-_ev.pageX)/v2, iy2 + (sy2-_ev.pageY)/v2 )
                return false // イベントを伝搬しない
            }
            cvs2.onmousewheel = function ( _ev ){    // canvas ホイールで拡大縮小
                let scl2 = parseInt( parseInt( document.getElementById( 'scal2' ).value ) + _ev.wheelDelta * 0.05 )
                if ( scl2 < 10  ) scl2 = 10
                if ( scl2 > 400 ) scl2 = 400
                document.getElementById( 'scal2' ).value = scl2
                scaling2( scl2 )
                return false // イベントを伝搬しない
            }

            $('#set_back').change(function (e) {

                var result=e.target.files[0];

                var reader2=new FileReader();
                reader2.readAsDataURL(result);
                reader2.addEventListener('load',function () {
                    load_img2(reader2.result);
                })
                document.getElementById("back-mask").style.display="block"
                document.getElementById("back-modal").style.display="block"
            });
            function close_back_modal() {
                document.getElementById("back-mask").style.display="none"
                document.getElementById("back-modal").style.display="none"
            }


        </script>
</div>


<script src="../js/follow_toggle_ajax.js"></script>

</body>
</html>
