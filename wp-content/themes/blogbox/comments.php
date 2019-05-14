<?php
/**
 * Category Page template file
 *
 * This file delivers all the comments, pingbacks, trackbacks, and the 
 * comment form when called. It is the default file called in the comments_template() call
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','blogBox') );

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','blogBox'); ?></p>
	<?php
		return;
	}
?>

<?php if( comments_open() ) {
	$number_comments = count($wp_query->comments_by_type['comment']); ?>
	<h4 class="comments-title"><?php If($number_comments==0){ echo 'No Comments Yet';}elseif($number_comments==1){echo '1 Comment So Far';}else{echo $number_comments.' Comments';}  ?></h4>
	<div class="commentlist">
		<?php wp_list_comments('type=comment&callback=blogBox_comment&avatar_size=50&style=div'); ?>
	</div>
	<div class="commentnav">
		<div class="left"><?php previous_comments_link() ?></div>
		<div class="right"><?php next_comments_link() ?></div>
	</div>
	<div class="clearfix"></div>

<?php } else {  ?>
	
	<p class="nocomments"><?php _e('Comments are closed.','blogBox'); ?></p><br/>
	
<?php }

if( pings_open() ) {
	
	if( !empty($comments_by_type['pings']) ) { ?>

		<h4 class="comments-title">Pings and Trackbacks (<?php echo count($wp_query->comments_by_type['pings']); ?> )</h4>
		<ul class="pingslist">
			<?php wp_list_comments('type=pings&callback=blogBox_cleanPings'); ?>
		</ul>
		
	<?php }
}
	
	$bB_comment_form_args = array(
	
		'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Email not published','blogBox' ) . ' ( *'.__(' Required','blogBox').' )</p>',
		
		'comment_notes_after' => ''
	);
	comment_form( $bB_comment_form_args ); 
?>