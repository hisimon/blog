<?php
/**
 * Contextual help file for home tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Home Page Options','blogBox').'</h2>';
 $html .= '<p>'.__('There are quite a few options for the home page. Please refer to the user documentation.','blogBox').' ';
 $html .= __('The documentation takes you through setting up the home page step by step.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Image size tips','blogBox').'</strong>'; 
 $html .= ' - '.__('The sliders will handle any size images, they are set up in each case as a percentage of a layout width.','blogBox');
 $html .= ' '.__('Keep all images the same size.','blogBox');
 $html .= ' '.__('Process the image you want to use as a feature before you upload them.','blogBox');
 $html .= ' '.__('Process your images to 1024px wide by whatever height you want.','blogBox');
 $html .= ' '.__('That way you could switch to a full slider without sacrificing image quality.','blogBox');
 $html .= ' '.__('Picasa is a good option for processing the images.','blogBox');
 $html .= ' '.__('Another good option is GIMP.','blogBox');
 $html .= ' '.__(' Play around with a width to height ratio and once you select one make all images the same.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Service Box Image Sizes','blogBox').'</strong>'; 
 $html .= ' - '.__('250 px wide maximum by 100 px high maximum','blogBox').'</p>';
 
 return $html;
 
?>