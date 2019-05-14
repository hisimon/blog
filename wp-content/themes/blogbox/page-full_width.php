<?php
/**
 * Template Name: Full Width Page
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
		<span class="portfolio_title"><?php the_title(); ?></span>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
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

</div>

<?php get_footer(); ?>