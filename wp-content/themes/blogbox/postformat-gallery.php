<?php
/**
 * blogBox Post Format Gallery
 *
 * The Gallery Post Format is really set up for a single gallery. It alllows the user 
 * to post a gallery and not have all the pictures presented. The number of pictures are counted
 * and displayed as a caption to the most recent image in the gallery. Only the post excerpt is allowed.
 * I used the twenty-eleven content-gallery.php as a guide for this format.
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
			echo '<span class="post-icon"><i class="icon-th" title="Gallery"></i></span>';
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
<div class="gallery-entry">
	<?php
		global $post;
		if(!is_single()) {
			$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
			if ( $images ) :
				$total_images = count( $images );
				$image = array_shift( $images );
				$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
	?>
				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					<div class="clearfix"></div>
					<em><?php echo $total_images; _e(' images','blogBox'); ?></em>
				</figure><!-- .gallery-thumb -->
				<div class="gallery-excerpt">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; 								
		} else {
			the_content(__('Read more','blogBox')); 
		} ?>
</div>

<div class="clearfix"></div>

<?php blogBox_post_metabottom('gallery') ?>

<div class="clearfix"></div>