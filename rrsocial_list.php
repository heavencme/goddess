<div id="social_list">
    <?php
    /**
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
    **/
    if(isset($rruid))
    {
	// 获得当前人人用户首页
	$weibo_data= $renrenapi->listFeed(99,1);
	//print_r($weibo_data);
	$home_timeline1= array_slice($weibo_data,0,33);
	$home_timeline2= array_slice($weibo_data,33,33);
	$home_timeline3= array_slice($weibo_data,66,33);
    }
    else
    {
	echo "<p><strong>人人网服务器未相应，请刷新重新！</strong></p>";
    }
    ?>
	
        <div id="waterfall" class="waterfall">
            <div class="dym-dl">
                <?php if( is_array( $home_timeline1 ) ): ?>
                    <?php foreach( $home_timeline1 as $item1 ): ?>
		    <?php if($item1['type']!='UPDATE_STATUS'): //次类型取出的是空,傻逼人人网?>
                    <div class="dym">
			<div class="speaker">
                            <img src="<?=$item1['sourceUser']['avatar'][0]['url'];?>" />
                        </div>
                        <div class="nickname">
                        <a href="http://www.renren.com/<?=$item1['sourceUser']['id'];?>" target="_blank">
                            <?=$item1['sourceUser']['name'];?>: 
                        </a>
                        </div>
			<div class="words">
			
			<?php if($item1['message'] != $item1['resource']['content'] ): ?>
				<?=$item1['message']; //有时两者是一样的,傻逼人人?>
			<?php endif; ?>
			<?=$item1['resource']['content'];?>
			<?php if(isset($item1['attachment'][0]['url'])): //有附件 ?> 
				<?php if(isset($item1['thumbnailUrl'])): //附件有缩略图，但是却不让外链详见我博客?>	
					<div class="words_pic" >			    
						<a href="<?=$item1['attachment'][0]['url'];?> " target="_blank">
							<img src="<?=preg_replace('/fmn.rrimg.com/','fmnp.rrimg.com',$item1['thumbnailUrl']); ?> " alt="点击打开" title="点击打开" />
						</a>
					</div>
				<?php else: //附件无缩略图，显示原链接 ?>
					<div class="buttons" style="margin-left: auto;margin-right: auto">
						<a href="<?=$item1['attachment'][0]['url'];?> " target="_blank">点击打开</a>    
					</div>
				<?php endif; ?>
			<?php endif; ?>
			</div>
                        <div class="speak_time"><?php echo $item1['time']; if($item1['lbs']['name']!=null) echo '--我在'.$item1['lbs']['name'] ?></div>
                    </div>
		    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="dym-dl">
                <?php if( is_array( $home_timeline2 ) ): ?>
                    <?php foreach( $home_timeline2 as $item2 ): ?>
		    <?php if($item2['type']!='UPDATE_STATUS'): //次类型取出的是空,傻逼人人网?>
                    <div class="dym">
			<div class="speaker">
                            <img src="<?=$item2['sourceUser']['avatar'][0]['url'];?>" />
                        </div>
                        <div class="nickname">
                        <a href="http://www.renren.com/<?=$item2['sourceUser']['id'];?>" target="_blank">
                            <?=$item2['sourceUser']['name'];?>: 
                        </a>
                        </div>
			<div class="words">
			
			<?php if($item2['message'] != $item2['resource']['content'] ): ?>
				<?=$item2['message']; //有时两者是一样的,傻逼人人?>
			<?php endif; ?>
			<?=$item2['resource']['content'];?>
			<?php if(isset($item2['attachment'][0]['url'])): //有附件 ?> 
				<?php if(isset($item2['thumbnailUrl'])): //附件有缩略图，但是却不让外链详见我博客?>	
					<div class="words_pic" >			    
						<a href="<?=$item2['attachment'][0]['url'];?> " target="_blank">
							<img src="<?=preg_replace('/fmn.rrimg.com/','fmnp.rrimg.com',$item2['thumbnailUrl']); ?> " alt="点击打开" title="点击打开" />
						</a>
					</div>
				<?php else: //附件无缩略图，显示原链接 ?>
					<div class="buttons" style="margin-left: auto;margin-right: auto">
						<a href="<?=$item2['attachment'][0]['url'];?> " target="_blank">点击打开</a>    
					</div>
				<?php endif; ?>
			<?php endif; ?>

			</div>
                        <div class="speak_time"><?php echo $item2['time']; if($item2['lbs']['name']!=null) echo '--我在'.$item2['lbs']['name'] ?></div>
                    </div>
		    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="dym-dl">
                <?php if( is_array( $home_timeline3 ) ): ?>
                    <?php foreach( $home_timeline3 as $item3 ): ?>
		    <?php if($item3['type']!='UPDATE_STATUS'): //次类型取出的是空,傻逼人人网?>
                    <div class="dym">
			<div class="speaker">
                            <img src="<?=$item3['sourceUser']['avatar'][0]['url'];?>" />
                        </div>
                        <div class="nickname">
                        <a href="http://www.renren.com/<?=$item3['sourceUser']['id'];?>" target="_blank">
                            <?=$item3['sourceUser']['name'];?>: 
                        </a>
                        </div>
			<div class="words">
			
			<?php if($item3['message'] != $item3['resource']['content'] ): ?>
				<?=$item3['message']; //有时两者是一样的,傻逼人人?>
			<?php endif; ?>
			<?=$item3['resource']['content'];?>
			<?php if(isset($item3['attachment'][0]['url'])): //有附件 ?> 
				<?php if(isset($item3['thumbnailUrl'])): //附件有缩略图，但是却不让外链详见我博客?>	
					<div class="words_pic" >
						<a href="<?=$item3['attachment'][0]['url'];?> " target="_blank">
							<img src="<?=preg_replace('/fmn.rrimg.com/','fmnp.rrimg.com',$item3['thumbnailUrl']); ?> " alt="点击打开" title="点击打开" />
						</a>
					</div>
				<?php else: //附件无缩略图，显示原链接 ?>
					<div class="buttons" style="margin-left: auto;margin-right: auto">
						<a href="<?=$item3['attachment'][0]['url'];?> " target="_blank">点击打开</a>    
					</div>
				<?php endif; ?>
			<?php endif; ?>

			</div>
                        <div class="speak_time"><?php echo $item3['time']; if($item3['lbs']['name']!=null) echo '--我在'.$item3['lbs']['name'] ?></div>
                    </div>
		    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
		
	</div>		
</div>