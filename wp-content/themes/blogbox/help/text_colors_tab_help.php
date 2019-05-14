<?php
/**
 * Contextual help file for text color tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Text Color Options','blogBox').'</h2>';
 $html .= '<p>'.__('You can change the text colors for your theme.','blogBox').'</p>';
 $html .= '<p>'.__('Skins must not be enabled to use this feature.','blogBox').'</p>'; 
 $html .= '<p>'.__('You can select the cell and then use the color picker to select a color.','blogBox').' '; 
 $html .= __('Once you have picked a color click the "current color" button','blogBox').' '; 
 $html .= '<p>'.__('You can also type in or copy in hex color numbers from other cells.','blogBox').' '; 
 $html .= __(' When you copy in the hex color, hit your "Enter" key for the box to change color.','blogBox').'</p>';
 $html .= '<p>'.__('Make sure you "Save Settings" when you are done.','blogBox').'</p>';
 $html .= '<p>'.__('Note that if the entry is deleted and saved the default will be loaded.','blogBox').'</p>'; 
   
 return $html;
 
?>