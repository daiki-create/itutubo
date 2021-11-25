
$(function () {
    $('button#follow').on('click',function () {

        $.ajax({
            type:"POST",
            url:"../action/createFollowing.php",
            datatype:"json",
            data:{
                "session":$('input#session').val(),
                "follower":$('input#user_id').val()
            },
            done:function(){
                console.log("followしました")

            },
            fail:function () {
                console.log("接続に失敗しました")
            }
        })
        $("button#follow").toggleClass('hidden');
        $("button#dis").toggleClass('hidden');


    });

    $('button#dis').on('click',function () {

        $.ajax({
            type:"POST",
            url:"../action/dis_follow.php",
            datatype:"json",
            data:{
                "session":$('input#session').val(),
                "follower":$('input#user_id').val()

            },
            done:function(){
                console.log("dis-followしました")

            },
            fail:function () {
                console.log("接続に失敗しました")
            }
        })
        $("button#dis").toggleClass('hidden');
        $("button#follow").toggleClass('hidden');


    });
})
