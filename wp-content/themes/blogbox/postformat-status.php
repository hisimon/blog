<?php
/**
 * blogBox Post Format Status
 *
 * The Status Post Format is a short status update, similar to a Twitter status update.
 * Included in this format is a time stamp, author avatar and a author name. Comments are 
 * permitted. 
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* Get the user choices for the theme options */
global $blogBox_option;
$blogBox_option = blogBox_get_options();
$display_post_icon = $blogBox_option['bB_use_post_format_icons'];
?>
<h2 class="post-title">
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="icon-exclamation-sign" title="Status"></i></span>';
		} 
	?>
</h2>
<div class="status-entry">
	
	<span class="timestamp"><?php the_time(get_option('date_format')); ?></span>
	<?php if ( comments_open()) {
		$post_comments = get_comments( array ( 'type' => 'comment', 'post_id' => $post->ID )); ?>
		<span class="comments"><a href="<?php comments_link(); ?>"><i class="icon-comment" title="Comments"></i>&nbsp;<?php echo count($post_comments); ?></a></span>
	<?php } ?>
	<div class="clearfix"></div>
	<?php
		$has_valid_avatar = blogBox_validate_gravatar(get_the_author_meta('user_email'));
		if ( $has_valid_avatar == 1 ) echo get_avatar( get_the_author_meta('ID'), 50 ); 
	?>
	<?php the_content(__('Read more','blogBox')); ?>
	<span class="author"><?php the_author_posts_link(); ?></span>
</div>

<div class="clearfix"></div>
		
<?php blogBox_post_metabottom('status') ?>

<div class="clearfix"></div>