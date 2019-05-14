<?php
/**
 * Tag Page WordPress file
 *
 * This file is used when a tag link is clicked
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>
<div id="widecolumn">
	<h1 class="listhead"><?php _e('Posts for Tag : ','blogBox'); ?><?php single_cat_title(); ?></h1>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php blogBox_post_format(); ?>
		</div>
		<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) {
 				echo '<div class="postpagenav">';
 					wp_pagenavi();
				echo '</div>';
			} else { ?>
			<div class="postpagenav">
				<div class="left"><?php next_posts_link('&lt;&lt; older entries'); ?></div>
				<div class="right"><?php previous_posts_link(' newer entries &gt;&gt;'); ?></div>
			<br/>
			</div>
			<?php } ?>
	<?php else : ?>
		<!-- search found nothing -->
		<div class="nosearch">
			<h2><?php _e('Sorry about that but we didn\'t find anything posted with that tag!','blogBox'); ?></h2>
			<p><?php _e('You may want to try another tag.','blogBox'); ?></p>
			<h2><?php _e('Something to read?','blogBox'); ?></h2>
			<p><?php _e('Want to read something else? These are the latest posts:','blogBox'); ?><br/><br/></p>
			<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
			<p></p>
		</div>
	<?php endif; ?>
	<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>