jQuery(document).ready(function($){
	//alert('mobile-doc-ready loaded');
	ka_drop_menu();
 });

function ka_drop_menu() {
	/* Get the window's width, and check whether it is narrower than 480 pixels */
	var windowWidth = jQuery(window).width();
	/* Clone our navigation */
	var mainNavigation=jQuery('.main-nav').clone();
	/* Replace unordered list with a "select" element to be populated with options,
	* and create a variable to select our new empty option menu */
	//jQuery('.main-nav').html('<select class="menu"></select>');
		jQuery('<select class="menu"></select>').appendTo('nav.ka-menu');
		var selectMenu=jQuery('select.menu');
		jQuery(selectMenu).append('<option value="#" select="selected">Go to ...</option>');
		/* Navigate our nav clone for information needed to populate options */
		jQuery(mainNavigation).children('ul').children('li').each(function(){
			/* Get top-level link and text */
			var href=jQuery(this).children('a').attr('href');
			var text=jQuery(this).children('a').text();
			/* Append this option to our "select" */
			jQuery(selectMenu).append('<option value="' + href + '">' + text + '</option>');
			/* Check for "children" and navigate for more options if they exist */
			if (jQuery(this).children('ul').length > 0) {
				jQuery(this).children('ul').children('li').each(function() {
					/* Get child-level link and text */ 
					var href2 = jQuery(this).children('a').attr('href');
					var text2 = jQuery(this).children('a').text();
					/* Append this option to our "select" */
					jQuery(selectMenu).append('<option value="' + href2 + '" >&nbsp;&nbsp;- '+ text2 + '</option>');
			
					/* Check for "children" and navigate for more options if they exist */
					if (jQuery(this).children('ul').length > 0) {
						jQuery(this).children('ul').children('li').each(function() {
							/* Get child-level link and text */ 
							var href3 = jQuery(this).children('a').attr('href');
							var text3 = jQuery(this).children('a').text();
							/* Append this option to our "select" */
							jQuery(selectMenu).append('<option value="' + href3 + '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- '+ text3 + '</option>');
							if (jQuery(this).children('ul').length > 0) {
								jQuery(this).children('ul').children('li').each(function() {
									/* Get child-level link and text */ 
									var href4 = jQuery(this).children('a').attr('href');
									var text4 = jQuery(this).children('a').text();
									/* Append this option to our "select" */
									jQuery(selectMenu).append('<option value="' + href4 + '" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- '+ text4 + '</option>');
								});
							}
						});
					}
				});
			}
			
		});
	/* When our select menu is changed, change the window location to match the value of the selected option. */
	jQuery(selectMenu).change(function(){
		location=this.options[this.selectedIndex].value;
	});
}