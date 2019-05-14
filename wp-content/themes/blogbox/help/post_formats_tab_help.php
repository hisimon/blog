<?php
/**
 * Contextual help file for post formats tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Post Format Options','blogBox').'</h2>';
 $html .= '<p>'.__('You can change background and font colors for certain post formats.','blogBox');
 $html .= '<p>'.__('The best thing to do is set up test posts and play with the colors until you get what you want.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Aside Post Format','blogBox').'</strong>'; 
 $html .= ' - '.__('Set the top and bottom gradient color and the text color','blogBox').'</p>';
 $html .= '<p><strong>'.__('Audio Post Format','blogBox').'</strong>';
 $html .= ' - '.__('Set the background and text colors','blogBox').'</p>';
 $html .= '<p><strong>'.__('Chat Post Format','blogBox').'</strong>';
 $html .= ' - '.__('Set the background color.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Link Post Format','blogBox').'</strong>';
 $html .= ' - '.__('Set the background, text and hover colors.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Status Post Format','blogBox').'</strong>';
 $html .= ' - '.__('Set the background, text and meta strip colors','blogBox').'</p>';
 $html .= '<p><strong>'.__('Quote Post Format','blogBox').'</strong>';
 $html .= ' - '.__('Set the background, border, and text colors.','blogBox').'</p>';
 
 return $html;