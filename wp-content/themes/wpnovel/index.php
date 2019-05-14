<?php get_header();?>
	<div class="screen_left">
	<h3>推荐小说</h3>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>	
	
		<div class="index_post" id="post-<?php the_ID(); ?>">
		<ul>
			<li class="index_cate">[<?php the_category(', ') ?>]</li>
			<li class="index_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			<li class="index_edit"><?php the_author(); ?></li>
			<li class="index_time"><?php the_time('m-d') ?></li>
			<li class="index_views">(<?php echo yundanran_getPostViews(get_the_ID()); ?>)</li>
		</ul>
		</div>
		<?php endwhile; ?>			
		<?php else : ?>
			<p>抱歉，没有你找的内容！</p>
	<?php endif; ?>			
	</div>
	
<?php get_sidebar();?>
<?php get_footer();?>