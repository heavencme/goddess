/**自动跳转**/
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

/**首页图片**/
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

/**抖动**/
function mouseOnShake(targetId) {
    
    if (typeof targetId==="string")
        {
            target=document.getElementById(targetId);
            if (target.addEventListener)
                target.addEventListener("mouseover",shaking,false);
            else
                target.attachEvent("onmouseover",shaking);

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
            if (count<17)
            {
                target.style.left=3*Math.sin(count%10/10*2*Math.PI)+"px";
                sha=setTimeout(change,25);
                //document.getElementById('txt').value=count;
            }
            else
                {
                    clearTimeout(sha);
                    target.style.cssText=original_style;
                }
        }    
    }
        
    
}

/**事件注册**/
function addEvent(targetId,type,handler) {
    target=document.getElementById(targetId);
    if (target.addEventListener)
        target.addEventListener(type,handler,false);
    else
        target.attachEvent("on"+type,function(event){
            return handler.call(target,event);
        });
}


/**滚动**/
$(document).ready(function(){
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
        //return true; //last modified
       //
      }
    });
    
    count++;
    count=count%4;
  }
  timer=setInterval(scr,2500);//"src()"不被识别，scr()只调用一次，scr才正常
});


