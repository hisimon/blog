<?php
/**
 * Contextual help file for portfolio tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Portfolio Page Options','blogBox').'</h2>';
 $html .= '<p>'.__('blogBox allows you to create up to 5 different Portfolio Templates.','blogBox').' '; 
 $html .= __('These templates are popular in Wordpress as they offer a unique way of presenting your portfolio.','blogBox').' '; 
 $html .= __('Up to four columns can be used in each Portfolio Page.','blogBox').'</p>'; 
 $html .= '<p>'.__('When you are working with 2,3, or 4 column portfolios, you should make a choice on the content to show.','blogBox').' '; 
 $html .= __('Choose to either show content from the post or from the media image.','blogBox').' '; 
 $html .= __('If you choose the media image content you can select Feature Caption and/or Feature Description.','blogBox').' ';
 $html .= __('If you pick all three and you can, the spacing may come out weird looking.','blogBox').' ';
 $html .= __('The pages were designed like this so you can create feature posts with a lot of text and images. ','blogBox').' ';
 $html .= __('In such a case you should display content from the media Feature image. When the visitor clicks the image, they are taken to the full post.','blogBox').' '; 
 $html .= __('To display the photos evenly across the page, the Feature Caption and Feature Description elements are a fixed height.','blogBox').'</p>';
 $html .= '<p>'.__('Images are posted by inserting feature images in posts:','blogBox').'</p>'; 
 $html .= '<ol><li>'.__('Create a new page with "Portfolio A" selected as the template','blogBox').'</li>'; 
 $html .= '<li>'.__('Publish the Page','blogBox').'</li>';
 $html .= '<li>'.__('Go to "Appearance" => "blogBox Options" => "Portfolio Pages" tab','blogBox').'</li>';
 $html .= '<li>'.__('"Portfolio Columns" - select the number of columns you would like','blogBox').'</li>';
 $html .= '<li>'.__('"Portfolio Post Category" - leave as default or use your own category','blogBox').'</li>';
 $html .= '<li>'.__('"Show Post Content" - Check the box if you want the content from the post to be shown, only applies for 2,3, and 4 column portfolios. For single column portfolios this is shown in the right hand column along with the post title, and is always shown.','blogBox').'</li>';
 $html .= '<li>'.__('"Show Feature Image Caption" - Check this box if you want the caption you put into the media upload panel for the feature image, to be shown.','blogBox').'</li>';
 $html .= '<li>'.__('"Show Feature Image Description" - Check this box if you want the description you put into the media upload panel for the feature image, to be shown.','blogBox').'</li>';
 $html .= '<li>'.__('"Show Posts in Blog" - Check this box if you want the posts for this Portfolio listed in your blog section.','blogBox').'</li>';
 $html .= '<li>'.__('Go to the bottom of the options panel and "Save Settings"','blogBox').'</li>';
 $html .= '<li>'.__('Go to "Posts" => "Categories" and if the category you listed previously does not exist, create it.','blogBox').'</li>';
 $html .= '<li>'.__('Create the posts and ensure you have the category selected. Upload and install the featured image.','blogBox').'</li></ol>';
 
 return $html;
 
?>