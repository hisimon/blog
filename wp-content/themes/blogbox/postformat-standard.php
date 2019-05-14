<?php
/**
 * blogBox Post Format Quote
 *
 * The Quote Post Format is really the same as the Standard Post Format. The main difference 
 * is that the conent is posted under a "quote-entry" class, allowing special CSS for <blockquote>
 * and <cite> tags.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* Get the user choices for the theme options */
global $blogBox_option,$wp_query;
$blogBox_option = blogBox_get_options();
$display_post_icon = $blogBox_option['bB_use_post_format_icons'];
?>

<h2 class="post-title">
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="icon-reorder" title="Standard"></i></span>';
		} 
	?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	<?php if ( comments_open()) {
		$post_comments = get_comments( array ( 'type' => 'comment', 'post_id' => $post->ID )); ?>
		<span class="comments"><a href="<?php comments_link(); ?>"><i class="icon-comment" title="Comments"></i>&nbsp;<?php echo count($post_comments); ?></a></span>
	<?php } ?>
</h2>

<div class="clearfix"></div>

<?php if ( is_attachment() ) { ?>
	<p class="attachmentnav">&lt;&lt; Back to <a href="<?php echo get_permalink($post->post_parent); ?>" title="<?php echo get_the_title($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a></p>
<?php } else { 
	blogBox_post_metatop();
 } ?>

<div class="clearfix"></div>

<?php  if (has_post_thumbnail()) {
	the_post_thumbnail(array(600,600));
} ?>

<div class="entry">
	<?php the_content(__('Read more','blogBox')); ?>
</div>

<div class="clearfix"></div>

<?php blogBox_post_metabottom('standard') ?>

<div class="clearfix"></div>