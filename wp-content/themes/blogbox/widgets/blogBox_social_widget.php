<?php
/*
Plugin Name: blogBox Social Links Widget
Plugin URI: http://demo1.kevinsspace.ca/
Description: A widget for the blogBox theme that displays the social links
Version: 2.0
Author: Kevin Archibald
Author URI: http://www.kevinsspace.ca/
License: GPLv3
 */
 
/**
 * Social links widget file
 *
 * This file is  widget that will load any links that have urls coded in the 
 * blogBox Options => General Tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

 // use widgets_init action hook to execute custom function
 add_action ( 'widgets_init','blogBox_social_links_register_widget' );

//register our widget 
 function blogBox_social_links_register_widget() {
 	register_widget ( 'blogBox_social_links_widget' );
 }
 
 //widget class
class blogBox_social_links_widget extends WP_Widget {

    //process the new widget
    function blogBox_social_links_widget() {
        $widget_ops = array( 
			'classname' => 'blogBox_social_links_widget_class', 
			'description' => __('Display social links','blogBox') 
			); 
        $this->WP_Widget( 'blogBox_social_links_widget', __('blogBox Social Links Widget','blogBox'), $widget_ops );
    }
 	
 	// Form for widget setup
 	function form ( $instance ) {
 		$bB_social_defaults = array(
 			'bB_social_title' => 'Social Links',
			'bB_social_icon_size' => 'small',
			'bB_social_facebook' => 0,
			'bB_social_twitter' => 0,
			'bB_social_delicious' => 0,
			'bB_social_digg' => 0,
			'bB_social_google' => 0,
			'bB_social_linkedin' => 0,
			'bB_social_myspace' => 0,
			'bB_social_rss' => 0,
			'bB_social_tumblr' => 0,
			'bB_social_pinterest' => 0
		);
		$instance = wp_parse_args( (array) $instance, $bB_social_defaults );
		$title = $instance['bB_social_title'];
		$icon_size = $instance['bB_social_icon_size'];
		$facebook = $instance['bB_social_facebook'];
		$twitter = $instance['bB_social_twitter'];
		$delicious = $instance['bB_social_delicious'];
		$digg = $instance['bB_social_digg'];
		$google = $instance['bB_social_google'];
		$linkedin = $instance['bB_social_linkedin'];
		$myspace = $instance['bB_social_myspace'];
		$rss = $instance['bB_social_rss'];
		$tumblr = $instance['bB_social_tumblr'];
		$pinterest = $instance['bB_social_pinterest'];
		?>
			<p>Title : <input class="widefat" id="<?php echo $this->get_field_id('bB_social_title'); ?>" name="<?php echo $this->get_field_name('bB_social_title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
			<p>Icon size : 
				<select name="<?php echo $this->get_field_name('bB_social_icon_size'); ?>">
					<option value="small" <?php selected( $icon_size, "small" ); ?>>small</option>
					<option value="large" <?php selected( $icon_size, "large" ); ?>>large</option>
				</select> 
			</p>
			<p>Delicious <input name="<?php echo $this->get_field_name('bB_social_delicious'); ?>" type="checkbox" <?php checked( $delicious, 'on' ); ?> /></p>
			<p>Digg <input name="<?php echo $this->get_field_name('bB_social_digg'); ?>" type="checkbox" <?php checked( $digg, 'on' ); ?> /></p>
			<p>Facebook <input name="<?php echo $this->get_field_name('bB_social_facebook'); ?>" type="checkbox" <?php checked( $facebook, 'on' ); ?> /></p>
			<p>Google+ <input name="<?php echo $this->get_field_name('bB_social_google'); ?>" type="checkbox" <?php checked( $google, 'on' ); ?> /></p>
			<p>Linkedin <input name="<?php echo $this->get_field_name('bB_social_linkedin'); ?>" type="checkbox" <?php checked( $linkedin, 'on' ); ?> /></p>
			<p>MySpace <input name="<?php echo $this->get_field_name('bB_social_myspace'); ?>" type="checkbox" <?php checked( $myspace, 'on' ); ?> /></p>
			<p>Pinterest <input name="<?php echo $this->get_field_name('bB_social_pinterest'); ?>" type="checkbox" <?php checked( $pinterest, 'on' ); ?> /></p>
			<p>RSS <input name="<?php echo $this->get_field_name('bB_social_rss'); ?>" type="checkbox" <?php checked( $rss, 'on' ); ?> /></p>
			<p>Tumblr <input name="<?php echo $this->get_field_name('bB_social_tumblr'); ?>" type="checkbox" <?php checked( $tumblr, 'on' ); ?> /></p>
			<p>Twitter <input name="<?php echo $this->get_field_name('bB_social_twitter'); ?>" type="checkbox" <?php checked( $twitter, 'on' ); ?> /></p>
		<?php	
	}
	
	//save the widget settings
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['bB_social_title'] = strip_tags( $new_instance['bB_social_title'] );
		$instance['bB_social_icon_size'] = strip_tags( $new_instance['bB_social_icon_size'] );
		$instance['bB_social_facebook'] = strip_tags( $new_instance['bB_social_facebook'] );
		$instance['bB_social_twitter'] = strip_tags( $new_instance['bB_social_twitter'] );
		$instance['bB_social_delicious'] = strip_tags( $new_instance['bB_social_delicious'] );
		$instance['bB_social_digg'] = strip_tags( $new_instance['bB_social_digg'] );
		$instance['bB_social_google'] = strip_tags( $new_instance['bB_social_google'] );
		$instance['bB_social_linkedin'] = strip_tags( $new_instance['bB_social_linkedin'] );
		$instance['bB_social_myspace'] = strip_tags( $new_instance['bB_social_myspace'] );
		$instance['bB_social_rss'] = strip_tags( $new_instance['bB_social_rss'] );
		$instance['bB_social_tumblr'] = strip_tags( $new_instance['bB_social_tumblr'] );
		$instance['bB_social_pinterest'] = strip_tags( $new_instance['bB_social_pinterest'] );
		
		return $instance;
	}
	
	//display the widget
    function widget($args, $instance) {
    	global $blogBox_option;
		$blogBox_option = blogBox_get_options();
     	extract ( $args);
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['bB_social_title'] );
		if ( !empty( $title )) { echo $before_title.$title.$after_title;}
		$html = '';
		$html .= '<div class="bB-social-widget">';
		if ( $instance['bB_social_icon_size'] == 'small' ){
			If(esc_url($blogBox_option['bB_header_rss']) !=="" && $instance['bB_social_rss'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_rss']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/rss_s.png" alt="RSS FEED" title="RSS FEED" /></a>';
			If(esc_url($blogBox_option['bB_header_linkedin']) !=="" && $instance['bB_social_linkedin'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_linkedin']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/linkedin_s.png" alt="Linkedin" title="Linkedin" /></a>';
			If(esc_url($blogBox_option['bB_header_twitter']) !=="" && $instance['bB_social_twitter'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_twitter']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/twitter_s.png" alt="Twitter" title="Twitter" /></a>';
			If(esc_url($blogBox_option['bB_header_facebook']) !=="" && $instance['bB_social_facebook'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_facebook']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/facebook_s.png" alt="Facebook" title="Facebook" /></a>';
			If(esc_url($blogBox_option['bB_header_delicious']) !=="" && $instance['bB_social_delicious'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_delicious']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/delicious_s.png" alt="Delicious" title="Delicious" /></a>';
			If(esc_url($blogBox_option['bB_header_google_plus']) !=="" && $instance['bB_social_google'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_google_plus']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/google_plus_s.png" alt="Google+" title="Google+" /></a>';
			If(esc_url($blogBox_option['bB_header_digg']) != "" && $instance['bB_social_digg'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_digg']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/digg_s.png" alt="Digg" title="Digg" /></a>';
			If(esc_url($blogBox_option['bB_header_pinterest']) !=="" && $instance['bB_social_pinterest'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_pinterest']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/pinterest_s.png" alt="Pinterest" title="Pinterest" /></a>';
			If(esc_url($blogBox_option['bB_header_myspace']) !=="" && $instance['bB_social_myspace'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_myspace']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/myspace_s.png" alt="MySpace" title="MySpace" /></a>';
			If(esc_url($blogBox_option['bB_header_tumblr']) !=="" && $instance['bB_social_tumblr'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_tumblr']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/tumblr_s.png" alt="Tumblr" title="Tumblr" /></a>';
		} else {
			If(esc_url($blogBox_option['bB_header_rss']) !=="" && $instance['bB_social_rss'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_rss']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/rss_l.png" alt="RSS FEED" title="RSS FEED" /></a>';
			If(esc_url($blogBox_option['bB_header_linkedin']) !=="" && $instance['bB_social_linkedin'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_linkedin']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/linkedin_l.png" alt="Linkedin" title="Linkedin" /></a>';
			If(esc_url($blogBox_option['bB_header_twitter']) !=="" && $instance['bB_social_twitter'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_twitter']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/twitter_l.png" alt="Twitter" title="Twitter" /></a>';
			If(esc_url($blogBox_option['bB_header_facebook']) !=="" && $instance['bB_social_facebook'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_facebook']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/facebook_l.png" alt="Facebook" title="Facebook" /></a>';
			If(esc_url($blogBox_option['bB_header_delicious']) !=="" && $instance['bB_social_delicious'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_delicious']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/delicious_l.png" alt="Delicious" title="Delicious" /></a>';
			If(esc_url($blogBox_option['bB_header_google_plus']) !=="" && $instance['bB_social_google'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_google_plus']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/google_plus_l.png" alt="Google+" title="Google+" /></a>';
			If(esc_url($blogBox_option['bB_header_digg']) !=="" && $instance['bB_social_digg'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_digg']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/digg_l.png" alt="Digg" title="Digg" /></a>';
			If(esc_url($blogBox_option['bB_header_pinterest']) !=="" && $instance['bB_social_pinterest'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_pinterest']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/pinterest_l.png" alt="Pinterest" title="Pinterest" /></a>';
			If(esc_url($blogBox_option['bB_header_myspace']) !=="" && $instance['bB_social_myspace'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_myspace']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/myspace_l.png" alt="MySpace" title="MySpace" /></a>';
			If(esc_url($blogBox_option['bB_header_tumblr']) !=="" && $instance['bB_social_tumblr'] == 'on' ) $html .= '<a href="' . esc_url($blogBox_option['bB_header_tumblr']) . '" target="_blank" ><img src="'. get_template_directory_uri() . '/images/social/tumblr_l.png" alt="Tumblr" title="Tumblr" /></a>';
		}
		$html .= '</div>';
		
		echo $html;
		echo $after_widget; 
	}
}
?>