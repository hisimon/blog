<?php
/**
 * blogBox Post Format Video
 *
 * The Video Post Format is designed for video posts with little text. The text you do 
 * enter is shown as a caption in the bottom of the video window. The  css styling 
 * is set up for embedded video so simply type in the http:// reference and you are set.
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
<h2 class="post-title">		
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="icon-film" title="Video"></i></span>';
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

<div class="video-entry">
	<?php the_content(__('Read more','blogBox')); ?>
</div>

<div class="clearfix"></div>

<?php blogBox_post_metabottom('video') ?>

<div class="clearfix"></div>