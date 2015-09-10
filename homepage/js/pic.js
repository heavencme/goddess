$(document).ready(function(){
    var clicked=0;
    $(".sec-content").hover(function(){
        if (clicked==0)
            $("#pageheader").css({ "visibility":"visible" });    
    },
    function(){
        if (clicked==0)
            $("#pageheader").css({ "visibility":"hidden" });
    });
    /**
    $("#pageheader").hover(function(e){
        $(this).before("<p id=\" pictip \">喜欢?点我!</p>");
        $("#pictip").css({"position":"fixed","z-index":"999","left":e.pageX,"right":e.pageY});
    },
    function(){
        $("#pictip").remove();
    });
    **/
    $("#pageheader").click(function(e){
        $(this).css({ "visibility":"visible" });
        clicked=1;
        $.ajax({
            type: "POST",
            url: "../cookme.php",
            data: {type: "receive"},
            success:function (data){
                liked=data['liked'];
                if (liked!='yes')
                {
                    $.ajax({
                        type: "POST",
                        url: "likeme.php",
                        data: {picnum: $("#pic").attr("picnum"), num:$("#pic").attr("num")},
                        success:function (){
                            alert("已喜欢！");
                            console.log($("#pic").attr("picnum")+'--sent');
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "../cookme.php",
                        data: {type: "sent",key: "liked",val:"yes"},
                        success:function (){
                            console.log('liked');
                        }
                    });    
                }
            }
        });
         
    });
})