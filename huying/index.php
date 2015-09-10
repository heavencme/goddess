<?php include_once'header.php'; ?>
<?php
include_once('config.php');
include_once('zsdb.php');
$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
if($db->ready)
{
          $booknames=array();
          $bookpics=array();
          $sellers=array();
          $db->fetchbook(&$booknames,&$bookpics,&$sellers);
          //echo "bookname1:".$booknames[0]."bookpic1:".$bookpics[0];
          //echo "bookname2:".$booknames[1]."bookpic2:".$bookpics[1];
          $db->db_discon();
}
?>

	<div id="primary" class="site-content">
		<div id="content" role="main">		
			<div class="column">
				<?php 	for($i=0;$i<19;$i++): ?>
				<article id="book<?=$i;?>" class="post type-post status-publish format-standard hentry" >
					<header class="entry-header">
						<a href="" title="<?=$booknames[$i];?>" rel="bookmark" >
						<img width="624" height="350" src="<?=$bookpics[$i];?>" class="attachment-post-thumbnail wp-post-image" alt="<?=$booknames[$i];?>"></a>
						<h1 class="entry-title">
							<a href="" title="Permalink to <?=$booknames[$i];?>" rel="bookmark"><?=$booknames[$i];?></a>
						</h1>
						<div class="comments-link">
							<a href="" title="<?=$booknames[$i];?>"><span class="leave-reply">我要这本书</span></a>
						</div><!-- .comments-link -->
					</header><!-- .entry-header -->
			
						<div class="entry-content">
                                                  <?php if($sellers[$i]!=null): ?>
							<p>我是卖家，我的微博@<?=$sellers[$i];?></p>
                                                  <?php endif;?>      
						</div><!-- .entry-content -->
					
					<footer class="entry-meta">
					</footer><!-- .entry-meta -->
				</article><!-- #post -->
				<?php endfor; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php include_once'footer.php'; ?>