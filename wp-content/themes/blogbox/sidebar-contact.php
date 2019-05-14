<?php
/**
 * Template part file that contains the contact form sidebar content
 *
 * This file is called by contact.php
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<div id="sidebar">
	<?php if ( !dynamic_sidebar('Contact-Sidebar') ) : ?>
		<h2><?php _e('Contact Sidebar','blogBox') ?></h2>
		<p><?php _e('Go to Appearance => Widgets and drag a widget over to this sidebar.','blogBox') ?></p>
	<?php endif; ?>
</div>