<?php
/**
 * Template Name: Siteplan
 * 
 * The template for displaying a list of pages for the site
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

	<div class="siteplan">
		<h1><?php _e('List of Pages for Website','blogBox'); ?></h1>
		<br/>
		<?php 
			$pages = get_pages();
			echo '<ul class="list-arrow">';
			foreach ( $pages as $page ) {
  				$option = '<li><a href="' . get_page_link( $page->ID ).'">';
				$option .= $page->post_title;
				$option .= '</a></li>';
				echo $option;
 			}
			echo '</ul>'; 
		?>

	</div>


</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>