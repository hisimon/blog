<?php
/**
 * Template Name: Home Page
 * 
 * The template for displaying the theme's static home page.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<?php 
	global $blogBox_option;
	$blogBox_option = blogBox_get_options();
 ?>

<div id="fullwidth">

	<?php if(sanitize_text_field($blogBox_option['bB_home1feature_options']) !== "No feature") blogBox_feature_slider(); ?>
	
	<div id="home1post">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post">
				<div class="entry">
					<?php the_content('Read more'); ?>
				</div>
			</div>
			
 		<?php endwhile; else : endif; ?>
	</div>
	
	<?php blogBox_home_sections(); ?>

</div>

<?php get_footer(); ?>