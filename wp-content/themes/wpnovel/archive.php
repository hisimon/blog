<?php get_header();?>

	<div class="topline"></div>

	<div class="main">

		<div class="breadcrumb">

		<span>你的位置：</span><?php if (function_exists('get_breadcrumbs')){ get_breadcrumbs();} ?>

		</div>

		<div class="book_info">

			<div class="book_ad">

				<!--<script type="text/javascript">

				google_ad_client = "ca-pub-9642311778195731";

				/* 小方形 */

				google_ad_slot = "6241673439";

				google_ad_width = 200;

				google_ad_height = 200;

				//

				</script>

				<script type="text/javascript"

				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">

				</script>-->

			</div>

			<div class="book_entry">

				<h2><?php single_cat_title(); ?></h2>

				<p><?php echo category_description(); ?></p>

				<!-- Baidu Button BEGIN -->

				<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">

				<span class="bds_more">分享到：</span>

				<a class="bds_tsina">新浪微博</a>

				<a class="bds_tqq">腾讯微博</a>

				<a class="bds_baidu">百度搜藏</a>

				<a class="bds_xg">鲜果</a>

				<a class="bds_qzone">QQ空间</a>

				<a class="bds_copy">复制网址</a>

				<a class="shareCount"></a>

				</div>

				<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1&amp;uid=561107" ></script>

				<script type="text/javascript" id="bdshell_js"></script>

				<script type="text/javascript">

				document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);

				</script>

				<!-- Baidu Button END -->

			</div>			

			<div class="book_pic">

			<?php if (have_posts()) : ?>

				<?php query_posts($query_string ."&showposts=1"."&meta_key=image"); while (have_posts()) : the_post();?>			

				<img src="<?php $values = get_post_custom_values("image"); echo $values[0]; ?>"/>

				<p class="download"><a rel="nofollow" href="<?php $values = get_post_custom_values("download"); echo $values[0]; ?>" target="_blank">全本TXT下载</a></p>

				<?php endwhile; wp_reset_query();?>

			<?php endif;  ?>				

			</div>			

		</div>

		

		<div class="order_list">

			<h3><?php single_cat_title(); ?></h3>			

			<ul>

			<?php if (have_posts()) : ?>

				<?php				

				query_posts($query_string ."&order=ASC");

 				while (have_posts()) : the_post(); ?>		

				<li id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

				<?php endwhile; wp_reset_query(); ?>	

					<div class="page_navi">

					<?php par_pagenavi(6); ?>

					</div>			

				<?php else : ?>

				<p>抱歉，没有你找的内容！</p>

			<?php endif; ?>					

			</ul>				

		</div>	

	</div>

<?php get_footer();?>