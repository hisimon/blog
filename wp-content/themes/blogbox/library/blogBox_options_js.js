jQuery(document).ready(function(){
		
	 //This if statement checks if the color picker widget exists within jQuery UI
    //If it does exist then we initialize the WordPress color picker on our text input field
    if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
        jQuery( '.hexcolor' ).wpColorPicker();
    }
    else {
    	 /* We use farbtastic if the WordPress color picker widget doesn't exist
    	 * This script adds the color wheel to allow the user to use it for
		 * selecting colors in the background color and text color theme option tabs
		 */
		jQuery('.hexcolor')
			.each(function () { jQuery.farbtastic('#picker').linkTo(this); jQuery(this).css('opacity', 0.75); })
			.focus(function() {
   				jQuery.farbtastic('#picker').linkTo(this);
				jQuery('#picker').css('opacity', 0.25).css('opacity', 1);
			});
	}
	/*
	 * This script enhances the error message used in the theme options section.
	 */
	var error_msg = jQuery("#message p[class='setting-error-message']");  
    // look for admin messages with the "setting-error-message" error class  
    if (error_msg.length != 0) {  
        // get the title  
        var error_setting = error_msg.attr('title');  
  
        // look for the label with the "for" attribute=setting title and give it an "error" class (style this in the css file!)  
        jQuery("label[for='" + error_setting + "']").addClass('error');  
  
        // look for the input with id=setting title and add a red border to it.  
        jQuery("input[id='" + error_setting + "']").attr('style', 'border-color: red'); 
    }

	//This script is to provide upload buttons for the service box images

	var uploadID = ""; /*setup the var in a global scope*/

	jQuery('.blogBox_upload_button').click(function() {
		uploadID = jQuery(this).prev('input'); /*set the uploadID variable to the value of the input before the upload button*/
		formfield = jQuery('.blogBox_upload_image').attr('name');
		tb_show("", 'media-upload.php?type=image&amp;amp;amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		uploadID.val(imgurl); /*assign the value of the image src to the input*/
		tb_remove();
	};

});