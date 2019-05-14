<?php get_header();?>
	<div class="topline"></div>
	<div class="main">
		<div class="breadcrumb">
		<span>你的位置：</span><?php if (function_exists('get_breadcrumbs')){ get_breadcrumbs();} ?>
		</div>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?> (<?php yundanran_setPostViews(get_the_ID()); echo yundanran_getPostViews(get_the_ID()); ?>)</h2>
			<div class="post_nav">
				<?php
					$categories = get_the_category();
					$categoryIDS = array();
					foreach ($categories as $category) {
						array_push($categoryIDS, $category->term_id);
					}
					$categoryIDS = implode(",", $categoryIDS);
				?>
				<div class="previous">上一章：<?php if (get_previous_post($categoryIDS)) { previous_post_link('%link','%title',true);} else { echo '这是第一章';} ?></div>
				<div class="middle">返回<?php the_category(', ') ?></div>
				<div class="next">下一章：<?php if (get_next_post($categoryIDS)) { next_post_link('%link','%title',true);} else { echo '还没更新';} ?></div>
			</div>
			<div class="post_entry">
				<?php the_content(); ?>
			</div>
			<div class="post_nav">
				<div class="previous">上一章：<?php if (get_previous_post($categoryIDS)) { previous_post_link('%link','%title',true);} else { echo '这是第一篇';} ?></div>
				<div class="middle">返回<?php the_category(', ') ?></div>
				<div class="next">下一章：<?php if (get_next_post()) { next_post_link('%link','%title',true);} else { echo '还没更新';} ?></div>
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