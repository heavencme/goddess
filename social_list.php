<div id="social_list">
    <?php
    //$uids="1640571365,2093492691,1830438495,2138807752,3206249732,1653064194,2994572775,1218015025,1635764393";
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
    //echo "uids:"; print_r($uids);
    if($uids!==null&&$flag!=0)
    {
	$uidr=array();
	foreach($uids as $key=>$value)
	    if($value!=0)
		array_push($uidr,$value);//将非零值组成新数组
	$uidstr=implode(",",$uidr);//用","连成字符串
	//echo "!!!!!!!!!!uidstr:".$uidstr."!!!!!!!";
	$weibo_data=$weibo->timeline_batch_by_id($uidstr,1,42,0,0);
	//echo '$weibo_data=$weibo->timeline_batch_by_id($ustr,1,50,0,0);';
	
    }
    else
    {
	$weibo_data= $weibo->home_timeline(1,42,0,0,0,0);
	//echo'$weibo_data= $weibo->home_timeline(1,27,0,0,0,0);';
    }
    
    //print_r($weibo_data);
    
    $home_timeline1= array_slice($weibo_data['statuses'],0,14);
    $home_timeline2= array_slice($weibo_data['statuses'],14,14);
    $home_timeline3= array_slice($weibo_data['statuses'],28,14);
    ?>
	<div class="buttons" style="width:140px;position:relative;left:580px;height:32px">
	    <a href="wall.php">进微博墙，更多精彩</a>    
	</div>
        <div id="waterfall" class="waterfall">
            <div class="dym-dl">
                <?php if( is_array( $home_timeline1 ) ): ?>
                    <?php foreach( $home_timeline1 as $item1 ): ?>
                    <div class="dym">
			<div class="speaker">
                            <img src="<?=$item1['user']['profile_image_url'];?>" />
                        </div>
                        <div class="nickname">
                        <a href="http://weibo.com/u/<?=$item1['user']['id'];?>" target="_blank">
                            <?=$item1['user']['name'];?>: 
                        </a>
                        </div>
			<div class="words">
			<?=$item1['text'];?>
			<?php if(isset($item1['retweeted_status'])): ?>
			    <?php echo"<a href=\"http://weibo.com/u/".$item1['retweeted_status']['user']['id']."\" style=\"font-weight:bold\" target=\"_blank\">//".$item1['retweeted_status']['user']['name'].":</a>".$item1['retweeted_status']['text'] ;?>
			    <?php if(isset($item1['retweeted_status']['original_pic'])): ?>
				<div class="words_pic" >
				    <a href="<?=$item1['retweeted_status']['original_pic'];?>" target="_blank">
					<img src="<?=$item1['retweeted_status']['thumbnail_pic'];?>" />
				    </a>
				</div>
			    <?php endif; ?>
			<?php endif; ?>
			<?php if(isset($item1['original_pic'])): ?>
				<div class="words_pic" >
				    <a href="<?=$item1['original_pic'];?> " target="_blank">
					<img src="<?=$item1['thumbnail_pic'];?>" />
				    </a>
				</div>
			<?php endif; ?>
			</div>
                        <div class="speak_time"><?php $speaktime=explode('+',$item1['created_at']); echo $speaktime[0]; ?></div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="dym-dl">
                <?php if( is_array( $home_timeline2 ) ): ?>
                    <?php foreach( $home_timeline2 as $item2 ): ?>
                    <div class="dym">
			<div class="speaker">
                            <img src="<?=$item2['user']['profile_image_url'];?>" />
                        </div>
                        <div class="nickname">
                        <a href="http://weibo.com/u/<?=$item2['user']['id'];?>" target="_blank">
                            <?=$item2['user']['name'];?>: 
                        </a>
                        </div>
			<div class="words">
			<?=$item2['text'];?>
			<?php if(isset($item2['retweeted_status'])): ?>
			    <?php echo"<a href=\"http://weibo.com/u/".$item2['retweeted_status']['user']['id']."\" style=\"font-weight:bold\" target=\"_blank\">//".$item2['retweeted_status']['user']['name'].":</a>".$item2['retweeted_status']['text'] ;?>
			    <?php if(isset($item2['retweeted_status']['original_pic'])): ?>
				<div class="words_pic" >
				    <a href="<?=$item2['retweeted_status']['original_pic'];?>" target="_blank">
					<img src="<?=$item2['retweeted_status']['thumbnail_pic'];?>" />
				    </a>
				</div>
			    <?php endif; ?>
			<?php endif; ?>
			<?php if(isset($item2['original_pic'])): ?>
				<div class="words_pic" >
				    <a href="<?=$item2['original_pic'];?> " target="_blank">
					<img src="<?=$item2['thumbnail_pic'];?>" />
				    </a>
				</div>
			<?php endif; ?>
			</div>
                        <div class="speak_time"><?php $speaktime=explode('+',$item2['created_at']); echo $speaktime[0]; ?></div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="dym-dl">
                <?php if( is_array( $home_timeline3 ) ): ?>
                    <?php foreach( $home_timeline3 as $item3 ): ?>
                    <div class="dym">
			<div class="speaker">
                            <img src="<?=$item3['user']['profile_image_url'];?>" />
                        </div>
                        <div class="nickname">
                        <a href="http://weibo.com/u/<?=$item3['user']['id'];?>" target="_blank">
                            <?=$item3['user']['name'];?>: 
                        </a>
                        </div>
			<div class="words">
			<?=$item3['text'];?>
			<?php if(isset($item3['retweeted_status'])): ?>
			    <?php echo"<a href=\"http://weibo.com/u/".$item3['retweeted_status']['user']['id']."\" style=\"font-weight:bold\" target=\"_blank\">//".$item3['retweeted_status']['user']['name'].":</a>".$item3['retweeted_status']['text'] ;?>
			    <?php if(isset($item3['retweeted_status']['original_pic'])): ?>
				<div class="words_pic" >
				    <a href="<?=$item3['retweeted_status']['original_pic'];?>" target="_blank">
					<img src="<?=$item3['retweeted_status']['thumbnail_pic'];?>" />
				    </a>
				</div>
			    <?php endif; ?>
			<?php endif; ?>
			<?php if(isset($item3['original_pic'])): ?>
				<div class="words_pic" >
				    <a href="<?=$item3['original_pic'];?> " target="_blank">
					<img src="<?=$item3['thumbnail_pic'];?>" />
				    </a>
				</div>
			<?php endif; ?>
			</div>
                        <div class="speak_time"><?php $speaktime=explode('+',$item3['created_at']); echo $speaktime[0]; ?></div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
		
	</div>
	<div class="buttons" style="width:140px;position:relative;left:2px;height:32px">
	    <a href="wall.php">进微博墙，更多精彩</a>    
	</div>		
</div>