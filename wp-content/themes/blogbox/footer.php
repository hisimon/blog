<?php 
/**
 * Footer Template Part File
 * 
 * Template part file that contains the site footer and
 * closing HTML body elements
 *
 * This file is called by all primary template pages
 * 
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
	$bB_showfooter = $blogBox_option['bB_show_footer'];
	$bB_showcopyright = $blogBox_option['bB_show_copyright_strip'];
	$bB_footercols = $blogBox_option['bB_footer_columns'];
?>
	<div id="footer">
		<?php if( $bB_showfooter == 1 ) { ?>
			
			<div id="footer_col_wrap">
			    <div class="footercol-<?php echo $bB_footercols; ?>">
			    		<?php if ( !dynamic_sidebar('Footer A') ) : ?>
			    	    	<?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer A, something, anything!','blogBox'); ?></span>
			    		<?php endif; ?>
			    </div>
			    <div class="footercol-<?php echo $bB_footercols; ?>">
			    		<?php if ( !dynamic_sidebar('Footer B') ) : ?>
			    			<?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer B, something, anything!','blogBox'); ?></span>
			    		<?php endif; ?>
			    </div>
			    <div class="footercol-<?php echo $bB_footercols; ?>">
			    		<?php if ( !dynamic_sidebar('Footer C') ) : ?>
			    			<?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer C, something, anything!','blogBox'); ?></span>
			    		<?php endif; ?>
			   	</div>
			    <?php if( $bB_footercols == 4 ) { ?>
				    <div class="footercol-4">
				    		<?php if ( !dynamic_sidebar('Footer D') ) : ?>
				    			<?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer D, something, anything!','blogBox'); ?></span>
				    		<?php endif; ?>
				    </div>
				<?php } ?>
			</div>
		<?php } ?>
		
		<div class="clearfix"></div>
		
		<?php if( $bB_showcopyright == 1 ) { ?>
		
			<div id="copyright">
				<span class="copyright_c1"><?php echo wp_kses_post(stripslashes($blogBox_option['bB_left_copyright_text'])); ?></span>
				<span class="copyright_c2"><?php echo wp_kses_post(stripslashes($blogBox_option['bB_middle_copyright_text'])); ?></span>
				<span class="copyright_c3"><?php echo wp_kses_post(stripslashes($blogBox_option['bB_right_copyright_text'])); ?></span>
			</div>
					
		<?php } ?>

	</div>
</div>	
<?php wp_footer(); ?>
</body>
</html>