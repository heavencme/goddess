/**Objects**/

//the Logo
function Logo(id) {    
    this.id=id;
}
Logo.prototype={
    constructor:Logo,
    setClickEventOnLogo:function(){
        //register click event on logo
        target=document.getElementById(this.id);
        addEvent(target,"click",moveEvent);
    },
    setHoverEventOnLogo:function(){
        mouseOnShake(this.id);
    }
}

//the Touch
function Touch() {
}
Touch.prototype={
    constructor:Touch,
    setTouchEvent:function() {
        var target=document;
        // add touch start listener
        target.addEventListener("touchstart", this.touchStart, false);
        // add touch move listener
        target.addEventListener("touchmove", this.touchMove, false); 
        // add touch end listener
        target.addEventListener("touchend", this.touchEnd, false);
    },
    touchStart:function(){
        if (this.spirit || !event.changedTouches.length) 
           return;
        //"this" points to spirit target( document)
        var touch = event.changedTouches[0];
        startX = touch.pageX; //defined in the object window
        startY = touch.pageY;
        this.spirit = document.createElement("div");
        this.spirit.className = "touch-pad";
        document.body.appendChild(this.spirit);    
    },
    touchMove:function () {
        if (!this.spirit || !event.changedTouches.length) 
          return;
        var touch = event.changedTouches[0],x = touch.pageX,  y = touch.pageY;
        this.spirit.style.cssText = 'left:' + x + 'px; top:' + y + 'px;';  
        if (Math.abs(y-startY)>100) {
            document.body.removeChild(this.spirit);
            this.spirit = null;
            return true;//allow default events to happen
        }
        else if(Math.abs(x-startX)>8){
            event.preventDefault();
            return false;//prevent default events,however it sometimes doesn't work well
        }
        else{
            document.body.removeChild(this.spirit);
            this.spirit = null;
            return true;
        }
    },
    touchEnd:function(){
        if (!this.spirit) 
            return;
        document.body.removeChild(this.spirit);
        this.spirit = null;
        var touch = event.changedTouches[0],x = touch.pageX,  y = touch.pageY;
        //move left
        if( x<startX-8){//prevent mis-operation
            moveLeft();
        }
        //move right
        else if(x>startX+8){
            moveRight();
        }
    }
}

/**functions to be called**/

//register a event listener on the target
function addEvent(target,type,handler) {
    if (target.addEventListener)
        target.addEventListener(type,handler,false);
    else
        target.attachEvent("on"+type,function(event){
            return handler.call(target,event);
        });
}


//register keydown event for 'left' & 'right' key
function setKeyEvent(){
    addEvent(document,"keydown",keyBoardHandler);
}

//remove keydown event to avoid conflict
function removeKeyEvent() {
    document.removeEventListener("keydown",keyBoardHandler,false);
}

//when typing in the textarea of form, cancel the keyboard events
function setFocusAndBlurEvents(args) {
    var doc=document;
    doc.getElementsByTagName("textarea")[0].onfocus=function(){
        removeKeyEvent();
    }
    doc.getElementsByTagName("textarea")[0].onblur=function(){
        setKeyEvent();
    }
}

function keyBoardHandler(event){
    if (event.keyCode==39) {
        moveRight();
    }
    else if (event.keyCode==37) {
        moveLeft();
    }
    else
        return true;
}


function moveEvent() {
    //move right with the logo
    if ($("#left-wrapper").css("marginLeft")=="-319px") {
        moveRight();
       
    }
    //move back with the logo
    else if ($("#left-wrapper").css("marginLeft")=="-9px") {
        moveLeft(); 
    }

}

function moveLeft() {
    //move left with the logo
    if ($("#left-wrapper").css("marginLeft")=="-9px") {
        $("#left-wrapper").animate(
            {marginLeft:"-319px"},
            800
        );
        $(".logo").animate(
            {left:"-=310"},
            800
        );    
    }
    

}

function moveRight() {
    //move right with the logo
    if ($("#left-wrapper").css("marginLeft")=="-319px") {
        $("#left-wrapper").animate(
            {marginLeft:"-9px"},
            800
        );
        $(".logo").animate(
            {left:"+=310"},
            800
        );
    }
}

/**auto jumping**/
var secs =5; //countdown
var URL ;
var TIP
function Load(url,tip)
{
    URL =url;
    TIP =tip;
    for(var i=secs;i>=0;i--) 
    { 
        window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000); 
    } 
} 
function doUpdate(num,tip) 
{ 
    document.getElementById('jump').innerHTML = num+TIP;
    if(num == 0) { window.location=URL; } 
}

/**home pic hover**/
function homePicHover(args) {
    $('.view').hover(
            function () {
                $('img',$(this)).stop().animate(
                {'margin-left':'-60px'},300    
                )
            },
            function (){
                $('img',$(this)).stop().animate(
                {'margin-left':'0px'},150
                )   
            }
    );    
}

/**logo shaking**/
function mouseOnShake(targetId) {
    if (typeof targetId==="string"){    
        target=document.getElementById(targetId);
        addEvent(target,"mouseover",shaking);
    }
    var original_style=target.style.cssText;
    function shaking() {
        target.style.position="absolute";
        target.style.opacity="0.85";
        target.style.filter="alpha(opacity=85)";
        var count=0;
        change();
        function change() {
            count++;
            if (count<17){
                target.style.left=3*Math.sin(count%10/10*2*Math.PI)+"px";
                sha=setTimeout(change,25);
            }
            else{
                clearTimeout(sha);
                target.style.cssText=original_style;
            }
        }    
    }
        
    
}

/**waterfall rolling**/
function rollTheWaterfall(){
  var timer;
  var count=0;
  var dym_dl= $('.dym-dl');
  dym_dl.hover(
    function(){
      $(this).children().addClass("cur");
      $(this).attr({id:"cur"});
      $(document).scroll(function(event){
      //重新定义滚动  
      });
    },
    function(){
      $(this).children().removeClass("cur");
      $(this).attr({id:"nocur"}); 
    }
  );
  function scr(imon){
    //console.log('do');
    dym_dl.each(function(i){
      $(this).attr({num:i});//也可手动去设置个编号
      
      if (imon!="yes") {
          if($(this).is("#cur")) {
            //console.log($(this));
            return true;//相当与continue，调至下个循环
          }
       }
      
      if($(this).attr("num")==count){ 
        var dym= $(this).find("div:first");
        //console.log(count);
        //dym.css({marginTop:0});
        dym.animate(
        {marginTop:-$(this).height()},//带了副号要加"",如"-200px"；如果是变量就不能加""
        2500,
        'swing',
        function(){
          //console.log($(this).height());
          $(this).css({marginTop:0}).appendTo($(this).parent());
        } 
        );
        //return true; 
      }
    });
    
    count++;
    count=count%4;
  }
  timer=setInterval(scr,2500);//"src()"不被识别，scr()只调用一次，scr才正常
}

/**magic light hover event**/
function magicLight() {
    var isonline='waiting',btn=$("#login"),light1=$("#light1"),light2=$("#light2");

    btn.hover(
        function(tar){
            //lights on
            light1.css({color:"#ECF805"});
            light2.css({color:"#ECF805"});
            //check if it's online
            $.ajax({
                type:"GET",
                url:"isonline.php",
                data:{'myk':'da2f632dc97b861b101c58f4ac0dd8c2'},
                success:function (d) {
                    wbstatus=d['wbstatus'];
                    rrstatus=d['rrstatus'];
                    if (wbstatus==true &&rrstatus==false) {
                        isonline='wb';
                        light1.css({color:"#ECF805"});//已经登录则灯泡按钮点亮
                        light2.css({color:""});
                    }
                    else if (rrstatus==true &&wbstatus==false) {
                        isonline='rr';
                        light1.css({color:""});
                        light2.css({color:"#ECF805"});
                    }
                    else if (wbstatus==true &&rrstatus==true) {
                        isonline='both';
                        light1.css({color:"#ECF805"});
                        light2.css({color:"#ECF805"});
                    }
                    else{
                        isonline=null;
                        //light1.css({ color:''});
                        //light2.css({ color:''});
                    }
                }
            });
        },
        function () {
            if (isonline==null || isonline=='waiting') {
                light1.css({color:""});
                light2.css({color:""});
            }
        }
    );
}

//cout the words that has been typed in the textarea
function countWord(obj) {
    var tip=document.getElementById('counttip');
    var text=obj.value;
    var num=text.length;
    if (num>0) {
            tip.innerHTML=num+'字.';
            if (num>140) {
                    tip.style.color='#f00';
            }
            else{
                    tip.style.color='';
            }
    }
    else
    {
            tip.innerHTML='';
    }
}

//same as" header-navi.js", navi-hover events 
function headerNavi() {
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
}

/**make tips show how to use zisheng **/
function tipShow(picIdVal,maskIdVal) {
    this.maskIdVal=maskIdVal;//the id of <div id=""
    this.picIdVal=picIdVal;//the id of <img id=""
    this.pics=new Array();//set events queue
    this.clickOnTip=(function(pics,picIdVal,maskIdVal){
        //use closure, or "this" here means the nodeList object where "click" happens
        return function(){
            var doc=document;
            if ( pics.length==0 ) {
                doc.body.removeChild(doc.getElementById(maskIdVal));
            }
            else if( pics.length>0 ) {
                var tipPic=doc.getElementById(picIdVal);
                tipPic.setAttribute("src",pics.pop());
            }   
        }
    })(this.pics,this.picIdVal,this.maskIdVal);    
}
tipShow.prototype={
    constructor:tipShow,
    //to initiate a tip by creating a mask
    init:function(addr){
        var doc=document;
        var known=null;
        //check whether visited
        $.ajax({
            type: "POST",
            url: "cookme.php",
            data: {type: "receive"},
            async:false,
            success:function (data){
                known=data['known'];    
            }
        });
        if(known!='yes'){
            //create the mask
            var mask=doc.createElement("div");
            mask.setAttribute("id",this.maskIdVal);
            mask.style.cssText="width:100%;height:100%;background:rgba(0,0,0,0.4);z-index:9999;";
            //create img
            var img=doc.createElement("img");
            img.setAttribute("src",addr);
            img.setAttribute("id",this.picIdVal);
            img.style.cssText="max-width:80%;position: fixed;bottom: 2%;left: 9%;cursor:pointer;";
            mask.appendChild(img);
            doc.body.appendChild(mask);
            this.mask=doc.getElementById(this.maskIdVal);
            //set click event on each of events queue
            addEvent(doc.getElementById(this.picIdVal),"click",this.clickOnTip);     
        }
        
        return this;
    },
    //each step to add a different picture to the mask, var addr refers to the src
    step:function(addr){
        if (addr && this.mask) { //only when they all exist
            this.pics.push(addr);
        }
        return this;
    },
    //set steps="n" to identify total steps
    end:function(){
        //sent ajax to set cookie
        $.ajax({
            type: "POST",
            url: "cookme.php",
            data: {type: "sent",key: "known",val:"yes",exp:"longtime"},
            success:function (){
                console.log('Welcome!!!');
            }
        });
    }
}