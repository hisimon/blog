<?php
/**
 * This file contains the that is called when users select to use the captcha.
 *
 *
 * @package		Testimonial Basics WordPress Plugin
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
 //Start session if not already started
if(!isset($_SESSION)) session_start();

  // Set some important CAPTCHA constants
  $number_characters = 6; // number of characters in pass-phrase
  
  $captcha_height = 26; // height of image
  
  // Generate the random pass-phrase
  $pass_phrase = "";
  $characters = 'abcdefghijklmnopqrstuvwxyz';
  for ($i = 0; $i < $number_characters; $i++) {
  	$position = mt_rand( 0, strlen($characters) - 1 );
	$pass_phrase .= $characters[$position];
  }
  
  $textbox_size = imagettfbbox( 16, 0, 'Vera.ttf', $pass_phrase );
  $text_width = $textbox_size[2] - $textbox_size[0];
  $captcha_width = $text_width + 10; // width of image
  
    // Store the encrypted pass-phrase in a session variable
  $_SESSION['kabb_pass_phrase'] = SHA1($pass_phrase);

  // Create the image  
  $kabb_img = imagecreatetruecolor($captcha_width, $captcha_height);  
  // Set a white background with black text and gray graphics  
  $bg_color = imagecolorallocate($kabb_img, 255, 255, 255);		// white  
  $text_color = imagecolorallocate($kabb_img, 0, 0, 0);   		// black  
  $graphic_color = imagecolorallocate($kabb_img, 64, 64, 64);   	// dark gray

  // Fill the background
  imagefilledrectangle($kabb_img, 0, 0, $captcha_width, $captcha_height, $bg_color);
  // Draw some random lines
  for ($i = 0; $i < 5; $i++) {
    imageline($kabb_img, 0, rand() % $captcha_height, $captcha_width, rand() % $captcha_height, $graphic_color);
  }

  // Sprinkle in some random dots
  for ($i = 0; $i < 50; $i++) {
    imagesetpixel($kabb_img, rand() % $captcha_width, rand() % $captcha_height, $graphic_color);
  }
  // Draw the pass-phrase string
  imagettftext($kabb_img, 16, 0, 5, $captcha_height - 5, $text_color, 'Vera.ttf', $pass_phrase);

  // Output the image as a PNG using a header  
  header("Content-type: image/png");  
  imagepng($kabb_img);

  // Clean up
  imagedestroy($kabb_img);
?>
