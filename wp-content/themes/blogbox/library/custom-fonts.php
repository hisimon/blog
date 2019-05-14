<?php
/**
 * Custom fonts file
 *
 * This file is called by functions.php and loads the user selections for fonts
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php 
 /* Get the user choices for the theme options */
$blogBox_option = blogBox_get_options();
?>
<?php 
	if($blogBox_option['bB_use_google_header'] && $blogBox_option['bB_use_google_header'] == true){
		$header_font = $blogBox_option['bB_google_header_font'];
		switch ($blogBox_option['bB_google_header_font']) {
			case "'Cabin', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Cabin:400,400italic" rel="stylesheet" type="text/css">';
				break;
			case "'Raleway', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet" type="text/css">';
				break;
			case "'Allerta', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Allerta" rel="stylesheet" type="text/css">';
				break;
			case "'Arvo', Georgia, Times, serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
				break;
			case "'PT Sans', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
				break;
			case "'Molengo', Georgia, Times, serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Molengo" rel="stylesheet" type="text/css">';
				break;
			case "'Lekton', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Lekton:400,400italic" rel="stylesheet" type="text/css">';
				break;
			case "'Droid Serif', Georgia, Times, serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
				break;
			case "'Droid Sans', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">';
				break;
			case "'Corben', Georgia, Times, serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Corben" rel="stylesheet" type="text/css">';
				break;
			case "'Nobile', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
				break;
			case "'Ubuntu', Helvetica, Arial, sans-serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400italic" rel="stylesheet" type="text/css">';
				break;
			case "'Vollkorn', Georgia, Times, serif" :
				echo '<link href="http://fonts.googleapis.com/css?family=Vollkorn:400,400italic" rel="stylesheet" type="text/css">';
				break;
		}
	} else {
		$header_font = $blogBox_option['bB_header_font'];
	}
	if($blogBox_option['bB_use_google_body'] && $blogBox_option['bB_use_google_body'] == true){
		$body_font = $blogBox_option['bB_google_body_font'];
		if($blogBox_option['bB_google_header_font'] || $blogBox_option['bB_google_header_font'] !== $blogBox_option['bB_google_body_font'])
			switch ($blogBox_option['bB_google_body_font']) {
				case "'Cabin', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Cabin:400,400italic" rel="stylesheet" type="text/css">';
					break;
				case "'Raleway', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet" type="text/css">';
					break;
				case "'Allerta', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Allerta" rel="stylesheet" type="text/css">';
					break;
				case "'Arvo', Georgia, Times, serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
					break;
				case "'PT Sans', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
					break;
				case "'Molengo', Georgia, Times, serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Molemgo" rel="stylesheet" type="text/css">';
					break;
				case "'Lekton', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Lekton:400,400italic" rel="stylesheet" type="text/css">';
					break;
				case "'Droid Serif', Georgia, Times, serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
					break;
				case "'Droid Sans', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">';
					break;
				case "'Corben', Georgia, Times, serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Corben" rel="stylesheet" type="text/css">';
					break;
				case "'Nobile', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic" rel="stylesheet" type="text/css">';
					break;
				case "'Ubuntu', Helvetica, Arial, sans-serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400italic" rel="stylesheet" type="text/css">';
					break;
				case "'Vollkorn', Georgia, Times, serif" :
					echo '<link href="http://fonts.googleapis.com/css?family=Vollkorn:400,400italic" rel="stylesheet" type="text/css">';
					break;
			}
		} else {
			$body_font = $blogBox_option['bB_body_font'];
		}
?>
<style type="text/css" >
	body {font-size:<?php echo $blogBox_option['bB_base_font_size']; ?>;}
	<?php if ( $header_font != "Default" ) { ?>
		h1, h2, h3, h4, h5, h6 {font-family:<?php echo $header_font; ?>;}
		#slogan1 h1 {font-family:<?php echo $header_font; ?>;}
		#slogan2 p.slogan2line1 {font-family:<?php echo $header_font; ?>;}
		#slogan2 p.slogan2line2 {font-family:<?php echo $header_font; ?>;}
		.listhead{font-family:<?php echo $header_font; ?>;}
		.main-nav {font-family:<?php echo $header_font; ?>;}
	<?php } ?>
	<?php if ($body_font != "Default" ) { ?>
		body {font-family:<?php echo $body_font; ?>;}
	<?php } ?>
</style>