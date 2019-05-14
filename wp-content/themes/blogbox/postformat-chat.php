<?php
/**
 * blogBox Post Format Chat
 *
 * The Chat Post Format allows you to have multiple chatters and follows a post from 
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 * filters and functions are at the bottom of this file. 
 * Basically you put author 1:text
 *                   author 2:text
 *                   etc
 * The filters are activated when the chat format is selected and output is presented (returned)
 * in a html formatted presentation allowing css styling
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
/* Get the user choices for the theme options */
global $blogBox_option;
$blogBox_option = blogBox_get_options();
$display_post_icon = $blogBox_option['bB_use_post_format_icons'];
?>

<h2 class="post-title">	
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="icon-comments-alt" title="Chat"></i></span>';
		} 
	?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	<?php if ( comments_open()) {
		$post_comments = get_comments( array ( 'type' => 'comment', 'post_id' => $post->ID )); ?>
		<span class="comments"><a href="<?php comments_link(); ?>"><i class="icon-comment" title="Comments"></i>&nbsp;<?php echo count($post_comments); ?></a></span>
	<?php } ?>
</h2>

<div class="clearfix"></div>

<?php blogBox_post_metatop(); ?>

<div class="clearfix"></div>

<?php  if (has_post_thumbnail()) {
	the_post_thumbnail(array(600,600));
} ?>

<div class="chat-entry">
	<?php the_content(__('Read more','blogBox')); ?>
</div>

<div class="clearfix"></div>

<?php blogBox_post_metabottom('chat') ?>

<div class="clearfix"></div>