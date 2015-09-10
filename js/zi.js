$(document).ready(function(){
    var doc = document;
    
    var zilogo=new Logo("zilogo");
    //register logo click event
    zilogo.setClickEventOnLogo();
    
    //same as" header-navi.js", navi-hover events 
    headerNavi();
    
    //register keyboard event
    setKeyEvent();
    
    //register focus and blur events to avoid conflicts with the keyboard event
    setFocusAndBlurEvents();
    
    //set touch event for small screen device
    if(doc.body.offsetWidth/2<720){ //I have set body's width '200%'
        var bodyTouch=new Touch();
        bodyTouch.setTouchEvent();
    }
    else{
        //logo hover shaking event
        zilogo.setHoverEventOnLogo();
    }
    
    //register home pic hover event
    homePicHover();
    
    //roll the waterfall
    rollTheWaterfall();
    
    //magic light hover(ajax) event
    magicLight();
    
    //tips to show how to use zisheng
    var tip=new tipShow("tipPic","tipMask");
    tip.init("./images/tip_1.png").step("./images/tip_2.png").end(2);
});



