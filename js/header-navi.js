$(function() {
        if($(window).width()>720){
                var d=300;
                $('#navigation a').each(function(){
                    $(this).stop().animate({
                        'margin-top':'-123px'
                    },d+=150);
                });
        
                $('#navigation > li').hover(
                        function () {
                            $('a',$(this)).stop().animate({
                                'margin-top':'-80px'
                            },200);
                        },
                        function () {
                            $('a',$(this)).stop().animate({
                                'margin-top':'-123px'
                            },200);
                        }
                );
        }
        $(window).resize(function(){
                if($(window).width()>720){
                        var d=300;
                        $('#navigation a').each(function(){
                            $(this).stop().animate({
                                'margin-top':'-123px'
                            },d+=150);
                        });
                
                        $('#navigation > li').hover(
                                function () {
                                    $('a',$(this)).stop().animate({
                                        'margin-top':'-80px'
                                    },200);
                                },
                                function () {
                                    $('a',$(this)).stop().animate({
                                        'margin-top':'-123px'
                                    },200);
                                }
                        );
                }
        });
});