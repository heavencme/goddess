<?php
session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );

include_once ('renren/config.php');
include_once ('renren/renclient.php');
include_once ('renren/renfun.php');

include_once('config.php');
include_once('zsdb.php');
//微博
$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_json = $weibo->get_uid();
$wbuid = $uid_json['uid']; //当前登录用户的uid
$wbprofile=$weibo->show_user_by_id($wbuid);//当前登录uid的基本信息，参考http://open.weibo.com/wiki/2/users/show
//人人
$rennClient = new renclient ( APP_KEY, APP_SECRET );

if(isset($_SESSION['rrtoken']))
{	
	//登录信息
	$renrenapi = new renfun($_SESSION['rrtoken']);
	// 获得当前登录用户
	$renren= $renrenapi->info();
	$rruid=$renren['id'];
	$rrname=$renren['name'];
}


?>

	
	<div class="zi">
		<p id="top">
		<?php
			if(isset($wbprofile['screen_name']) &&isset($rrname) )
			{
				echo $wbprofile['screen_name']."($rrname)".",说啥？";
				/**
				$trends=$weibo->weekly_trends();//获取一周热门
				$trend=array_values($trends['trends']);//关联数组不能用数字键值进行索引，values返回所有值并把键名数组化
				$offset=rand(0,8);
				$trend=$trend[0][$offset]['name'];
				**/
				echo "<span class=\"zi_link\"><a href=\"index_zipic.php\">发图片</a></span>";
			}
			elseif(isset($wbprofile['screen_name']))
			{
				echo $wbprofile['screen_name'].",说啥？";
				/**
				$trends=$weibo->weekly_trends();//获取一周热门
				$trend=array_values($trends['trends']);//关联数组不能用数字键值进行索引，values返回所有值并把键名数组化
				$offset=rand(0,8);
				$trend=$trend[0][$offset]['name'];
				**/
				echo "<span class=\"zi_link\"><a href=\"zi_pic.php\">发图片</a></span>";
			}
			elseif(isset($rrname))
			{
				echo $rrname.",说啥？";
			}
			else
				echo "点上方“微博”和“人人”登录";
			
		?>
		
		<!--<span class="buttons"><a href="zi_pic.php">发图片</a></span>-->
		</p>
		<form action="" enctype="multipart/form-data" method="POST" name="sendform">
			<textarea name="text" onkeyup="countWord(this)" ><?php if(isset($rruid)) echo '点击发布可以更新你的人人状态^_^'; else include_once'oneword.php';?></textarea>
			<span id="counttip" ></span>
			<input class="icons" type="<?php if(isset($wbprofile['screen_name']) || isset($rrname)) echo "submit";else echo "button" ?>" value="<?php if(isset($wbuid) && isset($rruid)) echo "q";elseif(isset($rruid)) echo "H"; else echo "I"; ?>" style="float: right;width:34px;height: 28px;margin-bottom:1px;<?php if(!isset($wbuid) && isset($rruid)) echo "color:#00f;"; ?>" />
			<input class="icons" type="reset" value="l" style="float: right;width:34px;height: 28px;margin-bottom:1px;" />
			<?php
			if( isset($_REQUEST['text']) ) {
				//发送微博,可以发没问题
				$ret = $weibo->update($_REQUEST['text'],$img_addr);
				//发送人人,如果没登录就调用会报错
				if(isset($rruid))
					$ren = $renrenapi->putStatus($_REQUEST['text']);
				if ( isset($wbprofile['screen_name']) && isset($ret['error_code']) && $ret['error_code'] > 0 )
				{
					echo "<p id=\"bad\">发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
				}
				elseif(isset($rrname) && isset($ren) && !empty($ren['error']) )
				{
					echo "<p id=\"bad\">发送失败，错误：{$ren['error']['message']}:{$ren['error']['code']}</p>";
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
					    elseif(isset($rruid)&&$db->exist_uid_rr($rruid)==true)//用户uid已登录且数据库中有其记录
					    {
						$id=$db->rruid2id($rruid);
						$db->addbook($_REQUEST['text'],$id,$rrname);
					    }
					}
				}
				
			}
			?>
		</form>
	</div>
