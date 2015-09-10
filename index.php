<?php
include_once( 'header.php' );
include_once('config.php');
include_once('zsdb.php');
$name=$wbprofile['name'];
$sex=$wbprofile['gender'];
$access_token=$_SESSION['token']['access_token'];
$rraccess_token=$_SESSION['rrtoken']['access_token'];
//print_r($rrprofile);
$rrname=$rrprofile['name'];
$university=$rrprofile['education'][0]['name'];
//echo "$university !!!!!!!!!!!!!!!!";
$highschool=$rrprofile['education'][1]['name'];
$city=$rrprofile['basicInformation']['homeTown']['city'];
$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
if($db->ready)
{
   /*记录访客:
   *1 有登录先处理
   *2 有两个帐号要整合
   *3 记录访客
   */
   /**有登录先要处理**/
   if(isset($rruid) && $db->exist_uid_rr($rruid)==false && isset($wbuid)&&$db->exist_uid($wbuid)==false)//用户weibo renren都无记录
    {
      $db->add_one('none',$wbuid,$name,$sex,$access_token,$rruid,$rrname,$university,$highschool,$rraccess_token);
    }
    elseif(isset($rruid) && $db->exist_uid_rr($rruid)==false && !isset($wbuid) ) //第一次登录renren，weibo没登
    {
      $db->add_one('renren',$wbuid,$name,$sex,$access_token,$rruid,$rrname,$university,$highschool,$rraccess_token);
      
    }
    elseif(isset($wbuid) && $db->exist_uid($wbuid)==false && !isset($rruid)) //第一次登录weibo，renren没登
    {
      $db->add_one('weibo',$wbuid,$name,$sex,$access_token,$rruid,$rrname,$university,$highschool,$rraccess_token);
      
    }
    
    
   /**有多个帐号要整合**/
   if(isset($wbuid) && $db->exist_uid($wbuid)==false && isset($rruid) && $db->exist_uid_rr($rruid)==true )//有renren无weibo，用户weibo uid不存在
    {
	  $db->update_wb($wbuid,$name,$sex,$access_token,$rruid);//将微博插入已有人人里面去
          
    }
    elseif(isset($rruid) && $db->exist_uid_rr($rruid)==false && isset($wbuid) && $db->exist_uid($wbuid)==true )//有weibo无renren，用户renren ruid不存在
    {
	    $db->update_rr($rruid,$rrname,$university,$highschool,$rraccess_token,$wbuid);//将人人插入已有微博里面去
    }
    elseif(isset($rruid) && $db->exist_uid_rr($rruid)==true && isset($wbuid)&&$db->exist_uid($wbuid)==true)//用户weibo renren都有记录
    {
	    //echo "all login all exists!!!!!!!!!!!!!!1";
	    $wb_id=$db->wbuid2id($wbuid);
	    $rr_id=$db->rruid2id($rruid);
	    if(isset($wb_id)&&isset($rr_id))
	    {
		  
		  if($wb_id < $rr_id)
		  {
			$db->update_rr($rruid,$rrname,$university,$highschool,$rraccess_token,$wbuid);//将人人插入已有微博里面去
			$db->remove_one('renren',$wbuid);//删除多余的weibo记录
		  }
		  elseif($wb_id > $rr_id)//防止==情况
		  {
			$db->update_wb($wbuid,$name,$sex,$access_token,$rruid);//将微博插入已有人人里面去
			$db->remove_one('weibo',$rruid);//删除多余的renren记录
		  }
	    }
    }
    
    /**记录访客**/
    if(isset($wbuid)&&$db->exist_uid($wbuid)==true)//用户uid已登录且数据库中有其记录
    {
          //echo getip();
	  $id=$db->wbuid2id($wbuid);
          $db->aguest($id,getip());
    }
    elseif(isset($rruid) && $db->exist_uid_rr($rruid)==true)//用户uid已登录且数据库中有其记录
    {
	  $id=$db->rruid2id($rruid);
          $db->aguest($id,getip());
      
    }
    else //匿名用户
    {
          
          $db->aguest(0,getip());
    }
    
    /*获取数据库中首页图片地址*/
    $home=$db->picget();
    
    $db->db_discon();
    //echo"godown!";
}       
/**获取用户ip
 *$_SERVER["REMOTE_ADDR"] 来取得客户端的 IP 地址
 *透过代理服务器取得客户端的真实 IP 地址，就要使用 $_SERVER["HTTP_X_FORWARDED_FOR"]
 *并不是每个代理服务器都能用 $_SERVER["HTTP_X_FORWARDED_FOR"] 来读取客户端的真实 IP，有些用此方法读取到的仍然是代理服务器的 IP
 *'HTTP_CLIENT_IP'是用户的IP,'HTTP_X_FORWARDED_FOR'是代理的IP
 *IP头消息未必能够取得到(因为不同的浏览器不同的网络设备,可能发不同的IP头消息)，所以PHP就尝试把每个IP头消息判断一下,若有,则取其中的一个
 **/
function getip()
{
          
          if(isset($_COOKIE['saeut']))
          {
                    $leak_ip=$_COOKIE['saeut'];//http header中可以看到这个saeut值显示了用户真是ip
                    $ip_array5=explode(".",$leak_ip);//只要前四个值: 218.94.136.178.1366977682238300
                    $ip_array4=array($ip_array5[0],$ip_array5[1],$ip_array5[2],$ip_array5[3]);
                    //echo implode(".",$ip_array4)."got"; 
                    $ip=implode(".",$ip_array4);
          }
          else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
                    $ip = getenv("HTTP_CLIENT_IP"); 
          else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
                    $ip = getenv("HTTP_X_FORWARDED_FOR"); 
          else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
                    $ip = getenv("REMOTE_ADDR"); 
          else 
                    $ip = "unknown"; 
          return $ip; 
}



?>


<div class="container-top">
          <div class="main">
                    <?php for($i=0;$i<4;$i++):?>
                    <div class="view">
                        <div class="view-back">
                            <span data-icon="m"><?=$home['pic'.$i.'view'];?></span>
                            <span data-icon="e"><?=$home['pic'.$i.'like'];?></span>
                            <a href="homepage/pic.php?nu=<?=$i;?>" target="_blank">&rarr;</a>
                        </div>
                        <img src="<?=$home['pic'.$i];?>" />
                    </div>
                    <?php endfor ;?>
                    
          </div>
</div><!--container-top-->
        

<?php
	    if(isset($wbuid)&&isset($rruid))
		  include_once('mxsocial_list.php');
	    elseif(isset($wbuid))
		  include_once('social_list.php');
	    elseif(isset($rruid))
		  include_once('rrsocial_list.php');
	    else
		  include_once('square.php');
                  
?>

<?php include_once('footer.php'); ?>
        
            