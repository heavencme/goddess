
$(document).ready(function(){
    var t=300;
    $(".search").stop().animate(
        {'margin-left':-($(".search").width()-10)},
        t+=150                            
    );
    $(".search").hover(
        function(){
            $(this).stop().animate({'margin-left':0},200);
        },
        function(){
            $(this).stop().animate({'margin-left':-($(".search").width()-10)},200);
        }               
    );
    
});