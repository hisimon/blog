<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Catch Themes
 * @subpackage Catch_Box
 * @since Catch Box 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<?php 
/** 
 * catchbox_before hook
 */
do_action( 'catchbox_before' ); ?>

<div id="page" class="hfeed">

	<?php 
    /** 
     * catchbox_before_header hook
     */
    do_action( 'catchbox_before_header' ); 
    ?> 
    
	<header id="branding" role="banner">

    	<?php 
		/** 
		 * catchbox_before_headercontent hook
		 */
		do_action( 'catchbox_before_headercontent' ); ?>
            
    	<div id="header-content" class="clearfix">
        
			<?php 
            /** 
             * catchbox_headercontent hook
             *
             * @hooked catchbox_headerdetails - 10
			 * @hooked catchbox_header_search - 15
             */
			do_action( 'catchbox_headercontent' ); ?>
            
		</div><!-- #header-content -->
        
    	<?php 
		/** 
		 * catchbox_after_headercontent hook
		 *
         * @hooked catchbox_header_menu - 10
		 */
		do_action( 'catchbox_after_headercontent' ); ?>           
                
	</header><!-- #branding -->
    
	<?php 
    /** 
     * catchbox_after_header hook
     */
    do_action( 'catchbox_after_header' ); 
    ?>    

	<?php 
    /** 
     * catchbox_before_main hook
     */
    do_action( 'catchbox_before_main' ); 
    ?>
        
	<div id="main" class="clearfix">

		<?php 
        /** 
		 * catchbox_before_primary hook
		 *
		 */
        do_action( 'catchbox_before_primary' ); ?>
        
		<div id="primary">
        
			<?php 
            /** 
             * catchbox_before_content hook
             *
             */
            do_action( 'catchbox_before_content' ); ?>
        
			<div id="content" role="main">
				<?php 
                /** 
                 * catchbox_content hook
                 *
                 * @hooked catchbox_slider_display - 10
                 */
                do_action( 'catchbox_content' ); ?>