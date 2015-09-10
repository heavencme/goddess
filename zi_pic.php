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
?>
<head>
	<link rel="stylesheet" type="text/css" href="css/zi.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	
	<div class="zi">
		<p id="top" style="margin-top: 1px;margin-bottom: 2px">
		<?php
			if(isset($wbprofile['screen_name']))
				echo $wbprofile['screen_name'].",说啥？";
			else
				echo "忘了在首页登录了吧？";
		?>
                <span class="buttons"  style="display: inline;"><a href="index.php">发文字微博</a></span>
		</p> 
		<form action="" enctype="multipart/form-data" method="POST" name="sendform">
			<textarea name="text" style="width: 300px;height: 140px;"><?php include_once'oneword.php'; ?></textarea>
			<input type="file" name="myfile" style="font-size: 12px;width: 190px" size="5" />
			<input class="icons" type="submit" value="I" style="float: right;width:34px;height: 28px;margin-bottom:1px;" />
			<input class="icons" type="reset" value="l" style="float: right;width:34px;height: 28px;margin-bottom:1px;" />
			<?php
			if( isset($_REQUEST['text']) ) {
				//上传图片并生成外部图片地址
				$img_addr="";
				if(is_uploaded_file($_FILES['myfile']['tmp_name']))
				{
					$img_tmp=$_FILES['myfile']['tmp_name'];
					$dir=$_SERVER['DOCUMENT_ROOT']."/images/upload/".date("Ymd")."/"."u$wbuid";//存贮图片地址20130701/u123456789
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
					    $img_addr="images/upload/".date("Ymd")."/"."u$wbuid"."/".$img_name;//外部访问地址和内部不一样
					}
					
				}
				
				//发送微博
				$ret = $weibo->upload($_REQUEST['text'],$img_addr);	
				if ( isset($ret['error_code']) && $ret['error_code'] > 0 )
				{
					echo "<p id=\"bad\">发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
				}
				else
				{
					echo "<p id=\"good\">j发送成功</p>";
					$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
					if($db->ready)
					{     
					    if(isset($wbuid)&&$db->exist_uid($wbuid)==true)//用户uid已登录且数据库中有其记录
					    {
						$id=$db->wbuid2id($wbuid);
						$db->addbook($_REQUEST['text'],$id,$wbprofile['screen_name']);
					    }
					}
				}
				
			}
			?>
		</form>
	</div>

</body>
