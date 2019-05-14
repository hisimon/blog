<?php
/**
 * Default Page template file
 *
 * This file is the default Page template file, used to display static
 * Pages if no custom Page template is defined.
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
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>