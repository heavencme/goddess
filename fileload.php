<?php
session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );
$oauth = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $oauth->getAuthorizeURL( WB_CALLBACK_URL );//微博授权登录地址callback
//weibo_functions
$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_json = $weibo->get_uid();
$wbuid = $uid_json['uid']; //当前登录用户的uid

    //$_FILES['multifile']['']
    print_r($_FILES);
    
    
    if(is_uploaded_file($_FILES['myfile']['tmp_name']))
    {
        $img_tmp=$_FILES['myfile']['tmp_name'];
        echo $dir=$_SERVER['DOCUMENT_ROOT']."/images/upload/".date("Ymd")."/"."u$wbuid";//存贮图片地址20130701/u123456789
        if(!is_dir($dir))//目录是否存在
            mkdir($dir,0777,true);
        $org_name=$_FILES['myfile']['name'];
        //$img_name=time().$_FILES['myfile']['name'];
        //解决不同浏览器对文件类型识别问题，用正则匹配
        $pregstr="/.\w{0,}$/u";//".jpg"
        $arr=preg_split($pregstr,$org_name);
        $type=preg_replace("/^$arr[0]/u","",$org_name);
        
        $img_name=time().$type;
        $img=$dir."/".$img_name;
        if(move_uploaded_file($img_tmp,$img))
           {
            $img_addr="http://zisheng.org/images/upload/".date("Ymd")."/"."u$wbuid"."/".$img_name;//外部访问地址和内部不一样
            echo "<br/><a href=\"$img_addr\">$img_name</a>";
           }
        
    }
?>
<img src="<?=$img;?>" />