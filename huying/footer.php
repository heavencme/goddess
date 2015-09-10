	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<script type="text/javascript" src="http://widget.renren.com/js/rrshare.js"></script>
			<a name="xn_share" onclick="shareClick()" type="button_large" href="javascript:;"></a>
			<script type="text/javascript">
				function shareClick() {
					var rrShareParam = {
						resourceUrl : '',	//分享的资源Url
						srcUrl : '',	//分享的资源来源Url,默认为header中的Referer,如果分享失败可以调整此值为resourceUrl试试
						pic : '',		//分享的主题图片Url
						title : '',		//分享的标题
						description : ''	//分享的详细描述
					};
					rrShareOnclick(rrShareParam);
				}
			</script>
		</div><!-- .site-info -->
		<div  class="searchform_footercover">
			<form role="search" method="get" id="searchform" action="search.php">
				<div>
					<label class="screen-reader-text" for="s">搜索：</label>
					<input type="text" value="" name="s" id="s">
					<input type="submit" id="searchsubmit" value="搜索">
				</div>
			</form>
		</div> 
	</footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript" src="js/navigation.js"></script>
</body>
</html>