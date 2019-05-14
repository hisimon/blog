<?php
/**
 * Template part file that contains the 404 sidebar content
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
<div id="sidebar">
	<?php if ( !dynamic_sidebar('Sidebar-404') ) : ?>
		<h2><?php _e('404 Sidebar','blogBox') ?></h2>
		<p><?php _e('Go to Appearance => Widgets and drag a widget over to this sidebar.','blogBox') ?></p>
	<?php endif; ?>
</div>