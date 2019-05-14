<?php
/**
 * Template Name: Contact Form
 * 
 * This file is WordPress template file, which is output when
 * the user creates a page with this template
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php 
	global $blogBox_option;
	$blogBox_option = blogBox_get_options(); 
	global $nameError,$hasError,$emailError,$name,$emailError,$email,$commentError,$comments,$captchaError;
if(!isset($_SESSION)) session_start();
?>
<?php
if(isset($_POST['submitted']) && wp_verify_nonce( $_POST['blogBox_contact_form_nonce'],'blogBox_nonce_1')) {
		
	//sanitize data input from forms	
	$name = sanitize_text_field($_POST['contactName']);
	$email = sanitize_email($_POST['email']);
	$comments = sanitize_text_field($_POST['comments']);
	$comments = stripcslashes($comments);
	//validate data input from forms
	if($name === '') {
		$nameError = __('Please enter your name.','blogBox');
		$hasError = true;
	}
	if($email === '')  {
		$emailError = __('Please enter your email address.','blogBox');
		$hasError = true;
	} else if(blogBox_validEmail($email) !== true){
		$emailError = __('You entered an invalid email address.','blogBox');
		$hasError = true;
	}
	if($comments === '') {
		$commentError = __('Please enter a message.','blogBox');
		$hasError = true;
	}
	if($blogBox_option['bB_show_contact_captcha'] == 1) {
		if ($_SESSION['kabb_pass_phrase'] !== sha1($_POST['verify'])){
			$captchaError = __('Please enter the captcha exactly as shown','blogBox');
			$hasError=true;
		}
	}
// Everything checks out so continue
	if(!isset($hasError)) {
		if(isset($blogBox_option['bB_contact_email']) && $blogBox_option['bB_contact_email'] !== '' && is_email($blogBox_option['bB_contact_email'])) {
			$emailTo = $blogBox_option['bB_contact_email'];
		} else {
			$emailTo = get_option('admin_email');
		}
		$subject = __('A message from ','blogBox').$name;
		$body = __('Name:','blogBox').' '.$name."\n\n".__('Email: ','blogBox').' '.$email."\n\n".__('Comments:','blogBox').' '.$comments;
		$headers = 'From: '.$name.' <'.$email.'>';
		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>
<?php get_header(); ?>

<div id="widecolumn">
		<div id="contactmeform">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
				<h2><?php the_title(); ?></h2>
					<div class="entry">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p><?php _e('Thanks, your email was sent successfully.','blogBox'); ?></p>
							</div>
						<?php } else { ?>
							<?php the_content(); ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php _e('Sorry, an error occured.','blogBox'); ?><p>
							<?php } ?>
					<br/><br/>
					<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
						<?php wp_nonce_field("blogBox_nonce_1","blogBox_contact_form_nonce"); ?>
						<ul class="contactform">
							<li>
								<label for="contactName"><?php _e('Name:','blogBox'); ?></label><br/>
								<input type="text" size="39" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" /><br/><br/>
								<?php if($nameError != '') { ?>
									<span class="error"><?php echo $nameError; ?></span>
								<?php } ?>
							</li>

							<li>
								<label for="email"><?php _e('E-mail:','blogBox'); ?></label><br/>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" /><br/><br/>
								<?php if($emailError != '') { ?>
									<span class="error"><?php echo $emailError; ?></span>
								<?php } ?>
							</li>

							<li><label for="commentsText"><?php _e('Message:','blogBox'); ?></label><br/>
								<textarea name="comments" id="commentsText" rows="10"  ><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea><br/><br/>
								<?php if($commentError != '') { ?>
									<span class="error"><?php echo $commentError; ?></span>
								<?php } ?>
							</li>

							<?php if( $blogBox_option['bB_show_contact_captcha'] == 1 ) { ?>
								<li><label for="verify"><?php _e('Verification : ','blogBox'); ?></label>
									<input type="text" id="verify" name="verify" value="<?php _e('Enter the Captcha','blogBox'); ?>" onclick="this.select();" />
									<?php if ( $blogBox_option['bB_use_color_captcha'] == 1 ) { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/captcha/kabb_captcha_color.php" alt="Verification Captcha" />
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/captcha/kabb_captcha_bw.php" alt="Verification Captcha" />
									<?php } ?>
										
									<?php if($captchaError != '') { ?>
										<span class="error"><br/><?php echo $captchaError; ?></span>
									<?php } ?>
								</li>
							<?php } ?>

							<li>
								<br />
								<button type="submit"><?php _e('Send E-mail','blogBox'); ?></button>
								<input type="hidden" name="submitted" id="submitted" value="true" />
							</li>
						</ul>
					</form>
				<?php } ?>
				</div><!-- .entry-content -->
			</div><!-- .post -->

				<?php endwhile; endif; ?>
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar('contact'); ?>
<?php get_footer(); ?>