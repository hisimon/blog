<?php
/**
 * Template Name: Left Sidebar Page
 * 
 * The template for displaying a page with a sidebar on the left
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<div id="widecolumn-right">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2><?php the_title(); ?></h2>
			<?php  if (has_post_thumbnail()) {
				the_post_thumbnail(array(600,600));
			} ?>
			<div class="entry">
				<?php the_content('Read more'); ?>
			</div>
			<div class="clearfix"></div>
			<?php if(comments_open()) comments_template('', true); ?>
		</div>
 	<?php endwhile; else : endif; ?>
 	<br/><br/>
</div>
<?php get_sidebar('Left'); ?>

<?php get_footer(); ?>