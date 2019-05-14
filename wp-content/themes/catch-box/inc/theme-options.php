<?php
/**
 * Catch Box Theme Options
 *
 * @package Catch Themes
 * @subpackage Catch_Box
 * @since Catch Box 1.0
 */


/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since Catch Box 1.0
 *
 */
function catchbox_admin_enqueue_scripts( $hook_suffix ) {
	wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'catchbox-theme-options', get_template_directory_uri() . '/inc/theme-options.min.css', false, '2011-04-28' );
	wp_enqueue_script( 'catchbox-theme-options', get_template_directory_uri() . '/inc/theme-options.min.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-cookie', 'jquery-ui-sortable', 'jquery-ui-draggable', 'farbtastic' ), '2011-06-10' );
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'catchbox_upload', get_template_directory_uri().'/inc/add_image_scripts.js', array( 'jquery','media-upload','thickbox' ) );
	wp_enqueue_style( 'thickbox' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'catchbox_admin_enqueue_scripts' );

/* 
 * Admin Social Links
 * use facebook and twitter scripts
 */
function catchbox_admin_social() { ?>
<!-- Start Social scripts -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=276203972392824";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!-- End Social scripts -->
<?php
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'catchbox_admin_social' );


/**
 * Register the form setting for our catchbox_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, catchbox_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since Catch Box 1.0
 */
function catchbox_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === catchbox_get_theme_options() )
		add_option( 'catchbox_theme_options', catchbox_get_default_theme_options() );

	register_setting(
		'catchbox_options',       // Options group, see settings_fields() call in catchbox_theme_options_render_page()
		'catchbox_theme_options', // Database option, see catchbox_get_theme_options()
		'catchbox_theme_options_validate' // The sanitization callback, see catchbox_theme_options_validate()
	);
	
	register_setting(
		'catchbox_options_slider',   // Options group, see settings_fields() call in catchbox_theme_options_render_page()
		'catchbox_options_slider',  // Database option, see catchbox_get_theme_options()			
		'catchbox_options_validation' // The sanitization callback, see catchbox_theme_options_validate()
	);
	
	register_setting(
		'catchbox_options_webmaster',   // Options group, see settings_fields() call in catchbox_theme_options_render_page()
		'catchbox_options_webmaster',  // Database option, see catchbox_get_theme_options()			
		'catchbox_options_webmaster_validation' // The sanitization callback, see catchbox_theme_options_validate()
	);
	
	register_setting(
		'catchbox_options_social_links',   // Options group, see settings_fields() call in catchbox_theme_options_render_page()
		'catchbox_options_social_links',  // Database option, see catchbox_get_theme_options()			
		'catchbox_options_social_links_validation' // The sanitization callback, see catchbox_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
	);
	
	// Register our individual settings fields
	add_settings_field(
		'favicon', // Unique identifier for the field for this section
		__( 'Favicon URL', 'catchbox' ), // Setting field label
		'catchbox_settings_field_favicon', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);	
	
	// Register our individual settings fields
	add_settings_field(
		'webclip', // Unique identifier for the field for this section
		__( 'Web Clip Icon URL', 'catchbox' ), // Setting field label
		'catchbox_settings_field_webclip', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);		

	// Register our individual settings fields
	add_settings_field(
		'color_scheme', // Unique identifier for the field for this section
		__( 'Color Scheme', 'catchbox' ), // Setting field label
		'catchbox_settings_field_color_scheme', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 
		'link_color', // Unique identifier for the field for this section 
		__( 'Link Color', 'catchbox' ), // Setting field label 
		'catchbox_settings_field_link_color', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	add_settings_field( 
		'layout', // Unique identifier for the field for this section 
		__( 'Default Layout', 'catchbox' ), // Setting field label 
		'catchbox_settings_field_layout', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above 
	);

	add_settings_field(
		'content_layout', // Unique identifier for the settings section
		__( 'Content layout', 'catchbox' ), // Setting field label
		'catchbox_settings_field_content_scheme', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	add_settings_field(
		'excerpt_length', // Unique identifier for the settings section
		__( 'Excerpt Length in Words', 'catchbox' ), // Setting field label
		'catchbox_settings_field_excerpt_length', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	add_settings_field(
		'feed_redirect', // Unique identifier for the settings section
		__( 'Feed Redirect URL', 'catchbox' ), // Setting field label
		'catchbox_settings_field_feed_redirect', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	add_settings_field(
		'site_title_above', // Unique identifier for the settings section
		__( 'Move Site Title and Tagline?', 'catchbox' ), // Setting field label
		'catchbox_settings_field_site_title_above', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);	
	
	add_settings_field(
		'search_text', // Unique identifier for the settings section
		__( 'Default Display Text in Search', 'catchbox' ), // Setting field label
		'catchbox_settings_field_search_text', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);	
	
	add_settings_field(
		'disable_header_search', // Unique identifier for the settings section
		__( 'Disable Search in Header?', 'catchbox' ), // Setting field label
		'catchbox_settings_field_disable_header_search', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);	
	
	add_settings_field(
		'enable_menus', // Unique identifier for the settings section
		__( 'Enable Secondary & Footer Menu in Mobile Devices?', 'catchbox' ), // Setting field label
		'catchbox_settings_field_enable_menus', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);		
	
	add_settings_field(
		'custom_css', // Unique identifier for the settings section
		__( 'Custom CSS Styles', 'catchbox' ), // Setting field label
		'catchbox_settings_field_custom_css', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see catchbox_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
}
add_action( 'admin_init', 'catchbox_theme_options_init' );

/**
 * Change the capability required to save the 'catchbox_options' options group.
 *
 * @see catchbox_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see catchbox_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * By default, the options groups for all registered settings require the manage_options capability.
 * This filter is required to change our theme options page to edit_theme_options instead.
 * By default, only administrators have either of these capabilities, but the desire here is
 * to allow for finer-grained control for roles and users.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function catchbox_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_catchbox_options', 'catchbox_option_page_capability' );


/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Catch Box 1.0
 */
function catchbox_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'catchbox' ),   	// Name of page
		__( 'Theme Options', 'catchbox' ),   	// Label in menu
		'edit_theme_options',              		// Capability required
		'theme_options',                  		// Menu slug, used to uniquely identify the page
		'catchbox_theme_options_render_page' 	// Function that renders the options page
	);
	
	if ( ! $theme_page )
		return;

}
add_action( 'admin_menu', 'catchbox_theme_options_add_page' );


/**
 * Renders the favicon url setting field.
 *
 * @since Catch Box 1.6
 */
function catchbox_settings_field_favicon() {
	$options = catchbox_get_theme_options();
	?>
	<input class="upload-url" type="text" name="catchbox_theme_options[fav_icon]" id="fav-icon" size="65" value="<?php if ( isset( $options[ 'fav_icon' ] ) ) echo esc_attr( $options[ 'fav_icon'] ); ?>" />
    <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Add/Change Favicon','catchbox' );?>" />
	<?php
}


/**
 * Renders the favicon url setting field.
 *
 * @since Catch Box 2.0.3
 */
function catchbox_settings_field_webclip() {
	$options = catchbox_get_theme_options();
	?>
	<input class="upload-url" type="text" name="catchbox_theme_options[web_clip]" id="web-clip" size="65" value="<?php if ( isset( $options[ 'web_clip' ] ) ) echo esc_attr( $options[ 'web_clip'] ); ?>" />
    <input id="st_upload_button" class="st_upload_button button" name="wsl-image-add" type="button" value="<?php esc_attr_e( 'Add/Change Web Clip Icon','catchbox' );?>" />
	<?php
}


/**
 * Returns an array of color schemes registered for Catch Box.
 *
 * @since Catch Box 1.0
 */
function catchbox_color_schemes() {
	$color_scheme_options = array(
		'light' 					=> array(
			'value'					=> 'light',
			'label'					=> __( 'Light', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/light.png',
			'default_link_color'	=> '#1b8be0',
		),
		'dark' 						=> array(
			'value'					=> 'dark',
			'label'					=> __( 'Dark', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/dark.png',
			'default_link_color'	=> '#e4741f',
		),	
		'blue' 						=> array(
			'value'					=> 'blue',
			'label'					=> __( 'Blue', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/blue.png',
			'default_link_color'	=> '#326693',
		),	
		'green' 						=> array(
			'value'					=> 'green',
			'label'					=> __( 'Green', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/green.png',
			'default_link_color'	=> '#3e6107',
		),
		'red' 						=> array(
			'value'					=> 'red',
			'label'					=> __( 'Red', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/red.png',
			'default_link_color'	=> '#a6201d',
		),
		'brown' 					=> array(
			'value'					=> 'brown',
			'label'					=> __( 'Brown', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/brown.png',
			'default_link_color'	=> '#5e3929',
		),
		'orange' 					=> array(
			'value'					=> 'orange',
			'label'					=> __( 'Orange', 'catchbox' ),
			'thumbnail'				=> get_template_directory_uri() . '/inc/images/orange.png',
			'default_link_color'	=> '#802602',   
		)			
	);

	return apply_filters( 'catchbox_color_schemes', $color_scheme_options );
}


/**
 * Returns an array of layout options registered for Catch Box.
 *
 * @since Catch Box 1.0
 */
function catchbox_layouts() {
	$layout_options = array(
		'content-sidebar' 	=> array(
			'value' 		=> 'content-sidebar',
			'label'			=> __( 'Content on left', 'catchbox' ),
			'thumbnail'		=> get_template_directory_uri() . '/inc/images/content-sidebar.png',
		),
		'sidebar-content' 	=> array(
			'value'			=> 'sidebar-content',
			'label'			=> __( 'Content on right', 'catchbox' ),
			'thumbnail'		=> get_template_directory_uri() . '/inc/images/sidebar-content.png',
		),
		'content-onecolumn'	=> array(
			'value'			=> 'content-onecolumn',
			'label'			=> __( 'One-column, no sidebar', 'catchbox' ),
			'thumbnail'		=> get_template_directory_uri() . '/inc/images/content.png',
		)	
	);

	return apply_filters( 'catchbox_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for Catch Box.
 *
 * @since Catch Box 1.0
 */
function catchbox_content_layout() {
	$content_options = array(
		'excerpt'			=> array(
			'value'			=> 'excerpt',
			'label'			=> __( 'Show excerpt', 'catchbox' ),
			'thumbnail'		=> get_template_directory_uri() . '/inc/images/excerpt.png',
		),	 
		'full-content'		=> array(
			'value'			=> 'full-content',
			'label'			=> __( 'Show full content', 'catchbox' ),
			'thumbnail'		=> get_template_directory_uri() . '/inc/images/full-content.png',
		)
	);

	return apply_filters( 'catchbox_content_layouts', $content_options );
}


/**
 * Returns the default options for Catch Box.
 *
 * @since Catch Box 1.0
 */
function catchbox_get_default_theme_options() {
	$default_theme_options = array(
		'excerpt_length'		=> 40,
		'color_scheme'			=> 'light',
		'link_color'			=> catchbox_get_default_link_color( 'light' ),
		'theme_layout'			=> 'content-sidebar',
		'content_layout'		=> 'excerpt',
		'site_title_above'		=> '0',
		'disable_header_search' => '0',
		'enable_menus' 			=> '0',
		'search_display_text'	=> 'Search'
	);

	if ( is_rtl() )
 		$default_theme_options['theme_layout'] = 'sidebar-content';

	return apply_filters( 'catchbox_default_theme_options', $default_theme_options );
}


/**
 * Returns the default link color for Catch Box, based on color scheme.
 *
 * @since Catch Box 1.0
 *
 * @param $string $color_scheme Color scheme. Defaults to the active color scheme.
 * @return $string Color.
*/
function catchbox_get_default_link_color( $color_scheme = null ) {
	if ( null === $color_scheme ) {
		$options = catchbox_get_theme_options();
		$color_scheme = $options['color_scheme'];
	}

	$color_schemes = catchbox_color_schemes();
	if ( ! isset( $color_schemes[ $color_scheme ] ) )
		return false;

	return $color_schemes[ $color_scheme ]['default_link_color'];
}


/**
 * Returns the options array for Catch Box.
 *
 * @since Catch Box 1.0
 */
function catchbox_get_theme_options() {
	return get_option( 'catchbox_theme_options', catchbox_get_default_theme_options() );
}


/**
 * Renders the Color Scheme setting field.
 *
 * @since Catch Box 1.0
 */
function catchbox_settings_field_color_scheme() {
	$options = catchbox_get_theme_options();

	foreach ( catchbox_color_schemes() as $scheme ) {
	?>
        <div class="layout image-radio-option color-scheme">
        <label class="description">
            <input type="radio" name="catchbox_theme_options[color_scheme]" value="<?php echo esc_attr( $scheme['value'] ); ?>" <?php checked( $options['color_scheme'], $scheme['value'] ); ?> />
            <input type="hidden" id="default-color-<?php echo esc_attr( $scheme['value'] ); ?>" value="<?php echo esc_attr( $scheme['default_link_color'] ); ?>" />
            <span>
                <img src="<?php echo esc_url( $scheme['thumbnail'] ); ?>" width="164" height="122" alt="" />
                <?php echo $scheme['label']; ?>
            </span>
        </label>
        </div>
	<?php
	}
}


/**
 * Renders the Link Color setting field.
 *
 * @since Catch Box 1.0
 */
function catchbox_settings_field_link_color() {
	$options = catchbox_get_theme_options();
	?>
	<input type="text" name="catchbox_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
	<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
	<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'catchbox' ); ?>" />
	<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
	<br />
	<span><?php printf( __( 'Default color: %s', 'catchbox' ), '<span id="default-color">' . catchbox_get_default_link_color( $options['color_scheme'] ) . '</span>' ); ?></span>
	<?php
}


/**
 * Renders the excerpt length setting field.
 *
 * @since Catch Box 1.1.3
 */
function catchbox_settings_field_excerpt_length() {
	$options = catchbox_get_theme_options();
	if( empty( $options['excerpt_length'] ) )
		$options = catchbox_get_default_theme_options();
	?>
   
	<input type="text" name="catchbox_theme_options[excerpt_length]" id="excerpt-length" size="3" value="<?php if ( isset( $options[ 'excerpt_length' ] ) ) echo absint( $options[ 'excerpt_length'] ); ?>" /> <?php _e( 'Words', 'catchbox' ); ?>
	<?php
}


/**
 * Renders the feed redirect setting field.
 *
 * @since Catch Box 1.0
 */
function catchbox_settings_field_feed_redirect() {
	$options = catchbox_get_theme_options();
	?>
	<input type="text" name="catchbox_theme_options[feed_url]" id="feed-url" size="65" value="<?php if ( isset( $options[ 'feed_url' ] ) ) echo esc_attr( $options[ 'feed_url'] ); ?>" />
	<?php
}


/**
 * Move Site Title and Tagline above Header Image Checkbox
 *
 * @since Catch Box 2.5
 */
function catchbox_settings_field_site_title_above() {
	$options = catchbox_get_theme_options();
	if( empty( $options['site_title_above'] ) )
		$options = catchbox_get_default_theme_options();
	?>
    <input type="checkbox" id="disable-header-search" name="catchbox_theme_options[site_title_above]" value="1" <?php checked( '1', $options['site_title_above'] ); ?> /> <?php _e( 'Check to move above the Header/Logo Image', 'catchbox' ); ?>
	<?php
}


/**
 * Search Text 
 *
 * @since Catch Box 2.8.1
 */
function catchbox_settings_field_search_text() {
	$options = catchbox_get_theme_options();
	if( empty( $options['search_display_text'] ) )
		$options = catchbox_get_default_theme_options();	
	?>
    <input type="text" size="45" name="catchbox_theme_options[search_display_text]" value="<?php if ( isset( $options[ 'search_display_text' ] ) ) echo esc_attr( $options[ 'search_display_text' ] ); ?>" />
	<?php
}


/**
 * Disable Header Search Checkbox
 *
 * @since Catch Box 1.3.1
 */
function catchbox_settings_field_disable_header_search() {
	$options = catchbox_get_theme_options();
	if( empty( $options['disable_header_search'] ) )
		$options = catchbox_get_default_theme_options();
	?>
    <input type="checkbox" id="disable-header-search" name="catchbox_theme_options[disable_header_search]" value="1" <?php checked( '1', $options['disable_header_search'] ); ?> /> <?php _e( 'Check to Disable', 'catchbox' ); ?>
	<?php
}


/**
 * Enable Secondary and Footer Menu
 *
 * @since Catch Box 2.2.2
 */
function catchbox_settings_field_enable_menus() {
	$options = catchbox_get_theme_options();
	if( empty( $options['enable_menus'] ) )
		$options = catchbox_get_default_theme_options();
	?>
    <input type="checkbox" id="disable-header-search" name="catchbox_theme_options[enable_menus]" value="1" <?php checked( '1', $options['enable_menus'] ); ?> /> <?php _e( 'Check to Enable', 'catchbox' ); ?>
	<?php
}


/**
 * Renders the Custom CSS styles setting fields
 *
 * @since Catch Box 1.0
 */
function catchbox_settings_field_custom_css() {
	$options = catchbox_get_theme_options();
	?>
     <textarea id="custom-css" cols="90" rows="12" name="catchbox_theme_options[custom_css]"><?php if (!empty($options['custom_css'] ) )echo esc_attr($options['custom_css']); ?></textarea> <br />
     <?php _e('CSS Tutorial from W3Schools.', 'catchbox'); ?> <a class="button" href="<?php echo esc_url( __( 'http://www.w3schools.com/css/default.asp','catchbox' ) ); ?>" title="<?php esc_attr_e( 'CSS Tutorial', 'catchbox' ); ?>" target="_blank"><?php _e( 'Click Here to Read', 'catchbox' );?></a>

	<?php
}


/**
 * Renders the Layout setting field.
 *
 * @since Catch Box 1.0
 */
function catchbox_settings_field_layout() {
	$options = catchbox_get_theme_options();
	foreach ( catchbox_layouts() as $layout ) {
		?>
		<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="catchbox_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
			<span>
				<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
				<?php echo $layout['label']; ?>
			</span>
		</label>
		</div>
		<?php
	}
}


/**
 * Renders the Content layout setting fields.
 *
 * @since Catch Box 1.0 
 */
function catchbox_settings_field_content_scheme() {
	$options = catchbox_get_theme_options();
	foreach ( catchbox_content_layout() as $content ) {
		?>
		<div class="layout image-radio-option theme-layout">
            <label class="description">
                <input type="radio" name="catchbox_theme_options[content_layout]" value="<?php echo esc_attr( $content['value'] ); ?>" <?php checked( $options['content_layout'], $content['value'] ); ?> />
                <span>
                	<img src="<?php echo esc_url( $content['thumbnail'] ); ?>" width="164" height="163" alt="" />
                	<?php echo $content['label']; ?>
            	</span>
			</label>
		</div>
		<?php
	}
}


/**
 * Returns the options array for Catch Box.
 *
 * @since Catch Box 1.0
 */
function catchbox_theme_options_render_page() {
	?>
	<div id="catchthemes" class="wrap">
    
			<div id="theme-option-header">
            	<div id="theme-social">
                	<ul>
            			<li class="widget-fb">
                            <div data-show-faces="false" data-width="80" data-layout="button_count" data-send="false" data-href="<?php echo esc_url(__('http://facebook.com/catchthemes','catchbox')); ?>" class="fb-like"></div></li>
                     	<li class="widget-tw">
                            <a data-dnt="true" data-show-screen-name="true" data-show-count="true" class="twitter-follow-button" href="<?php echo esc_url(__('https://twitter.com/catchthemes','catchbox')); ?>">Follow @catchthemes</a>
            			</li>
                   	</ul>
               	</div><!-- #theme-social -->
            
                <div id="theme-option-title">
                    <h2 class="title"><?php _e( 'Theme Options By', 'catchbox' ); ?></h2>
                    <h2 class="logo">
                        <a href="<?php echo esc_url( __( 'http://catchthemes.com/', 'catchbox' ) ); ?>" title="<?php esc_attr_e( 'Catch Themes', 'catchbox' ); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri().'/inc/images/catch-themes.png'; ?>" alt="<?php _e( 'Catch Themes', 'catchbox' ); ?>" />
                        </a>
                    </h2>
                </div><!-- #theme-option-title -->
                
                <div id="upgradepro">
                	<a class="button" href="<?php echo esc_url(__('http://catchthemes.com/themes/catch-box-pro/','catchbox')); ?>" title="<?php esc_attr_e('Upgrade to Catch Box Pro', 'catchbox'); ?>" target="_blank"><?php printf(__('Upgrade to Catch Box Pro','catchbox')); ?></a>
               	</div><!-- #upgradepro -->
            
                <div id="theme-support">
                    <ul>
                    	<li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/donate/','catchbox')); ?>" title="<?php esc_attr_e('Donate', 'catchbox'); ?>" target="_blank"><?php printf(__('Donate','catchbox')); ?></a></li>
                    	<li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/support/','catchbox')); ?>" title="<?php esc_attr_e('Support', 'catchbox'); ?>" target="_blank"><?php printf(__('Support','catchbox')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/support-forum/forum/catch-box-public/','catchbox')); ?>" title="<?php esc_attr_e('Support Forum', 'catchbox'); ?>" target="_blank"><?php printf(__('Support Forum','catchbox')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://catchthemes.com/theme-instructions/catch-box/','catchbox')); ?>" title="<?php esc_attr_e('Theme Instructions', 'catchbox'); ?>" target="_blank"><?php printf(__('Theme Instructions','catchbox')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://www.facebook.com/catchthemes/','catchbox')); ?>" title="<?php esc_attr_e('Like Catch Themes on Facebook', 'catchbox'); ?>" target="_blank"><?php printf(__('Facebook','catchbox')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('https://twitter.com/catchthemes/','catchbox')); ?>" title="<?php esc_attr_e('Follow Catch Themes on Twitter', 'catchbox'); ?>" target="_blank"><?php printf(__('Twitter','catchbox')); ?></a></li>
                        <li><a class="button" href="<?php echo esc_url(__('http://wordpress.org/support/view/theme-reviews/catch-box/','catchbox')); ?>" title="<?php esc_attr_e('Rate us 5 Star on WordPress', 'catchbox'); ?>" target="_blank"><?php printf(__('5 Star Rating','catchbox')); ?></a></li>
                   	</ul>
                </div><!-- #theme-support --> 
                 
          	</div><!-- #theme-option-header -->  

		
            <div id="catchbox_ad_tabs">
                <ul class="tabNavigation" id="mainNav">
                    <li><a href="#themeoptions"><?php _e( 'Theme Options', 'catchbox' );?></a></li>
                    <li><a href="#slidersettings"><?php _e( 'Featured Post Slider', 'catchbox' );?></a></li>
                    <li><a href="#sociallinks"><?php _e( 'Social Links', 'catchbox' );?></a></li>
                    <li><a href="#webmaster"><?php _e( 'Webmaster Tools', 'catchbox' );?></a></li>
                </ul><!-- .tabsNavigation #mainNav -->        
                
                <!-- Option for Theme Options -->
                <div id="themeoptions">
                	<div class="option-container"> 
                        <form method="post" action="options.php">
                            <?php
                                settings_fields( 'catchbox_options' );
                                do_settings_sections( 'theme_options' );
                                submit_button();
                            ?>
                        </form>
                  	</div><!-- .option-container -->
             	</div> <!-- #themeoptions --> 
                
                <!-- Option for Featured Post Slider -->
                <div id="slidersettings">
               		<form method="post" action="options.php">
						<?php
                            settings_fields( 'catchbox_options_slider' );
                            $options = get_option( 'catchbox_options_slider' );
                            
                            if( is_array( $options ) && ( !array_key_exists( 'slider_qty', $options ) || !is_numeric( $options[ 'slider_qty' ] ) ) ) $options[ 'slider_qty' ] = 4;
                            elseif( !is_array( $options ) ) $options = array( 'slider_qty' => 4);                          
                        ?>   
                        <div class="option-container">
                            <h3 class="option-toggle"><a href="#"><?php _e( 'Slider Options', 'catchbox' ); ?></a></h3>
                            <div class="option-content inside">
                                <table class="form-table">               
                                    <tr>                            
                                        <th scope="row"><?php _e( 'Exclude Slider post from Home page posts:', 'catchbox' ); ?></th>
                                        <input type='hidden' value='0' name='catchbox_options_slider[exclude_slider_post]'>
                                        <td><input type="checkbox" id="headerlogo" name="catchbox_options_slider[exclude_slider_post]" value="1" <?php isset($options['exclude_slider_post']) ? checked( '1', $options['exclude_slider_post'] ) : checked('0', '1'); ?> /> <?php _e( 'Check to disable', 'catchbox' ); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php _e( 'Number of Slides', 'catchbox' ); ?></th>
                                        <td><input type="text" name="catchbox_options_slider[slider_qty]" value="<?php if ( array_key_exists ( 'slider_qty', $options ) ) echo intval( $options[ 'slider_qty' ] ); ?>" /></td>
                                    </tr>
                                    <tbody class="sortable">
                                        <?php for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ): ?>
                                        <tr>
                                            <th scope="row"><label class="handle"><span class="count"><?php echo '#' . absint( $i ); ?></span> <?php _e( 'Featured Post ID', 'catchbox' ); ?></label></th>
                                            <td><input type="text" name="catchbox_options_slider[featured_slider][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_slider', $options ) && array_key_exists( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>" />
                                            <a href="<?php bloginfo ( 'url' );?>/wp-admin/post.php?post=<?php if( array_key_exists ( 'featured_slider', $options ) && array_key_exists ( $i, $options[ 'featured_slider' ] ) ) echo absint( $options[ 'featured_slider' ][ $i ] ); ?>&action=edit" class="button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank"><?php _e( 'Click Here To Edit', 'catchbox' ); ?></a>
                                            </td>
                                        </tr> 							
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                                <p><?php _e( '<strong>Note</strong>: Here you add in Post IDs which displays on Homepage Featured Slider.', 'catchbox' ); ?> </p>
                                <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'catchbox' ); ?>" /></p> 
                            </div><!-- .option-content -->
                        </div><!-- .option-container -->   
                        <div class="option-container">
                            <h3 class="option-toggle"><a href="#"><?php _e( 'Slider Effect Options', 'catchbox' ); ?></a></h3>
                            <div class="option-content inside">
                                <table class="form-table">   
                                    <tr>
                                        <th>
                                        <label for="catchbox_cycle_style"><?php _e( 'Transition Effect:', 'catchbox' ); ?></label>
                                        </th>
                                        <?php if( empty( $options['transition_effect'] ) ) { $options['transition_effect'] = "fade"; } ?>
                                        <td>
                                            <select id="catchbox_cycle_style" name="catchbox_options_slider[transition_effect]">
                                                <option value="fade" <?php selected('fade', $options['transition_effect']); ?>><?php _e( 'fade', 'catchbox' ); ?></option>
                                                <option value="wipe" <?php selected('wipe', $options['transition_effect']); ?>><?php _e( 'wipe', 'catchbox' ); ?></option>
                                                <option value="scrollUp" <?php selected('scrollUp', $options['transition_effect']); ?>><?php _e( 'scrollUp', 'catchbox' ); ?></option>
                                                <option value="scrollDown" <?php selected('scrollDown', $options['transition_effect']); ?>><?php _e( 'scrollDown', 'catchbox' ); ?></option>
                                                <option value="scrollLeft" <?php selected('scrollLeft', $options['transition_effect']); ?>><?php _e( 'scrollLeft', 'catchbox' ); ?></option>
                                                <option value="scrollRight" <?php selected('scrollRight', $options['transition_effect']); ?>><?php _e( 'scrollRight', 'catchbox' ); ?></option>
                                                <option value="blindX" <?php selected('blindX', $options['transition_effect']); ?>><?php _e( 'blindX', 'catchbox' ); ?></option>
                                                <option value="blindY" <?php selected('blindY', $options['transition_effect']); ?>><?php _e( 'blindY', 'catchbox' ); ?></option>
                                                <option value="blindZ" <?php selected('blindZ', $options['transition_effect']); ?>><?php _e( 'blindZ', 'catchbox' ); ?></option>
                                                <option value="cover" <?php selected('cover', $options['transition_effect']); ?>><?php _e( 'cover', 'catchbox' ); ?></option>
                                                <option value="shuffle" <?php selected('shuffle', $options['transition_effect']); ?>><?php _e( 'shuffle', 'catchbox' ); ?></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php if( empty( $options['transition_delay'] ) ) { $options['transition_delay'] = 4; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Transition Delay', 'catchbox' ); ?></th>
                                        <td>
                                            <input type="text" name="catchbox_options_slider[transition_delay]" value="<?php if( isset( $options [ 'transition_delay' ] ) ) echo $options[ 'transition_delay' ]; ?>" size="4" />
                                       <span class="description"><?php _e( 'second(s)', 'catchbox' ); ?></span>
                                        </td>
                                    </tr>
                    
                                    <?php if( empty( $options['transition_duration'] ) ) { $options['transition_duration'] = 1; } ?>
                                    <tr>
                                        <th scope="row"><?php _e( 'Transition Length', 'catchbox' ); ?></th>
                                        <td>
                                            <input type="text" name="catchbox_options_slider[transition_duration]" value="<?php if( isset( $options [ 'transition_duration' ] ) ) echo $options[ 'transition_duration' ]; ?>" size="4" />
                                        <span class="description"><?php _e( 'second(s)', 'catchbox' ); ?></span>
                                        </td>
                                    </tr>                      
                                </table> 
                                <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'catchbox' ); ?>" /></p> 
                            </div><!-- .option-content -->
                        </div><!-- .option-container -->       
                    </form>
                
                </div> <!-- #slidersettings --> 
                
                <!-- Option for Social Links -->
                <div id="sociallinks"> 
                	<div class="option-container">               
                        <form method="post" action="options.php">
                            <?php
                                settings_fields( 'catchbox_options_social_links' );
                                $options = get_option( 'catchbox_options_social_links' );           
                            ?>
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Facebook', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_facebook]" value="<?php if( isset( $options[ 'social_facebook' ] ) ) echo esc_url( $options[ 'social_facebook' ] ); ?>" />
                                        </td>
                                    </tr>
                                    <tr> 
                                        <th scope="row"><label><?php _e( 'Twitter', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_twitter]" value="<?php if ( isset( $options[ 'social_twitter' ] ) ) echo esc_url( $options[ 'social_twitter'] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Google +', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_google]" value="<?php if ( isset( $options[ 'social_google' ] ) ) echo esc_url( $options[ 'social_google' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                        <th scope="row"><label><?php _e( 'LinkedIn', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_linkedin]" value="<?php if ( isset( $options[ 'social_linkedin' ] ) ) echo esc_url( $options[ 'social_linkedin' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                        <th scope="row"><label><?php _e( 'Pinterest', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_pinterest]" value="<?php if ( isset( $options[ 'social_pinterest' ] ) ) echo esc_url( $options[ 'social_pinterest' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Youtube', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_youtube]" value="<?php if ( isset( $options[ 'social_youtube' ] ) ) echo esc_url( $options[ 'social_youtube' ] ); ?>" />
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th scope="row"><label><?php _e( 'RSS Feed', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_rss]" value="<?php if ( isset( $options[ 'social_rss' ] ) ) echo esc_url( $options[ 'social_rss' ] ); ?>" />
                                        </td>
                                    </tr>
                
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Deviantart', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_deviantart]" value="<?php if ( isset( $options[ 'social_deviantart' ] ) ) echo esc_url( $options[ 'social_deviantart' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Tumblr', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_tumblr]" value="<?php if ( isset( $options[ 'social_tumblr' ] ) ) echo esc_url( $options[ 'social_tumblr' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Vimeo', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_viemo]" value="<?php if ( isset( $options[ 'social_viemo' ] ) ) echo esc_url( $options[ 'social_viemo' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Dribbble', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_dribbble]" value="<?php if ( isset( $options[ 'social_dribbble' ] ) ) echo esc_url( $options[ 'social_dribbble' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'MySpace', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_myspace]" value="<?php if ( isset( $options[ 'social_myspace' ] ) ) echo esc_url( $options[ 'social_myspace' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Aim', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_aim]" value="<?php if ( isset( $options[ 'social_aim' ] ) ) echo esc_url( $options[ 'social_aim' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Flickr', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_flickr]" value="<?php if ( isset( $options[ 'social_flickr' ] ) ) echo esc_url( $options[ 'social_flickr' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Slideshare', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_slideshare]" value="<?php if ( isset( $options[ 'social_slideshare' ] ) ) echo esc_url( $options[ 'social_slideshare' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Instagram', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_instagram]" value="<?php if ( isset( $options[ 'social_instagram' ] ) ) echo esc_url( $options[ 'social_instagram' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Skype', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_skype]" value="<?php if ( isset( $options[ 'social_skype' ] ) ) echo esc_attr( $options[ 'social_skype' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row"><label><?php _e( 'Soundcloud', 'catchbox' ); ?></label></th>
                                        <td><input type="text" size="45" name="catchbox_options_social_links[social_soundcloud]" value="<?php if ( isset( $options[ 'social_soundcloud' ] ) ) echo esc_url( $options[ 'social_soundcloud' ] ); ?>" />
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <p><?php _e( '<strong>Note:</strong> Enter the url for correponding social networking website', 'catchbox' ); ?></p>
                            <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'catchbox' ); ?>" /></p> 
                    	</form> 
                  	</div><!-- .option-container -->
                </div> <!-- #sociallinks --> 
                
                <!-- Option for Webmaster Tools -->
                <div id="webmaster">                
                    <form method="post" action="options.php">
                        <?php
                            settings_fields( 'catchbox_options_webmaster' );
                            $options = get_option( 'catchbox_options_webmaster' );
                                    
                        ?>   
                        <div class="option-container">
                            <h3 class="option-toggle"><a href="#"><?php _e( 'Header and Footer Code', 'catchbox' ); ?></a></h3>
                           <div class="option-content inside">
                                <table class="form-table">
                                    <table class="form-table">
                                        <tr>
                                            <th scope="row"><label><?php _e('Code to display on Header', 'catchbox' ); ?></label></th>
                                            <td>
                                             <textarea name="catchbox_options_webmaster[tracker_header]" rows="7" cols="80" ><?php if ( isset( $options [ 'tracker_header' ] ) )  echo esc_attr( $options[ 'tracker_header' ] ); ?></textarea>
                                 
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td></td><td><?php _e('Note: Here you can put scripts from Google, Facebook etc. which will load on Header', 'catchbox' ); ?></td>
                                    	</tr>
                                        
                                        <tr>
                                            <th scope="row"><label><?php _e('Code to display on Footer', 'catchbox' ); ?></label></th>
                                            <td>
                                             <textarea name="catchbox_options_webmaster[tracker_footer]" rows="7" cols="80" ><?php if ( isset( $options [ 'tracker_footer' ] ) )  echo esc_attr( $options[ 'tracker_footer' ] ); ?></textarea>
                                 
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td></td><td><?php _e( 'Note: Here you can put scripts from Google, Facebook, Add This etc. which will load on footer', 'catchbox' ); ?></td>
                                   	 	</tr>
                                    </tbody>
                                </table>
                                <p class="submit"><input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save', 'catchbox' ); ?>" /></p> 
                            </div> <!-- .option-content  -->
                        </div> <!-- .option-container  -->
                    </form>   
                </div> <!-- #webmaster --> 
                
       		</div><!-- #catchbox_ad_tabs -->
            
		
	</div>
	<?php
}


/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @since Catch Box 1.0
 */
function catchbox_options_validation($options) {
	$options_validated = array();
	//data validation for Featured Slider
	if ( isset( $options[ 'slider_qty' ] ) ) {
		$options_validated[ 'slider_qty' ] = absint( $options[ 'slider_qty' ] ) ? $options [ 'slider_qty' ] : 4;
	}
	if ( isset( $options[ 'featured_slider' ] ) ) {
		$options_validated[ 'featured_slider' ] = array();
	}
		
 	if( isset( $options[ 'slider_qty' ] ) )	
	for ( $i = 1; $i <= $options [ 'slider_qty' ]; $i++ ) {
		if ( absint( $options[ 'featured_slider' ][ $i ] ) ) 
			$options_validated[ 'featured_slider' ][ $i ] = absint($options[ 'featured_slider' ][ $i ] );
	}
	if ( isset( $options['exclude_slider_post'] ) ) {
        // Our checkbox value is either 0 or 1 
   		$options_validated[ 'exclude_slider_post' ] = $options[ 'exclude_slider_post' ];	
	
    }

    if( !empty( $options[ 'transition_effect' ] ) ) {
        $options_validated['transition_effect'] = wp_filter_nohtml_kses( $options['transition_effect'] );
    }

    // data validation for transition delay
    if ( !empty( $options[ 'transition_delay' ] ) && is_numeric( $options[ 'transition_delay' ] ) ) {
        $options_validated[ 'transition_delay' ] = $options[ 'transition_delay' ];
    }

    // data validation for transition length
    if ( !empty( $options[ 'transition_duration' ] ) && is_numeric( $options[ 'transition_duration' ] ) ) {
        $options_validated[ 'transition_duration' ] = $options[ 'transition_duration' ];
    }
	//Clearing the theme option cache
	if( function_exists( 'catchbox_themeoption_invalidate_caches' ) )  { catchbox_themeoption_invalidate_caches(); }
	
	return $options_validated;
}


/**
 * Sanitize and validate forms for webmaster tools options. Accepts an array, return a sanitized array.
 *
 * @since Catch Box 1.0
 */
function catchbox_options_webmaster_validation( $options ) {
	$options_validated = array();
	
	// data validation for verification id
	if( isset( $options[ 'google_verification' ] ) ) {
		$options_validated[ 'google_verification' ] = wp_filter_post_kses( $options[ 'google_verification' ] );
	}
	if( isset( $options[ 'yahoo_verification' ] ) )
		$options_validated[ 'yahoo_verification' ] = wp_filter_post_kses( $options[ 'yahoo_verification' ] );
	if( isset( $options[ 'bing_verification' ] ) )
		$options_validated[ 'bing_verification' ] = wp_filter_post_kses( $options[ 'bing_verification' ] );
		
	// data validation for tracking code
	if( isset( $options[ 'tracker_header' ] ) )
		$options_validated[ 'tracker_header' ] = wp_kses_stripslashes( $options[ 'tracker_header' ] );
	if( isset( $options[ 'tracker_footer' ] ) )
		$options_validated[ 'tracker_footer' ] = wp_kses_stripslashes( $options[ 'tracker_footer' ] );
	
	return $options_validated;
}


/**
 * Sanitize and validate social links options form. Accepts an array, return a sanitized array.
 *
 * @since Catch Box 1.0
 */
function catchbox_options_social_links_validation( $options ) {
	$options_validated = array();
	
	// data validation for Sociallinks
	//Facebook
	if( isset( $options[ 'social_facebook' ] ) )
		$options_validated[ 'social_facebook' ] = esc_url_raw( $options[ 'social_facebook' ] );
	//Twitter	
	if( isset( $options[ 'social_twitter' ] ) )
		$options_validated[ 'social_twitter' ] = esc_url_raw( $options[ 'social_twitter' ] );
	//Youtube	
	if( isset( $options[ 'social_youtube' ] ) )
		$options_validated[ 'social_youtube' ] = esc_url_raw( $options[ 'social_youtube' ] );
	//Google+
	if( isset( $options[ 'social_google' ] ) )
		$options_validated[ 'social_google' ] = esc_url_raw( $options[ 'social_google' ] );
	//RSS
	if( isset( $options[ 'social_rss' ] ) )
		$options_validated[ 'social_rss' ] = esc_url_raw( $options[ 'social_rss' ] );
	//Linkedin
	if( isset( $options[ 'social_linkedin' ] ) )
		$options_validated[ 'social_linkedin' ] = esc_url_raw( $options[ 'social_linkedin' ] );
	//Pinterest
	if( isset( $options[ 'social_pinterest' ] ) )
		$options_validated[ 'social_pinterest' ] = esc_url_raw( $options[ 'social_pinterest' ] );
	//Deviantart
	if( isset( $options[ 'social_deviantart' ] ) )
		$options_validated[ 'social_deviantart' ] = esc_url_raw( $options[ 'social_deviantart' ] );
	//Tumblr
	if( isset( $options[ 'social_tumblr' ] ) )
		$options_validated[ 'social_tumblr' ] = esc_url_raw( $options[ 'social_tumblr' ] );
	//Viemo
	if( isset( $options[ 'social_viemo' ] ) )
		$options_validated[ 'social_viemo' ] = esc_url_raw( $options[ 'social_viemo' ] );
	//Dribble
	if( isset( $options[ 'social_dribbble' ] ) )
		$options_validated[ 'social_dribbble' ] = esc_url_raw( $options[ 'social_dribbble' ] );
	//Myspace
	if( isset( $options[ 'social_myspace' ] ) )
		$options_validated[ 'social_myspace' ] = esc_url_raw( $options[ 'social_myspace' ] );
	//Aim
	if( isset( $options[ 'social_aim' ] ) )
		$options_validated[ 'social_aim' ] = esc_url_raw( $options[ 'social_aim' ] );
	//Flickr
	if( isset( $options[ 'social_flickr' ] ) )
		$options_validated[ 'social_flickr' ] = esc_url_raw( $options[ 'social_flickr' ] );	
	//Slideshare
	if( isset( $options[ 'social_slideshare' ] ) )
		$options_validated[ 'social_slideshare' ] = esc_url_raw( $options[ 'social_slideshare' ] );
	//Instagram
	if( isset( $options[ 'social_instagram' ] ) )
		$options_validated[ 'social_instagram' ] = esc_url_raw( $options[ 'social_instagram' ] );
	//Skype
	if( isset( $options[ 'social_skype' ] ) )
		$options_validated[ 'social_skype' ] = sanitize_text_field( $options[ 'social_skype' ] );
	//Soundcloud
	if( isset( $options[ 'social_soundcloud' ] ) )
		$options_validated[ 'social_soundcloud' ] = esc_url_raw( $options[ 'social_soundcloud' ] );		
	
	//Clearing the theme option cache
	if( function_exists( 'catchbox_themeoption_invalidate_caches' ) )  { catchbox_themeoption_invalidate_caches(); }
	
	return $options_validated;
}


/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see catchbox_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since Catch Box 1.0
 */
function catchbox_theme_options_validate( $input ) {
	$output = $defaults = catchbox_get_default_theme_options();
	
	// favicon url
	if ( isset( $input['fav_icon'] ) )	
		$output['fav_icon'] = esc_url_raw($input['fav_icon']);	
		
	// web clicp icon url
	if ( isset( $input['web_clip'] ) )	
		$output['web_clip'] = esc_url_raw($input['web_clip']);			

	// Color scheme must be in our array of color scheme options
	if ( isset( $input['color_scheme'] ) && array_key_exists( $input['color_scheme'], catchbox_color_schemes() ) )
		$output['color_scheme'] = $input['color_scheme'];

	// Our defaults for the link color may have changed, based on the color scheme.
	$output['link_color'] = $defaults['link_color'] = catchbox_get_default_link_color( $output['color_scheme'] );

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
		$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], catchbox_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['content_layout'] ) && array_key_exists( $input['content_layout'], catchbox_content_layout() ) )
		$output['content_layout'] = $input['content_layout'];
	
	// excerpt length
	if ( isset( $input['excerpt_length'] ) )	
		$output['excerpt_length'] = absint($input['excerpt_length']);
	
	// feed url
	if ( isset( $input['feed_url'] ) )	
		$output['feed_url'] = esc_url_raw($input['feed_url']);

	// Move Site Title
	if ( isset( $input['site_title_above'] ) )
		// Our checkbox value is either 0 or 1 
		$output[ 'site_title_above' ] = $input[ 'site_title_above' ];
		
	// data validation for Search Settings
	if ( isset( $input[ 'search_display_text' ] ) ) {
        $output[ 'search_display_text' ] = sanitize_text_field( $input[ 'search_display_text' ] );
    }
	
	// Disable Header Search
	if ( isset( $input['disable_header_search'] ) )
		// Our checkbox value is either 0 or 1 
		$output[ 'disable_header_search' ] = $input[ 'disable_header_search' ];
		
	// Enable Seconday and Footer Menu
	if ( isset( $input['enable_menus'] ) )
		// Our checkbox value is either 0 or 1 
		$output[ 'enable_menus' ] = $input[ 'enable_menus' ];		
	
	// Custom CSS 	
	if ( isset( $input['custom_css'] ) )	
		$output['custom_css'] = wp_kses_stripslashes($input['custom_css']);
		
	if( function_exists( 'catchbox_themeoption_invalidate_caches' ) )  { catchbox_themeoption_invalidate_caches(); }
	return apply_filters( 'catchbox_theme_options_validate', $output, $input, $defaults );
}


/**
 * Enqueue the styles for the current color scheme.
 *
 * @since Catch Box 1.0
 */
function catchbox_enqueue_color_scheme() {
	$options = catchbox_get_theme_options();
	$color_scheme = $options['color_scheme'];

	if ( 'dark' == $color_scheme )
		wp_enqueue_style( 'dark', get_template_directory_uri() . '/colors/dark.css', array(), null );
	elseif ( 'blue' == $color_scheme )
		wp_enqueue_style( 'blue', get_template_directory_uri() . '/colors/blue.css', array(), null );
	elseif ( 'green' == $color_scheme )
		wp_enqueue_style( 'green', get_template_directory_uri() . '/colors/green.css', array(), null );	
	elseif ( 'red' == $color_scheme )
		wp_enqueue_style( 'red', get_template_directory_uri() . '/colors/red.css', array(), null );
	elseif ( 'brown' == $color_scheme )
		wp_enqueue_style( 'brown', get_template_directory_uri() . '/colors/brown.css', array(), null );	
	elseif ( 'orange' == $color_scheme )
		wp_enqueue_style( 'orange', get_template_directory_uri() . '/colors/orange.css', array(), null );			

	do_action( 'catchbox_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'catchbox_enqueue_color_scheme' );

/**
 * Hooks the css to head section
 *
 * @since Catch Box 1.0
 */
function catchbox_inline_css() {
    $options = catchbox_get_theme_options();
	if ( !empty( $options['custom_css'] ) ) {	
		echo '<!-- '.get_bloginfo('name').' Custom CSS Styles -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
		echo $options['custom_css'] . "\n";
		echo '</style>' . "\n";
	}	
}
add_action('wp_head', 'catchbox_inline_css');

/**
 * Site Verification codes are hooked to wp_head if any value exists
 */
 
function catchbox_verification() {
    $options = get_option('catchbox_options_webmaster');
	//google
    if (!empty( $options[ 'google_verification' ] ) ) {
		echo '<meta name="google-site-verification" content="' . $options['google_verification'] . '" />' . "\n";
	}
	
	//bing
	if (!empty( $options[ 'bing_verification' ] ) ) {
        echo '<meta name="msvalidate.01" content="' . $options['bing_verification'] . '" />' . "\n";
	}
	
	//yahoo
	if (!empty( $options[ 'yahoo_verification' ] ) ) {
        echo '<meta name="y_key" content="' . $options['yahoo_verification'] . '" />' . "\n";
	}
	
	//site stats, analytics code
	if (!empty( $options[ 'tracker_header' ] ) ) {
        echo $options['tracker_header'];
	}
}

add_action('wp_head', 'catchbox_verification');

/**
 * Analytic, site stat code hooked in footer
 * @uses wp_footer
 */
function catchbox_site_stats() {
    $options = get_option('catchbox_options_webmaster');
    if ($options['tracker_footer']) {
        echo $options['tracker_footer'];
	}
}

add_action('wp_footer', 'catchbox_site_stats');

/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the wp_head action hook.
 *
 * @since Catch Box 1.0
 */
function catchbox_print_link_color_style() {
	$options = catchbox_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = catchbox_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
	<style>
		/* Link color */
		a,
		#site-title a:focus,
		#site-title a:hover,
		#site-title a:active,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-title a:active,
		.widget_catchbox_ephemera .comments-link a:hover,
		section.recent-posts .other-recent-posts a[rel="bookmark"]:hover,
		section.recent-posts .other-recent-posts .comments-link a:hover,
		.format-image footer.entry-meta a:hover,
		#site-generator a:hover {
			color: <?php echo $link_color; ?>;
		}
		section.recent-posts .other-recent-posts .comments-link a:hover {
			border-color: <?php echo $link_color; ?>;
		}
		article.feature-image.small .entry-summary p a:hover,
		.entry-header .comments-link a:hover,
		.entry-header .comments-link a:focus,
		.entry-header .comments-link a:active,
		.feature-slider a.active {
			background-color: <?php echo $link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'catchbox_print_link_color_style' );


/* Clearing Theme Option Cache 
 * @uses delete_transient
 */
function catchbox_themeoption_invalidate_caches() {
	delete_transient( 'catchbox_favicon' );	//Favicon
	delete_transient( 'catchbox_sliders' ); // Featured Slider
	delete_transient( 'catchbox_socialprofile' ); //Social Profile
	delete_transient( 'catchbox_webclip' );	//Favicon
}


/* Clearing Theme Option Cache 
 * @uses delete_transient and action publish_post
 */
function catchbox_posts_invalidate_caches() {
	delete_transient( 'catchbox_sliders' ); // Featured Slider
}
add_action( 'publish_post', 'catchbox_posts_invalidate_caches' ); // publish posts runs whenever posts are published or published posts are edited