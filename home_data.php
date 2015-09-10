<?php

    session_start();
    if(isset($_SESSION['token']['access_token']) || isset($_SESSION['rrtoken']['access_token']))
    {
	include_once('config.php');
	include_once('zsdb.php');
	
	//weibo_functions
	if(isset($_SESSION['token']['access_token']))
	{
	    include_once( 'weibo/config.php' );
	    include_once( 'weibo/weibofun.php' );
	    $weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
	    $uid_json = $weibo->get_uid();
	    $wbuid = $uid_json['uid']; //当前登录用户的uid
	    $wbprofile=$weibo->show_user_by_id($wbuid);
	    /**喜欢的微博数据**/
	    $uids=array();//存储取出ulike表中各uid
	    $weibo_data=array();//微博数据
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
	    //因为ulike中各值默认未0,若被管理员认为删除后全为0
	    $flag=0;
	    if(isset($uids))
		foreach($uids as $key=>$value) //当取出null时不能进行for否则warning
		    $flag=$flag||$value;
	    if($uids!==null&&$flag!=0)
	    {
		$uidr=array();
		foreach($uids as $key=>$value)
		    if($value!=0)
			array_push($uidr,$value);//将非零值组成新数组
		$uidstr=implode(",",$uidr);//用","连成字符串
		$weibo_data=$weibo->timeline_batch_by_id($uidstr,1,66,0,0);
		
	    }
	    else
	    {
		$weibo_data= $weibo->home_timeline(1,66,0,0,0,0);
	    }
	    $weibo_data=$weibo_data['statuses'];
	    
	}
	
	
	//renren_functions
	if(isset($_SESSION['rrtoken']))
	{
	    //renrenlogin
	    include_once ('renren/config.php');
	    include_once ('renren/renclient.php');
	    include_once ('renren/renfun.php');
	    $rraccess_token=$_SESSION['rrtoken']['access_token'];
	    // 获得接口
	    $renrenapi=new renfun($_SESSION['rrtoken']);
	    // 获得当前登录用户
	    $renren=$renrenapi->info();
	    $rruid=$renren['id'];
	    $rrprofile=$renrenapi->getUser($rruid);
	    /**人人数据**/
	    if(isset($rruid))
	    {
		// 获得当前人人用户首页
		$renren_data= $renrenapi->listFeed(88,1);
	    }
	}
	$data=array();
	if( is_array( $weibo_data ) )
	{
	    foreach( $weibo_data as $item1 )
	    {
		$per=array();
		$per['user_name']=$item1['user']['name'];
		$per['user_url']='http://weibo.com/u/'.$item1['user']['id'];
		$per['user_image']=$item1['user']['profile_image_url'];
		$per['words_text']=$item1['text'];
		$per['words_pic_thumb']=$item1['thumbnail_pic'];
		$per['words_pic_original']=$item1['retweeted_status']['original_pic'];
		$speaktime=explode('+',$item1['created_at']);
		$per['speak_time']=$speaktime[0];
		if(isset($item1['retweeted_status']))
		{
		    $per['retweet']['user_name']=$item1['retweeted_status']['user']['name'];
		    $per['retweet']['user_url']='http://weibo.com/u/'.$item1['retweeted_status']['user']['id'];
		    $per['retweet']['user_image']=$item1['retweeted_status']['user']['profile_image_url'];
		    $per['retweet']['words_text']=$item1['retweeted_status']['text'];
		    $per['retweet']['words_pic_thumb']=$item1['retweeted_status']['thumbnail_pic'];
		    $per['retweet']['words_pic_original']=$item1['retweeted_status']['original_pic'];		 
		}
		array_push($data,$per);
	    }    
	}
	
	if( is_array( $renren_data ) )
	{
	    foreach( $renren_data as $item1 )
	    {
		
		if($item1['type']!='UPDATE_STATUS')
		{
		    $per=array();
		    $per['user_name']=$item1['sourceUser']['name'];
		    $per['user_url']='http://www.renren.com/'.$item1['sourceUser']['id'];
		    $per['user_image']=$item1['sourceUser']['avatar'][0]['url'];
		    if($item1['message'] != $item1['resource']['content'] )
			$per['words_text']=$item1['message'];
		    $per['words_pic_thumb']=preg_replace('/fmn.rrimg.com/','fmnp.rrimg.com',$item1['thumbnailUrl']);
		    $per['words_pic_original']=$item1['attachment'][0]['url'];
		    $per['speak_time']=$item1['time'];
		    $per['location']=$item1['lbs']['name'];
		    if(isset($item1['resource']['content']))
		    {
			$per['retweet']['words_text']=$item1['resource']['content'];
		    }
		    
		    array_push($data,$per);    
		}
		
	    }    
	}
	shuffle($data);//将数组随机打乱排序，同时会删除非索引键名
	//floor()向下取整函数
	$num=count($data);
	$data_divided=array();
	$data_divided['total']=$num;
	$data_divided['weibo0']=array_slice($data,0,floor($num/4));
	$data_divided['weibo1']=array_slice($data,floor($num/4),floor($num/4));
	$data_divided['renren0']=array_slice($data,floor($num/2),floor($num/4));
	$data_divided['renren1']=array_slice($data,floor($num/2)+floor($num/4),floor($num/4));
	$data_divided=json_encode($data_divided);
	header('Content-Type: application/json');
	print($data_divided);
	
	//$data_divided=json_decode($data_divided);
	//print_r($data_divided);
    }//endof if(isset()&&isset())
    else
    {
	header('Content-Type: application/json');
	print(array('error'=>'Not login.'));
    }

?>