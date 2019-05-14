<?php
/**
 * Captcha file
 *
 * This file is used to generate a Captcha image from 6 randomly selected letters 
 * and the Vera.ttf file included in the theme. The password is saved in an encrypted state
 * as a session variable, that is then checked in the calling file for validation
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
 if(!isset($_SESSION)) session_start();

   // Set some important CAPTCHA constants
  $number_characters = 6; // number of characters in pass-phrase
  $captcha_width = 110; // width of image
  $captcha_height = 26; // height of image
  
  // Generate the random pass-phrase
  $pass_phrase = "";
  $characters = 'abcdefghijklmnopqrstuvwxyz';
  for ($i = 0; $i < $number_characters; $i++) {
  	$position = mt_rand( 0, strlen($characters) - 1 );
	$pass_phrase .= $characters[$position];
  }
    // Store the encrypted pass-phrase in a session variable
  $_SESSION['blogBox_pass_phrase'] = SHA1($pass_phrase);

  // Create the image  
  $blogBox_img = imagecreatetruecolor($captcha_width, $captcha_height);  
  // Set a white background with black text and gray graphics  
  $bg_color = imagecolorallocate($blogBox_img, 255, 255, 255);		// white  
  $text_color = imagecolorallocate($blogBox_img, 0, 0, 0);   		// black  
  $graphic_color = imagecolorallocate($blogBox_img, 64, 64, 64);   	// dark gray

  // Fill the background
  imagefilledrectangle($blogBox_img, 0, 0, $captcha_width, $captcha_height, $bg_color);
  // Draw some random lines
  for ($i = 0; $i < 5; $i++) {
    imageline($blogBox_img, 0, rand() % $captcha_height, $captcha_width, rand() % $captcha_height, $graphic_color);
  }

  // Sprinkle in some random dots
  for ($i = 0; $i < 50; $i++) {
    imagesetpixel($blogBox_img, rand() % $captcha_width, rand() % $captcha_height, $graphic_color);
  }
  // Draw the pass-phrase string
  imagettftext($blogBox_img, 18, 0, 5, $captcha_height - 5, $text_color, 'Vera.ttf', $pass_phrase);

  // Output the image as a PNG using a header  
  header("Content-type: image/png");  
  imagepng($blogBox_img);

  // Clean up
  imagedestroy($blogBox_img);
?>
