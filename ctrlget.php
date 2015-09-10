<!DOCTYPE html>
<html lang="zh">
    <head>
	<link rel="shortcut icon" href="/Favicon.ico" mce_href="../Favicon.ico" type="image/x-icon">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta chaset="uft-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    </head>
    <body>
<?php
    session_start();
    include_once( 'weibo/config.php' );
    include_once( 'weibo/weibofun.php' );
    include_once('config.php');
    include_once('zsdb.php');
    $weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
    $uid_json = $weibo->get_uid();
    $wbuid = $uid_json['uid']; //当前登录用户的uid
    $wbprofile=$weibo->show_user_by_id($wbuid);//当前登录uid的基本信息，参考http://open.weibo.com/wiki/2/users/show
    $db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
    $data=array();//存"pic0","pic0name","pic0dscr"...
    $val=array();//存"pic0","pic0name","pic0dscr"等对应的值
    
    for($num=0;$num<4;$num++)
    {
        
        $img_addr="images/noname.gif";
        if(is_uploaded_file($_FILES["pic$num"]['tmp_name']))
        {
                $img_tmp=$_FILES["pic$num"]['tmp_name'];
                $dir=$_SERVER['DOCUMENT_ROOT']."/images/homeupload/".date("Ymd")."/"."u$wbuid";//存贮图片地址20130701/u123456789
                if(!is_dir($dir))//目录是否存在
                    mkdir($dir,0777,true);
                $org_name=$_FILES["pic$num"]['name'];
                
                //解决不同浏览器对文件类型识别问题，用正则匹配
                $pregstr="/.\w{0,}$/u";//".jpg"
                $arr=preg_split($pregstr,$org_name);
                $type=preg_replace("/^$arr[0]/u","",$org_name);
                
                $img_name=time().rand(1,9).$type;//GMT时间加随机数，如果同时上传多个文件，time（）相同
                $img=$dir."/".$img_name;
                if(move_uploaded_file($img_tmp,$img))
                {
                    //图片上传成功
                    $img_addr="http://zisheng.org/images/homeupload/".date("Ymd")."/"."u$wbuid"."/".$img_name;//外部访问地址和内部不一样
                    if(isset($_POST["pic$num"."dscr"]) && isset($_POST["pic$num"."name"]) )
                    {
                        for($i=0;$i<3;$i++){
                            $onedata=array();
                            $oneval=array();
                            array_push($onedata,"pic$num");
                            array_push($oneval,$img_addr);
                            array_push($onedata,"pic$num"."dscr");
                            array_push($oneval,$_POST["pic$num"."dscr"]);
                            array_push($onedata,"pic$num"."name");
                            array_push($oneval,$_POST["pic$num"."name"]);
                        }
                        array_push($data,$onedata);
                        array_push($val,$oneval);
                    }
                    else
                        echo "isset error!!";
                }
                else
                    echo "move_uploaded_file error!!";
        echo "uploading ok for pic$num".'-->'.$_POST["pic$num"."name"].':'.$_POST["pic$num"."dscr"].'<br />';
        }
    }
    if($db->ready)
    {
        //echo "db enter!!";
        $db->ctrlset($data,$val);
        $db->db_discon();
    }
?>
        <p><a href="http://zisheng.org/ctrlpanel.php">返回面板</a></p>
        <p><a href="http://zisheng.org">返回主页</a></p>
    </body>
</html>
    