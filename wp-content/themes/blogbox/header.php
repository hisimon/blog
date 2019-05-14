<?php    
/**
 * Header Template Part File
 * 
 * Template part file that contains the HTML document head and 
 * opening HTML body elements, as well as the site header.
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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta http-equiv="x-ua-compatible" content="IE=edge" >
<meta charset=<?php bloginfo('charset'); ?> />

<title><?php wp_title(''); ?></title>

<?php 
	global $blogBox_option;
	$blogBox_option = blogBox_get_options();
	if( $blogBox_option['bB_include_mobile_design'] == 1 ) echo '<meta name="viewport" content="width=device-width" />' ;
?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if( isset($blogBox_option['bB_show_favicon']) && $blogBox_option['bB_show_favicon'] == 1 ) echo '<link rel="shortcut icon" href="'. get_template_directory_uri().'/favicon.png" />'; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="pagewrap">
		<div id="header">
			
			<?php 				
				
				if( $blogBox_option['bB_use_banner_image'] ) {
					if( $blogBox_option['bB_show_social_strip'] ) {
						echo '<div class="header-widget-half">';
							if ( !dynamic_sidebar('Header-Sidebar') ) :
							endif;
						echo '</div>';
					}
					if ($blogBox_option['bB_show_blog_title'] || $blogBox_option['bB_show_blog_description'] ) {
						echo '<div class="full-banner-text">';
							if( $blogBox_option['bB_show_blog_title'] ) {
								
								echo '<a href="'.get_site_url().'/">';
									echo '<h1 class="blog-title-top-left">'.get_bloginfo("name").'</h1>';
								echo '</a>';
							}
							if( $blogBox_option['bB_show_blog_description'] ) echo '<span class="blog-description-top-left">'.get_bloginfo('description').'</span>';
						echo '</div>';
					}
					echo '<div class="clearfix"></div>';
					if( function_exists( 'get_custom_header' ) ) { 
						$header_image = get_header_image();
						If ( $header_image ) {
							echo '<div class="header-banner">';
								echo '<a href="'.get_site_url().'/">';
									echo '<img class="logo" src="'.get_header_image().'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" alt="logo" />';
								echo '</a>';
							echo '</div>';
						}
					}
				} else {
					if( function_exists( 'get_custom_header' ) ) { 
						$header_image = get_header_image();
						If ( $header_image ) {
							if ( $blogBox_option['bB_show_blog_title'] == 0 && $blogBox_option['bB_show_blog_description'] == 0 ){
								if( $blogBox_option['bB_show_social_strip'] ) {
									echo '<div class="header-widget-half">';
										if ( !dynamic_sidebar('Header-Sidebar') ) :
										endif;
									echo '</div>';
								}
								echo '<div class="header-logo-half">';
									echo '<a href="'.get_site_url().'/">';
										echo '<img class="logo" src="'.get_header_image().'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" alt="logo" />';
									echo '</a>';
								echo '</div>';
							} else {
								if( $blogBox_option['bB_show_social_strip'] ) {
									echo '<div class="header-widget-narrow">';
										if ( !dynamic_sidebar('Header-Sidebar') ) :
										endif;
									echo '</div>';
								}
								echo '<div class="header-logo">';
									echo '<a href="'.get_site_url().'/">';
										echo '<img class="logo" src="'.get_header_image().'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" alt="logo" />';
									echo '</a>';
								echo '</div>';
								echo '<div class="center-50">';
									if( $blogBox_option['bB_show_blog_title'] ) {
										echo '<a href="'.get_site_url().'/">';
											echo '<h1 class="blog-title">'.get_bloginfo("name").'</h1>';
										echo '</a>';
									}
									if( $blogBox_option['bB_show_blog_title']) {
										if( $blogBox_option['bB_show_blog_description'] ) echo'<span class="blog-description-center">'.get_bloginfo("description").'</span>';
									} else {
										if( $blogBox_option['bB_show_blog_description'] ) echo'<span class="blog-description-center-notitle">'.get_bloginfo("description").'</span>';
									}
								echo '</div>';
							}
						} else {
							if( $blogBox_option['bB_show_social_strip'] ) {
								echo '<div class="header-widget-full">';
									if ( !dynamic_sidebar('Header-Sidebar') ) :
									endif;
								echo '</div>';
							}
							echo '<div class="full-width-header-text">';
								if( $blogBox_option['bB_show_blog_title'] ) {
									echo '<a href="'.get_site_url().'/">';
										echo '<h1 class="blog-title">'.get_bloginfo("name").'</h1>';
									echo '</a>';
								}
								if( $blogBox_option['bB_show_blog_description'] ) echo'<span class="blog-description-center">'.get_bloginfo("description").'</span>';
							echo '</div>';
						} 
					}
			
				
			} ?>

			<div class="clearfix"></div>
			<?php if ( $blogBox_option['bB_menu_border'] == 'full width' ) { ?>
				<div class="thin-border"></div>
				<nav class="nav-container ka-menu">
					<?php blogBox_header_menu() ?>
				</nav>
				<div class="thin-border"></div>
			<?php } else { ?>
				<nav class="nav-container ka-menu">
					<?php blogBox_header_menu() ?>
				</nav>	
			<?php }?>
		</div>