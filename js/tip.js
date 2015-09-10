function tip_login() {
    shiningthelogin();
    $("#tip_login").show();
    $("#tip_login").animate({"opacity":"1"},{duration:800});
    $("#known").click(function(){
        $("#big_wrapper").children().unwrap();
        $("#thelogin").removeClass('bordershining');
        $.ajax({
            type: "POST",
            url: "cookme.php",
            data: {type: "sent",key: "known",val:"yes",exp:"longtime"},
            success:function (){
                console.log('sent');
            }
        });
        $(this).animate({"opacity":"0"},{duration:800});
        $(this).queue(function(){
            $(this).remove();
            $(this).dequeue();
        });
        $("#big_wrapper").css({"opacity":"1"});
    });
    $("#tip_login").click(function(){
        $("#thelogin").removeClass('bordershining');
        $(this).animate({"opacity":"0"},{duration:800});
        $(this).queue(function(){
            $(this).remove();
            $(this).dequeue();
        });
        $("#big_wrapper").css({"opacity":"1"});
    });
    
}

function shiningthelogo(){
    console.log('thelogo');
    if ($("#thelogo").hasClass('bordershining'))
    {
        $("#thelogo").removeClass('bordershining');
    }
    else
    {
        $("#thelogo").addClass('bordershining');
    }
    //$(targetID).toggleClass("bordershining");
    if ($("#thelogo").css('left')==undefined)
        clearTimeout("thelogo"); 
    else
    {
        thelogo=setTimeout(shiningthelogo,500);//jquery中不函数名不加引号与括号
    }
}

function shiningthelogin(){
    $("#thelogin").addClass('bordershining');
}

jQuery.noConflict();
jQuery(function($){
    var known='no';
    $.ajax({
        type: "POST",
        url: "cookme.php",
        data: {type: "receive"},
        success:function (data){
            known=data['known'];
            if (known=='yes')
            {
                $.ajax({
                    type: "POST",
                    url: "cookme.php",
                    data: {type: "sent",key: "known",val:"yes",exp:"longtime"},
                    success:function (){
                        console.log('sent');
                    }
                });    
            }
            else
            {
                $(".logo").children().first().siblings().wrapAll("<div id=\"thelogo\" style=\"width:110px;height:110px\"></div>");
                $(".logo").children().first().wrap("<div id=\"thelogin\" style=\"width:90px\"></div>");
                $("body").children().not($(".footer")).wrapAll("<div id=\"big_wrapper\"></div>");
                $("#big_wrapper").css({"opacity":"0.35","background":"#000"});
                //login_tip
                $("#big_wrapper").before("<p id=\"tip_login\">点击一下可以登录；鼠标<br/>放上去再移开，灯亮着<br/>说明你就在线<span class=\"buttons\" id=\"known\"><a>我知道啦，别再提示</a></span></p>");
                $("#tip_login").css({
                    "background": "transparent url(../images/tip.png) no-repeat top",
                    "display":"none",//
                    "opacity":"0",//
                    "position":"fixed",
                    "left":"200px",
                    "bottom":"90px",
                    "width":"360px",
                    "height":"142px",
                    "z-index":"9999",
                    "padding-top":"91px",
                    "font-size":"17px",
                    "font-weight": "bolder",
                    "text-align":"center",
                    "border-radius":"10px",
                    "-moz-border-radius":"10px",
                    "-webkit-border-radius": "10px",
                    "-khtml-border-radius": "10px"
                    
                });
                //zi_logo_tip
                $("#big_wrapper").before("<p id=\"tip_logo\">点击logo可以就发送微博啰!<br/><span class=\"buttons\"><a>明白，下一步</a></span></p>");
                $("#zilogo").css({"opacity":"1"});
                $("#tip_logo").css({
                    "opacity":"1",
                    "position":"fixed",
                    "left":"200px",
                    "bottom":"0px",
                    "width":"360px",
                    "height":"142px",
                    "background": "#fff url(../images/tip.png) no-repeat top",
                    "z-index":"9999",
                    "padding-top":"128px",
                    "font-size":"17px",
                    "font-weight": "bolder",
                    "text-align":"center",
                    "border-radius":"10px",
                    "-moz-border-radius":"10px",
                    "-webkit-border-radius": "10px",
                    "-khtml-border-radius": "10px"
                });
                shiningthelogo();
                //entrance of action
                $("#tip_logo").click(function(){
                    $(this).animate({"opacity":"0"},{duration:1000});
                    $(this).queue(function(){
                        $(this).remove();
                        $(this).dequeue();
                    });
                    clearTimeout(thelogo);
                    $("#thelogo").removeClass('bordershining');
                    tip_login();
                });
            }
        }
    });
});