KISSY.use("node,overlay,button,ajax", function (S, Node, O, B, IO) {
    var $kissy=S.all;
    DOM=S.DOM;
    var loginbutton=$kissy("#login");
    var light=$kissy("#light");
    var login = new O.Dialog({
        //width:400，//指定宽度
        height:250,//指定高度
        headerContent:'绑定社交媒体',
        bodyContent:'<iframe scrolling="no" height="240" width="320" frameborder="0" name="popupIframe" src="login.php"></iframe>',
        mask:{
            effect:'fade',
            duration:.3,
            easing:'backOut'
        },
        align:{
            points:['cc', 'cc']
        },
        effect:{
            duration:.3,
            easing:'backOut',
            target:loginbutton,
            
        }
        
    });
    
    loginbutton.on("mouseenter mouseleave",function(){
        //console.log('hover'); //在mouseenter和mouseleave都触发则等同于hover效果
        DOM.toggleClass("#light","lighthover");    
    });
    loginbutton.on("mouseenter",function(){
        IO({
            type:"GET",
            url:"isonline.php",
            data:{'myk':'da2f632dc97b861b101c58f4ac0dd8c2'},
            
            success:function (d) {
                wbstatus=d['wbstatus'];
                rrstatus=d['rrstatus'];
                if (wbstatus==true) {
                    //console.log('wbisonline');
                    DOM.css('#light', { color:'#ECF805'});//已经登录则灯泡按钮点亮
                }
                else if (rrstatus==true) {
                    //console.log('rrisonline');
                    DOM.css('#light', { color:'#ECF805'});//已经登录则灯泡按钮点亮
                }
                else{
                    DOM.css('#light', {color:''});
                }
            }
            
        });
    });

    loginbutton.on("click", function () {
        login.show();
    });

});
