<?php
/**
 * Custom styles file
 *
 * This file is called by functions.php and loads the user selections for background and text colors
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
/* Get the user choices for the theme options */
//$blogBox_option = blogBox_get_options();
?>
<?php

	define('BLOGBOX_THEME_CSS', get_template_directory_uri() . '/css' );
	$blogBox_option = blogBox_get_options();
	define('BLOGBOX_THEME_IMAGES', get_template_directory_uri() . '/images');

	if($blogBox_option['bB_use_skin'] && $blogBox_option['bB_use_skin'] == true){
		switch($blogBox_option['bB_select_skin']) {
			case "Blue" :
				if( !function_exists ('blogBox_blue_style') ) {
					function blogBox_blue_style () {
						wp_register_style( 'blogBox_blue_skin',BLOGBOX_THEME_CSS.'/blue_skin.css',array(),'20120527','all' );
						wp_enqueue_style('blogBox_blue_skin');
					}
					add_action('wp_print_styles','blogBox_blue_style',11);
				}
				break;
			case "Brown" :
				if( !function_exists ('blogBox_brown_style') ) {
					function blogBox_brown_style () {
						wp_register_style( 'blogBox_brown_skin',BLOGBOX_THEME_CSS.'/brown_skin.css',array(),'20120527','all' );
						wp_enqueue_style('blogBox_brown_skin'); 
					}
					add_action('wp_print_styles','blogBox_brown_style',11);
				}
				break;						
			case "Dark Gray" :
				if( !function_exists ('blogBox_dark_gray_style') ) {
					function blogBox_dark_gray_style () {
						wp_register_style( 'blogBox_dark_gray_skin',BLOGBOX_THEME_CSS.'/dark_gray_skin.css',array(),'20120527','all' );
						wp_enqueue_style('blogBox_dark_gray_skin');
					}
					add_action('wp_print_styles','blogBox_dark_gray_style',11); 
				}
				break;		
			case "Gray" :
				if( !function_exists ('blogBox_gray_style') ) {
					function blogBox_gray_style () {
						wp_register_style( 'blogBox_gray_skin',BLOGBOX_THEME_CSS.'/gray_skin.css',array(),'20120527','all' );
						wp_enqueue_style('blogBox_gray_skin');
					}
					add_action('wp_print_styles','blogBox_gray_style',11); 
				}
				break;
			case "White" :
				if( !function_exists ('blogBox_white_style') ) {
					function blogBox_white_style () {
						wp_register_style( 'blogBox_white_skin',BLOGBOX_THEME_CSS.'/white_skin.css',array(),'20120925','all' );
						wp_enqueue_style('blogBox_white_skin');
					}
					add_action('wp_print_styles','blogBox_white_style',11); 
				}
				break;
			case "Wine" :
				if( !function_exists ('blogBox_wine_style') ) {
					function blogBox_wine_style () {
						wp_register_style( 'blogBox_wine_skin',BLOGBOX_THEME_CSS.'/wine_skin.css',array(),'20120527','all' );
						wp_enqueue_style('blogBox_wine_skin');
					}
					add_action('wp_print_styles','blogBox_wine_style',11); 
				}
				break;												
		}
	}
	else {?>
		<style type="text/css" >
			body {
				background-color:<?php echo $blogBox_option['bB_outside_background_color']; ?>;
			<?php 
				if($blogBox_option['bB_select_gradient'] == "Dark Gradient") { 
					echo 'background-image: url('.BLOGBOX_THEME_IMAGES.'/bg1.png);';
					echo 'background-repeat: repeat-x;';
				} elseif($blogBox_option['bB_select_gradient'] == "Light Gradient") {
					echo 'background-image: url('.BLOGBOX_THEME_IMAGES.'/bg2.png);';
					echo 'background-repeat: repeat-x;';
				}	
			?>
			}
			#header {
				background-color: <?php echo $blogBox_option['bB_header_background_color']; ?>;
				border-top: 2px solid <?php echo $blogBox_option['bB_header_top_border_color']; ?>;
			}
			nav {
				background-color: <?php echo $blogBox_option['bB_nav_background_color']; ?>;
				border-bottom: 2px solid <?php echo $blogBox_option['bB_header_bottom_border_color']; ?>;
			}
			.sf-menu li a {
				color: <?php echo $blogBox_option['bB_nav_text_color']; ?>;
			}
			.sf-menu li:hover, .sf-menu li:hover a {
				color: <?php echo $blogBox_option['bB_nav_text_hover_color']; ?>;
				background-color: <?php echo $blogBox_option['bB_nav_drop_background_hover_color']; ?>;
			}
			.sub-menu li a {color: <?php echo $blogBox_option['bB_nav_drop_text_color']; ?>!important;}
			.sub-menu li:hover a {color: <?php echo $blogBox_option['bB_nav_drop_hover_text_color']; ?>!important;}
			.sub-menu li,.sf-menu ul ul li {background-color: <?php echo $blogBox_option['bB_nav_drop_background_color']; ?>;}
			.sub-menu li:hover {background-color: <?php echo $blogBox_option['bB_nav_drop_background_hover_color']; ?>;}
			
			<?php if( $blogBox_option['bB_nav_dropdown_arrows'] == 'black' ) { ?>
				/*down arrowa*/
				.sf-arrows .sf-with-ul:after {border: 5px solid transparent;border-top-color: #000000; border-top-color: rgba(0,0,0,.75);}
				.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after {
					border-top-color: #000000; /* edit this to suit design (no rgba in IE8) */
					border-top-color: rgba(0,0,0,1.0);
				}
				/*right arrows*/
				.sf-arrows ul .sf-with-ul:after {border-color: transparent;border-left-color: #000000; border-left-color: rgba(0,0,0,.75);}
				.sf-arrows ul li > .sf-with-ul:focus:after,.sf-arrows ul li:hover > .sf-with-ul:after,.sf-arrows ul .sfHover > .sf-with-ul:after {
					border-left-color: #000000;
					border-left-color: rgba(0,0,0,1.0);
				}
			<?php } elseif( $blogBox_option['bB_nav_dropdown_arrows'] == 'black-white' ) { ?>
				/*down arrowa*/
				.sf-arrows .sf-with-ul:after {border: 5px solid transparent;border-top-color: #000000; border-top-color: rgba(0,0,0,.75);}
				.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after {
					border-top-color: #000000; /* edit this to suit design (no rgba in IE8) */
					border-top-color: rgba(0,0,0,1.0);
				}
				/*right arrows*/
				.sf-arrows ul .sf-with-ul:after {border-color: transparent;border-left-color: #FFFFFF; border-left-color: rgba(255,255,255,.75);}
				.sf-arrows ul li > .sf-with-ul:focus:after,.sf-arrows ul li:hover > .sf-with-ul:after,.sf-arrows ul .sfHover > .sf-with-ul:after {
					border-left-color: #FFFFFF;
					border-left-color: rgba(255,255,255,1.0);
				}
			<?php } elseif( $blogBox_option['bB_nav_dropdown_arrows'] == 'white-black' ) { ?>
				/*down arrowa*/
				.sf-arrows .sf-with-ul:after {border: 5px solid transparent;border-top-color: #FFFFFF; border-top-color: rgba(255,255,255,.75);}
				.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after {
					border-top-color: #FFFFFF; /* edit this to suit design (no rgba in IE8) */
					border-top-color: rgba(255,255,255,1.0);
				}
				/*right arrows*/
				.sf-arrows ul .sf-with-ul:after {border-color: transparent;border-left-color: #000000; border-left-color: rgba(0,0,0,.75);}
				.sf-arrows ul li > .sf-with-ul:focus:after,.sf-arrows ul li:hover > .sf-with-ul:after,.sf-arrows ul .sfHover > .sf-with-ul:after {
					border-left-color: #000000;
					border-left-color: rgba(0,0,0,1.0);
				}
			<?php } elseif( $blogBox_option['bB_nav_dropdown_arrows'] == 'white' ) { ?>
				/*down arrowa*/
				.sf-arrows .sf-with-ul:after {border: 5px solid transparent;border-top-color: #FFFFFF; border-top-color: rgba(255,255,255,.75);}
				.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after {
					border-top-color: #FFFFFF; /* edit this to suit design (no rgba in IE8) */
					border-top-color: rgba(255,255,255,1.0);
				}
				/*right arrows*/
				.sf-arrows ul .sf-with-ul:after {border-color: transparent;border-left-color: #FFFFFF; border-left-color: rgba(255,255,255,.75);}
				.sf-arrows ul li > .sf-with-ul:focus:after,.sf-arrows ul li:hover > .sf-with-ul:after,.sf-arrows ul .sfHover > .sf-with-ul:after {
					border-left-color: #FFFFFF;
					border-left-color: rgba(255,255,255,1.0);
				}
			<?php } elseif( $blogBox_option['bB_nav_dropdown_arrows'] == 'gray' ) { ?>
				/*down arrowa*/
				.sf-arrows .sf-with-ul:after {border: 5px solid transparent;border-top-color: #969696; border-top-color: rgba(150,150,150,.75);}
				.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after {
					border-top-color: #969696; /* edit this to suit design (no rgba in IE8) */
					border-top-color: rgba(150,150,150,1.0);
				}
				/*right arrows*/
				.sf-arrows ul .sf-with-ul:after {border-color: transparent;border-left-color: #969696; border-left-color: rgba(150,150,150,.75);}
				.sf-arrows ul li > .sf-with-ul:focus:after,.sf-arrows ul li:hover > .sf-with-ul:after,.sf-arrows ul .sfHover > .sf-with-ul:after {
					border-left-color: #969696;
					border-left-color: rgba(150,150,150,1.0);
				}
			<?php } ?>
			
			.thin-border {border-top: 1px solid <?php echo $blogBox_option['bB_menu_border_color']; ?>;}
			#main-menu-center-border {
				border-top: 1px solid <?php echo $blogBox_option['bB_menu_border_color']; ?>;
				border-bottom: 1px solid <?php echo $blogBox_option['bB_menu_border_color']; ?>;
			}
			
			body #pagewrap {background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#widecolumn {background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#fullwidth {background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#feature-area{background-color: <?php echo $blogBox_option['bB_feature_area_background_color']; ?>;}
			#sidebar{background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#home1post{background-color: <?php echo $blogBox_option['bB_home1_post_background_color']; ?>;}
			#home1section1 {background-color: <?php echo $blogBox_option['bB_home1_slogan1_background_color']; ?>;}
			#slogan2{background-color: <?php echo $blogBox_option['bB_home1_slogan2_background_color']; ?>;}
			#header {color:<?php echo $blogBox_option['bB_header_text_color']; ?>;}
			#header a h1 {color:<?php echo $blogBox_option['bB_header_link_color']; ?>;}
			#header a h1:hover {color:<?php echo $blogBox_option['bB_header_hover_color']; ?>;}
			#feature-area{color:<?php echo $blogBox_option['bB_feature_text_color']; ?>;}
			a:link, a:active, a:visited {color: <?php echo $blogBox_option['bB_main_link_color']; ?>;}
			a:hover { color: <?php echo $blogBox_option['bB_main_hover_color']; ?>;}
			body #pagewrap {color: <?php echo $blogBox_option['bB_main_text_color']; ?>;}
			#homesection2 h1 {color: <?php echo $blogBox_option['bB_main_text_color']; ?>;}
			#footer {background-color:<?php echo $blogBox_option['bB_footer_background_color']; ?>;}
			#footer {color: <?php echo $blogBox_option['bB_footer_text_color']; ?>;}
			#footer a,#footer a:link {color: <?php echo $blogBox_option['bB_footer_link_color']; ?>;}
			#footer a:hover {color: <?php echo $blogBox_option['bB_footer_hover_color']; ?>;}
			#footer h1,#footer h2,#footer h3,#footer h4,#footer h5,#footer h6 {color: <?php echo $blogBox_option['bB_footer_text_color']; ?>;}
			#copyright {background-color: <?php echo $blogBox_option['bB_copyright_background_color']; ?>;}
			#copyright {color: <?php echo $blogBox_option['bB_copyright_text_color']; ?>;}
			#copyright a{color: <?php echo $blogBox_option['bB_copyright_link_color']; ?>;}
			#copyright a:hover {color: <?php echo $blogBox_option['bB_copyright_hover_color']; ?>;}
			table#wp-calendar td#today {color: <?php echo $blogBox_option['bB_header_text_color']; ?>;}
			table#wp-calendar th {background-color: <?php echo $blogBox_option['bB_header_background_color']; ?>;}
			table#wp-calendar th {color: <?php echo $blogBox_option['bB_header_text_color']; ?>;}
			.aside-entry {
				background-color: <?php echo $blogBox_option['bB_aside_background_bottom']; ?>;
				background-image: -webkit-linear-gradient(top, <?php echo $blogBox_option['bB_aside_background_top']; ?>, <?php echo $blogBox_option['bB_aside_background_bottom']; ?>);
				background-image: -moz-linear-gradient(top, <?php echo $blogBox_option['bB_aside_background_top']; ?>, <?php echo $blogBox_option['bB_aside_background_bottom']; ?>);
				background-image: -ms-linear-gradient(top, <?php echo $blogBox_option['bB_aside_background_top']; ?>, <?php echo $blogBox_option['bB_aside_background_bottom']; ?>);
				background-image: linear-gradient(top, <?php echo $blogBox_option['bB_aside_background_top']; ?>, <?php echo $blogBox_option['bB_aside_background_bottom']; ?>);
				color: <?php echo $blogBox_option['bB_aside_text_color']; ?>;
			}
			.aside-entry .author a {color:<?php echo $blogBox_option['bB_aside_text_color']; ?>;}
			.audio-entry .audio-wrap  {
				background-color: <?php echo $blogBox_option['bB_audio_background_color']; ?>;
				color: <?php echo $blogBox_option['bB_audio_text_color']; ?>;
			}
			.chat-entry {background-color: <?php echo $blogBox_option['bB_chat_background_color']; ?>;}
			.link-entry a {
				background-color: <?php echo $blogBox_option['bB_link_post_background_color']; ?>;
				border: 2px solid <?php echo $blogBox_option['bB_link_post_text_color']; ?>;
				color: <?php echo $blogBox_option['bB_link_post_text_color']; ?>;
			}
			.link-entry a:hover {
				color: <?php echo $blogBox_option['bB_link_post_hover_text_color']; ?>;
			}
			.status-entry {
				background-color: <?php echo $blogBox_option['bB_status_background_color']; ?>;
				color: <?php echo $blogBox_option['bB_status_text_color']; ?>;
			}
			.status-entry .timestamp,.status-entry .comments,.status-entry a {
				color: <?php echo $blogBox_option['bB_status_meta_color']; ?>;
			}
			.quote-entry blockquote {
				border: 5px solid <?php echo $blogBox_option['bB_quote_border_color']; ?>;
				background: <?php echo $blogBox_option['bB_quote_background_color']; ?>;
				color: <?php echo $blogBox_option['bB_quote_text_color']; ?>;
			}
			.quote-entry blockquote a {
				color: <?php echo $blogBox_option['bB_quote_text_color']; ?>;
			}	
		</style>
<?php }
?>