
    <div id="social_list">
    <?php
    /**nologin->show square.php
     *use my own token to set link
     *现在用public来凑合
     *等有了高级权限可以直接调用timeline_batch 读取制定用户
     *其中nobody1是我的账号token，非常危险，可以获得推荐账户
     *吱声网测试用户{
	token：2.00ysfGhD0rVdw_5c4ee69e2b0nLAuW
	user:heavencme@163.com
	passwd:123qaz
     }
     **/
    //$nobody1= new SaeTClientV2( WB_AKEY , WB_SKEY ,'2.00xtQGlChilbDD7fe1231ab9qPb9iC');
    $nobody = new SaeTClientV2( WB_AKEY , WB_SKEY ,'2.00_8bGjBhilbDD6cc84ac3da0Wp2I3');
    //$public_data= $nobody->timeline_batch_by_id("1582641841",1,42,0,0);
    $public_data= $nobody->home_timeline( 1,60,0,0,0,0);
    $home_timeline1= array_slice($public_data['statuses'],0,14);
    $home_timeline2= array_slice($public_data['statuses'],14,14);
    $other3=array_slice($public_data['statuses'],28,14);
    //从本站注册用户中取出uid在生成$home_timeline3
    $uids=array();
    $uidstr="";
    $db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
    if($db->ready)
    {
	$uids=$db->getsomebody(10);
	$db->db_discon();
    }
    if(count($uids,0)>5)
	$uidstr=implode(",",$uids);//用","连成字符串
    if(!empty($uidstr))
    {
	    $local_weibo_data=$nobody->timeline_batch_by_id($uidstr,1,14,0,0);
	    if(!empty($local_weibo_data['statuses']))
	    {
		$home_timeline3=array_slice($local_weibo_data['statuses'],0,14);
	    }
	    else
	    {
		$home_timeline3=$other3;
	    }
	    //print_r($uidstr);
	    //$home_timeline3=$other3;
	    
    }
    else
    {
	$home_timeline3=$other3;
    }
    
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