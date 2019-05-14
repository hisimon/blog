<?php
/**
 * Template Name: Full Width Blog
 * 
 * The template for displaying content in full width with no sidebars.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<div id="fullwidth">
	
	<h2 class="fullwidth_blog_title"><?php the_title(); ?></h2>

	<div id="home1post">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
				<div class="entry">
					<?php the_content('Read more'); ?>
				</div>
		</div>
 	<?php endwhile; else : endif; ?>
	</div>
	
	<div id="fullwidth_blog">
	
	<?php
		$exclude_categories = blogBox_exclude_categories();
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query('cat='.$exclude_categories.'&paged='.$paged);
		if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 
					global $more; 
      				$more = 0;
					blogBox_post_format(); 
				?>
			</div>
		<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) {
				echo '<div class="postpagenav">';
					wp_pagenavi();
				echo '</div>';
			} else { ?>
			<div class="postpagenav">
				<div class="left"><?php next_posts_link(__('&lt;&lt; older entries','blogBox') ); ?></div>
				<div class="right"><?php previous_posts_link(__(' newer entries &gt;&gt;','blogBox') ); ?></div>
				<br/>
			</div>
			<?php } ?>
			<?php $wp_query = null; $wp_query = $temp;?>
		<?php else : ?>
		<?php endif; ?>
		<br/>
	</div>
</div>

<?php get_footer(); ?>