<?php
/**
 * blogBox Post Format Audio
 *
 * The Audio Post Format includes one or more audio tracks. The format is : 
 * <cite>Audio Title <audio src="http://audio link" preload="auto" /></cite>
 * Audio.js is used to display the audio track for the visitor to play. If it is not 
 * enabled this post format should not be used. It will omly play mp3 files at this time.
 * Alternatively use a standard <a> tag and the formatting will be similar.
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
			echo '<span class="post-icon"><i class="icon-music" title="Audio"></i></span>';
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

<div class = "audio-entry">
	<?php the_content(__('Read more','blogBox')); ?>
</div>

<div class="clearfix"></div>

<?php blogBox_post_metabottom('audio') ?>

<div class="clearfix"></div>