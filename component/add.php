

<?php

echo $error;

echo $message;
?>
<body>
<div class="add-mask" id="add-mask">

</div>
<div class="add-modal" id="add-modal">
    <div style="display: flex">
        <h3>新しい投稿</h3>
    </div>

    <script>
        var flag1=0
        var flag2=0
        var flag3=0
        var flag4=0
        var flag5=0

        var count_star=0
        function toggle_white1() {
            flag1=1
            count_star++
            $('#star').val(count_star);
            $("#white1").toggleClass("hidden");
            $("#black1").toggleClass("hidden");
        }
        function toggle_black1() {
            if(flag2==1){
                return
            }
            flag1=0
            count_star--
            $('#star').val(count_star);
            $("#white1").toggleClass("hidden");
            $("#black1").toggleClass("hidden");
        }

        function toggle_white2() {
            if (flag1==0){
                return
            }
            flag2=1
            count_star++
            $('#star').val(count_star);
            $("#white2").toggleClass("hidden");
            $("#black2").toggleClass("hidden");
        }
        function toggle_black2() {
            if(flag3==1){
                return
            }
            flag2=0
            count_star--
            $('#star').val(count_star);
            $("#white2").toggleClass("hidden");
            $("#black2").toggleClass("hidden");
        }

        function toggle_white3() {
            if (flag2==0){
                return
            }
            flag3=1
            count_star++
            $('#star').val(count_star);
            $("#white3").toggleClass("hidden");
            $("#black3").toggleClass("hidden");
        }
        function toggle_black3() {
            if(flag4==1){
                return
            }
            flag3=0
            count_star--
            $('#star').val(count_star);
            $("#white3").toggleClass("hidden");
            $("#black3").toggleClass("hidden");
        }

        function toggle_white4() {
            if (flag3==0){
                return
            }
            flag4=1
            count_star++
            $('#star').val(count_star);
            $("#white4").toggleClass("hidden");
            $("#black4").toggleClass("hidden");
        }
        function toggle_black4() {
            if(flag5==1){
                return
            }
            flag4=0
            count_star--
            $('#star').val(count_star);
            $("#white4").toggleClass("hidden");
            $("#black4").toggleClass("hidden");
        }

        function toggle_white5() {
            if (flag4==0){
                return
            }
            flag5=1
            count_star++
            $('#star').val(count_star);
            $("#white5").toggleClass("hidden");
            $("#black5").toggleClass("hidden");
        }
        function toggle_black5() {
            flag5=0
            count_star--
            $('#star').val(count_star);
            $("#white5").toggleClass("hidden");
            $("#black5").toggleClass("hidden");
        }


    </script>


    <form  name="form" id="form" action="../action/addCont.php" method="post" enctype="multipart/form-data">
        <div id="name_validation" style="color:red;"></div>
        <input autocomplete="off" id="name" type="text" name="name" class="form-control" placeholder="商品名"><br>
        <div id="comment_validation" style="color:red;"></div>
        <textarea placeholder="商品の紹介" class="form-control" name="comment" id="comment" cols="30" rows="10"></textarea>
        <br>
        <!--[if IE ]>
            <div id="cannot_for_ie" style="color: red">InternetExplorerでは使えない場合があります</div>
        <![endif]-->

        <div id="img_validation" style="color:red;"></div>

        <label for="image">画像を選択してください</label>
        <input id="image" type="file" class="form-control-file"><br>
        <input type="hidden" name="img" id="img" value="" >
        <input type="hidden" name="star" id="star" value="" >

        <canvas id='out' width='300' height='300'></canvas>
        <br>
        <div id="white1" class="add-star" onclick="toggle_white1();"
             style="cursor: pointer;color: lightgray;
                    float: left">★</div>
        <div   id="black1" class="hidden add-star" onclick="toggle_black1()"
               style="cursor: pointer;color: #e83e8c;
                    float: left">★</div>

        <div id="white2" class="add-star" onclick="toggle_white2();"
             style="cursor: pointer;color: lightgray;
                    float: left">★</div>
        <div   id="black2" class="hidden add-star" onclick="toggle_black2()"
               style="cursor: pointer;color: #e83e8c;
                    float: left">★</div>

        <div id="white3" class="add-star" onclick="toggle_white3();"
             style="cursor: pointer;color: lightgray;
                    float: left">★</div>
        <div   id="black3" class="hidden add-star" onclick="toggle_black3()"
               style="cursor: pointer;color: #e83e8c;
                    float: left">★</div>

        <div id="white4" class="add-star" onclick="toggle_white4();"
             style="cursor: pointer;color: lightgray;
                    float: left">★</div>
        <div   id="black4" class="hidden add-star" onclick="toggle_black4()"
               style="cursor: pointer;color: #e83e8c;
                    float: left">★</div>

        <div id="white5" class="add-star" onclick="toggle_white5();"
             style="cursor: pointer;color: lightgray;
                    float: left">★</div>
        <div   id="black5" class="hidden add-star" onclick="toggle_black5()"
               style="cursor: pointer;color: #e83e8c;
                    float: left">★</div>
        <br>

        <button type="button" onclick='submit();'
                class="btn btn-primary"
                style="float: right;
                     width: 100px;height: 70px;
                    font-size: 30px">投稿</button><br>
    </form>



    <div class="add2-mask" id="add2-mask">

    </div>
    <div class="add2-modal" id="add2-modal">
        <div style="display:flex;">
            <div>拡大縮小</div>
            <input id='scal' type='range' value='' min='10' max='400' oninput="scaling(value)" style='width: 300px;'><br>
        </div>
        <br>

        <canvas id='cvs' width='400' height='400'
        style="overflow-y: auto;"></canvas><br>

        <button  type="close" onclick='crop_img();close_cvs();
                                '>決定</button><br>



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
            function load_img( _url ){  // 画像の読み込み
                img.src = ( _url ? _url : '' )
            }
            load_img()
            img.onload = function( _ev ){   // 画像が読み込まれた
                ix = img.width  / 2
                iy = img.height / 2
                let scl = parseInt( cw / img.width * 100 )
                document.getElementById( 'scal' ).value = scl
                scaling( scl )
            }
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

                ctx.strokeStyle = 'rgb(0, 0, 0)'
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
            function close_cvs() {
                document.getElementById("add2-mask").style.display="none"
                document.getElementById("add2-modal").style.display="none"
            }


            function submit(){
                var form=document.form;
                form.submit();

            }


            var down = false      // canvas ドラッグ中フラグ
            var x = 0                  // canvas ドラッグ開始位置
            var y = 0
            var xm = 0                  // canvas ドラッグ開始位置
            var ym = 0
            var xe = 0                  // canvas ドラッグ開始位置
            var ye = 0
            cvs.ontouchstart= function ( event ){     // canvas ドラッグ開始位置
                down = true
                
                x = event.changedTouches[0].pageX
                y = event.changedTouches[0].pageY

                    return// イベントを伝搬しない
                }
            cvs.ontouchmove =function ( event ){     // canvas ドラッグ中
                if ( down == false ) return
                event.preventDefault()
                xm = event.changedTouches[0].pageX
                ym = event.changedTouches[0].pageY
                draw_canvas( ix + (x-xm)/v, iy + (y-ym)/v )
                return// イベントを伝搬しない
            }
            cvs.ontouchend =function ( event ){       // canvas ドラッグ終了位置
                if ( down == false ) return
                down = false
                xe = event.changedTouches[0].pageX
                ye = event.changedTouches[0].pageY
                draw_canvas( ix + (x-xe)/v, iy + (y-ye)/v )
                return// イベントを伝搬しない
            }

            cvs.onmousedown = function ( _ev ){     // canvas ドラッグ開始位置
                down = true
                sx = _ev.pageX
                sy = _ev.pageY
                return // イベントを伝搬しない
            }

            cvs.onmouseout =
                cvs.onmouseup = function ( _ev ){       // canvas ドラッグ終了位置
                    if ( down == false ) return
                    down = false
                    draw_canvas( ix += (sx-_ev.pageX)/v, iy += (sy-_ev.pageY)/v )
                    return // イベントを伝搬しない
                }

            cvs.onmousemove = function ( _ev ){     // canvas ドラッグ中
                if ( down == false ) return
                draw_canvas( ix + (sx-_ev.pageX)/v, iy + (sy-_ev.pageY)/v )
                return // イベントを伝搬しない
            }
            cvs.onmousewheel = function ( _ev ){    // canvas ホイールで拡大縮小
                let scl = parseInt( parseInt( document.getElementById( 'scal' ).value ) + _ev.wheelDelta * 0.05 )
                if ( scl < 10  ) scl = 10
                if ( scl > 400 ) scl = 400
                document.getElementById( 'scal' ).value = scl
                scaling( scl )
                return false // イベントを伝搬しない
            }




            $('#image').change(function (e) {

                var result=e.target.files[0];

                var reader=new FileReader();
                reader.readAsDataURL(result);
                reader.addEventListener('load',function () {
                    load_img(reader.result);
                })
                document.getElementById("add2-mask").style.display="block"
                document.getElementById("add2-modal").style.display="block"
            });
        </script>
    </div>

</div>
<script>
    document.getElementById("add-mask").addEventListener("click",function () {
        document.getElementById("add-mask").style.display="none"
        document.getElementById("add-modal").style.display="none"
    })

    document.getElementById("add2-mask").addEventListener("click",function () {
        document.getElementById("add2-mask").style.display="none"
        document.getElementById("add2-modal").style.display="none"
    })

</script>

</body>