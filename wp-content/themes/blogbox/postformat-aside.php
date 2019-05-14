<?php
/**
 * blogBox Post Format Aside
 *
 * The Aside Post Format is typically styled without a title. Similar to a Facebook note update.
 * In my case I have excluded all links, meta (except author), and the title. Only content is shown.
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* Get the user choices for the theme options */
global $blogBox_option;
$blogBox_option = blogBox_get_options();
$display_post_icon = $blogBox_option['bB_use_post_format_icons'];
?>
<br/>
<h2 class="post-title">
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="icon-info-sign" title="Aside"></i></span>';
		} 
	?>
</h2>
<div class="aside-entry">
	<?php the_content(__('Read more','blogBox')); ?>
	<span class="author"><?php the_author_posts_link(); ?></span>
</div>

<div class="clearfix"></div>
			
<?php blogBox_post_metabottom('aside') ?>
	
<div class="clearfix"></div>