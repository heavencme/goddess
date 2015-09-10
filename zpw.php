<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>吱声--微博墙</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="吱声" />
<meta name="description" content="吱声" />
<link rel="shortcut icon" href="Favicon.ico" mce_href="Favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/headerstyle.css" />
<script src="http://a.tbcdn.cn/s/kissy/1.3.0/seed.js" data-config="{combine:true}"></script>
</head>
<body>
    <?php include_once('header-navi.php');?>
<script>
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
                target.style.top=6*Math.sin(count%10/10*2*Math.PI)+"px";
                target.style.left=6*Math.sin(count%10/10*2*Math.PI)+"px";
                sha=setTimeout(change,25);
            }
            else
                {
                    clearTimeout(sha);
                    target.style.cssText=original_style;
                }
        }    
    }
        
    
}

</script>
<div id="wrapper">
    <div id="article">
        <br/><p>只要发布微博话题#南航公益#，就会被我们收录并报道.</p>
        <div id="kkk">
            <div class="hang" style="text-align: center;position: absolute;top: 80px;left:5em;width: 30em;font-size: 29px;">7月25号开放^_^</div>
            
        </div>
        <script>mouseOnShake("kkk");</script>
        <div id="theWall" style="height: 1867px">
            
        </div>
        <div id="loadingPins" style="display: none;"><span>正在使劲加载…</span></div>
    </div>
</div>
