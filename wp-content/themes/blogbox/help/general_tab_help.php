<?php
/**
 * Contextual help file for general tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('General Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Email','blogBox').'</strong>'; 
 $html .= ' - '.__('"Settings" => "General" email is used if left blank.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Favicon','blogBox').'</strong>';
 $html .= ' - '.__('You will need to create a favicon.png image and place it in the theme root folder.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Use Post Format Icons','blogBox').'</strong>';
 $html .= ' - '.__('Click this and a post format icon will appear to the left of the post title.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Exclude timestamp in posts','blogBox').'</strong>';
 $html .= ' - '.__('Click if you do not want a timestamp listed with each post.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Exclude author in posts','blogBox').'</strong>';
 $html .= ' - '.__('Click if you do not want the author listed with each post.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Exclude categories in posts','blogBox').'</strong>';
 $html .= ' - '.__('Click if you do not want the categories listed with each post.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Exclude tags in posts','blogBox').'</strong>';
 $html .= ' - '.__('Click if you do not want the tags listed with each post.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Exclude Mystery Gravatar','blogBox').'</strong>';
 $html .= ' - '.__('Click if you do not want the mystery gravatar in the comments section','blogBox').'</p>';
 $html .= '<p><strong>'.__('Captcha','blogBox').'</strong>';
 $html .= ' - '.__('If the Captcha is not working you need to disable it here.','blogBox');
 $html .= ' '.__('You can use the captcha for the custom contact form and the WordPress comment form.','blogBox');
 $html .= ' '.__('A color option for the captcha is aslo available.','blogBox');
 $html .= ' '.__('Try the color caption if the black and white one is not working.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Use fullwidth for single post','blogBox').'</strong>';
 $html .= ' - '.__('Click this. if you are using a full width blog and want the single post displayed full width.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Disable Colorbox','blogBox').'</strong>';
 $html .= ' - '.__('Color box is used to display images and galleries.','blogBox');
 $html .= ' '.__('If you are using a plugin for this you can disable Colorbox here.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Disable fitvids','blogBox').'</strong>';
 $html .= ' - '.__('The fitvids plugin allows video to be responsive.','blogBox');
 $html .= ' '.__('If there are problems with the plugin you can disable it here','blogBox').'</p>';
 $html .= '<p><strong>'.__('Include mobile design','blogBox').'</strong>';
 $html .= ' - '.__('Uncheck this box if you do not want your site to be responsive.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Disable audio.js plugin','blogBox').'</strong>';
 $html .= ' - '.__('Uncheck this box if you are using a separate audio player plugin.','blogBox').'</p>';
 $html .= '<h2>'.__('Header Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Use full width banner','blogBox').'</strong>';
 $html .= ' - '.__('Check this if you loaded a full width banner in "Appearance"=>"Header"','blogBox').'</p>';
 $html .= '<p><strong>'.__('Show Blog Title','blogBox').'</strong>';
 $html .= ' - '.__('Check this if you want to show the title under "Settings"=>"General"','blogBox').'</p>';
 $html .= '<p><strong>'.__('Show Blog Description','blogBox').'</strong>';
 $html .= ' - '.__('This is the Tagline under "Settings" => "General"','blogBox').'</p>';
 $html .= '<p><strong>'.__('Show Social Strip','blogBox').'</strong>';
 $html .= ' - '.__('If you want a social strip included in the header, check this.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Header menu location','blogBox').'</strong>';
 $html .= ' - '.__('Select left, right, or center.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Menu border options','blogBox').'</strong>';
 $html .= ' - '.__('Select no border, full border or menu only which can be used only for centered menus.','blogBox').'</p>';
 $html .= '<h2>'.__('Footer Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Show Footer','blogBox').'</strong>';
 $html .= ' - '.__('This box allows you to include or exclude the footer.','blogBox').' ';
 $html .= '<p><strong>'.__('Footer Columns','blogBox').'</strong>';
 $html .= ' - '.__('You can have a 3 column or a 4 column footer.','blogBox').' ';
 $html .= '<p><strong>'.__('Show Copyright Strip','blogBox').'</strong>';
 $html .= ' - '.__('This box allows you to include or exclude the copyright strip.','blogBox').' ';
 $html .= '<p><strong>'.__('Copyright','blogBox').'</strong>';
 $html .= ' - '.__('The copyright section is a strip at the bottom of the footer that accepts html.','blogBox').' ';
 $html .= __('Typically the copyright notice is on the left, a developer credit in the middle, and a siteplan link is on the right.','blogBox').'</p>';
 $html .= '<h2>'.__('Social Options','blogBox').'</h2>';
 $html .= '<p>'.__('Input yout social links here. Social links are added by using the social links widget.','blogBox').'</p>';
 
 return $html;
 
?>