
<div id="ulike_list">
	<div id="ulikepics">
<?php
$uids=array();//存储取出ulike表中各uid
$weibo_data=array();//微博数据
if(isset($wbuid)){  //wbuid存在（已经登录）再连接数据库，否则会报错
	include_once('config.php');
	include_once('zsdb.php');
	
	$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
	if($db->ready)
	{
	   if($db->exist_uid($wbuid))//用户uid存在
	    {
		$id=$db->wbuid2id($wbuid);
		$uids=$db->fetchulike($id);//该用户已登录，但仍可能没有like任何其他微博，即ulike表中对应其id的可能查处未null
	    }
	    $db->db_discon();
	}
}
//因为ulike中各值默认未0,若被管理员认为删除后全为0
$flag=0;
if(isset($uids))
	foreach($uids as $key=>$value)
	    $flag=$flag||$value;
//echo "uids:"; print_r($uids);
if($uids!==null&&$flag!=0)
{
    $uidr=array();
    foreach($uids as $key=>$value)
	if($value!=0)
	    array_push($uidr,$value);//将非零值组成新数组
    for($i=0;$i<9;$i++)
    { 
	if(isset($uidr[$i]))
	{
		$ulike=$weibo->show_user_by_id($uidr[$i]);?>
	
		<div class="ulikelogo">
			<img src="<?=$ulike['profile_image_url'];?>" alt="<?=$ulike['screen_name'];?>" title="<?=$ulike['screen_name'];?>" />
		</div>
  <?php }//endof if(isset($uidr[$i]))
	else
	{ ?>
		<div class="ulikelogo">
			<img src="images/noname.gif" alt="去微博墙，选择TA是谁" title="去微博墙，选择TA是谁" />
		</div>
  <?php } //endof else
  ?>
<?php  } //endof for($i=0;$i<9;$i++)
    
}//endof if($uids!==null&&$flag!=0)
else
{
    echo "<p class=\"buttons\">在首页登录后，你在<a href=\"http://zisheng.org/wall.php\">微博墙</a>里喜欢的微博将出现在这个九宫格里，首页将帮您筛选出他们的微博！</p>";
}
?>

		
	</div><!--<div id="pics">-->
</div><!--<div id="ulike_list">-->
