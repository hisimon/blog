<?php get_header();?>
	<div class="topline"></div>
	<div class="main">
		<div class="breadcrumb">
		<span>你的位置：</span><?php if (function_exists('get_breadcrumbs')){ get_breadcrumbs();} ?>
		</div>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			
			<div class="post_entry">
				<?php the_content(); ?>
			</div>
			
		</div>
		<?php endwhile; else: ?>
			<div class="post">
			<p>对不起，没有你所找的文章</p>
			</div>
		<?php endif; ?>
	
	</div>
<?php comments_template( '', true ); ?>	

<?php get_footer();?>