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
<style>
    iframe{
        height: 200px;
        overflow: hidden;
        position: fixed;
        bottom: 40%;
        left: 30%;
    }
    .ks-stdmod-header{
    float: left;
    display: block;
    background: rgb(185, 158, 158);
    font-style:italic;
    color: #fff;
    }
    .ks-ext-close-x{
    float: right;
    display: block;
    background: rgb(185, 158, 158);
    font-weight: bold;
    color: #fff;
    }
    .ks-waterfall{
        margin-top: 3px;
        padding-top:3px;
    }
    .nickname{
        width: 140px;
    }
</style>
</head>
<body>
    <?php include_once('header-navi.php');?>
<div id="wrapper">
    <div id="article">
        <div class="hang" style="text-align: center;position: relative;bottom: -40px;left: 4em;font-size: 29px;">微博墙</div>
        <div id="theWall" style="height: 1867px">
            
        </div>
        <div id="loadingPins" style="display: none;"><span>正在使劲加载…</span></div>
    </div>
</div>
<script type="target" id="target">
    <div class="ks-waterfall" uid="{uid}" id="{id}">
        <div class="speaker">
            <img src="{profile_image_url}" />
        </div>
        <div class="nickname" >
            <a href="http://weibo.com/u/{uid}" target="_blank" >
            {screen_name}: 
            </a>
        </div><br />
        <div class="words">
            {text}<a href="http://weibo.com/u/{reuid}" style="font-weight:bold" target="_blank">{rename}</a>{retext}{br}<a href="{reoriginal_pic}" target="_blank"><img src="{rethumbnail_pic}" /></a>
            <div class="words_pic" >
                <a href="{original_pic}" target="_blank">
                    <img src="{thumbnail_pic}" />
                </a>
            </div>
        </div>
        <div class="speak_time">{created_at}</div>
        <br />   
        <div style="position: relative;left: 35px;">
            <button class="del"  style="width:50px; height:25px;float:left;" value="k"></button>
            <button class="like" style="width:50px; height:25px;margin-left:3px;float:left;" value="e"></button>
            <button class="repost" style="width:50px; height:25px;margin-left:3px;float:left;" value="q"></button>
        </div>
        <br />
    </div>
</script>

<script src="js/ajax.js"></script>

<div id="backToTop" >
    <a href="#top">E</a>
</div>
<div id="backToHome" >
    <a href="http://zisheng.org">C</a>
</div>
</body></html>