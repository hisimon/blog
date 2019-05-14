<?php
/**
 * Error 404 Page template file
 *
 * This file is the Error 404 Page template file, which is output whenever
 * the server encounters a "404 - file not found" error.
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<div id="widecolumn">
	<div class="not_found_404">
		<i class="red icon-frown icon-4x"></i>
		<h1><?php _e('Sorry - Page Not Found','blogBox'); ?></h1><br/><br/>
		<h2><?php _e('Sorry but we can\'t find what you were looking for.','blogBox'); ?>
		<?php _e('Can you refine your search and try again?','blogBox'); ?>&nbsp;<i class="green icon-smile icon-2x"></i></h2>
	</div>
</div>
<?php get_sidebar('404'); ?>
<?php get_footer(); ?>