// initialise plugins
jQuery(document).ready(function($){ 
	//alert('toggle is running');
	
	bB_column_height();
	
    jQuery('ul.sf-menu').superfish();
    
	jQuery(window).unload(function(){
		jQuery('ul.sf-menu li.current').hideSuperfishUl();
	});
	
	jQuery(function(){
    	jQuery('#full-slider').nivoSlider({
    		effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
	        slices: 1, // For slice animations
	        boxCols: 8, // For box animations
	        boxRows: 4, // For box animations
	        animSpeed: 700, // Slide transition speed
	        pauseTime: 5000, // How long each slide will show
	        startSlide: 0, // Set starting Slide (0 index)
	        directionNav: true, // Next & Prev navigation
	        controlNav: true, // 1,2,3... navigation
	        controlNavThumbs: false, // Use thumbnails for Control Nav
	        pauseOnHover: true, // Stop animation while hovering
	        manualAdvance: false, // Force manual transitions
	        prevText: 'Prev', // Prev directionNav text
	        nextText: 'Next', // Next directionNav text
	        randomStart: false, // Start on a random slide
	        beforeChange: function(){}, // Triggers before a slide transition
	        afterChange: function(){}, // Triggers after a slide transition
	        slideshowEnd: function(){}, // Triggers after all slides have been shown
	        lastSlide: function(){}, // Triggers when last slide is shown
	        afterLoad: function(){} // Triggers when slider has loaded
    	});
	});
	
	jQuery(function(){
    	jQuery('#full-slider-thumb').nivoSlider({
	    	effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
	        slices: 1, // For slice animations
	        boxCols: 8, // For box animations
	        boxRows: 4, // For box animations
	        animSpeed: 700, // Slide transition speed
	        pauseTime: 5000, // How long each slide will show
	        startSlide: 0, // Set starting Slide (0 index)
	        directionNav: true, // Next & Prev navigation
	        controlNav: true, // 1,2,3... navigation
	        controlNavThumbs: true, // Use thumbnails for Control Nav
	        pauseOnHover: true, // Stop animation while hovering
	        manualAdvance: false, // Force manual transitions
	        prevText: 'Prev', // Prev directionNav text
	        nextText: 'Next', // Next directionNav text
	        randomStart: false, // Start on a random slide
	        beforeChange: function(){}, // Triggers before a slide transition
	        afterChange: function(){}, // Triggers after a slide transition
	        slideshowEnd: function(){}, // Triggers after all slides have been shown
	        lastSlide: function(){}, // Triggers when last slide is shown
	        afterLoad: function(){} // Triggers when slider has loaded
	    });
	});
  	
  	jQuery(function(){
    	jQuery('#half-slider').nivoSlider({
    		effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
	        slices: 1, // For slice animations
	        boxCols: 8, // For box animations
	        boxRows: 4, // For box animations
	        animSpeed: 700, // Slide transition speed
	        pauseTime: 5000, // How long each slide will show
	        startSlide: 0, // Set starting Slide (0 index)
	        directionNav: true, // Next & Prev navigation
	        controlNav: true, // 1,2,3... navigation
	        controlNavThumbs: false, // Use thumbnails for Control Nav
	        pauseOnHover: true, // Stop animation while hovering
	        manualAdvance: false, // Force manual transitions
	        prevText: 'Prev', // Prev directionNav text
	        nextText: 'Next', // Next directionNav text
	        randomStart: false, // Start on a random slide
	        beforeChange: function(){}, // Triggers before a slide transition
	        afterChange: function(){}, // Triggers after a slide transition
	        slideshowEnd: function(){}, // Triggers after all slides have been shown
	        lastSlide: function(){}, // Triggers when last slide is shown
	        afterLoad: function(){} // Triggers when slider has loaded
    	});
	});
  	
  	jQuery(function(){
    	jQuery('#half-slider-thumb').nivoSlider({
	        effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
	        slices: 1, // For slice animations
	        boxCols: 8, // For box animations
	        boxRows: 4, // For box animations
	        animSpeed: 700, // Slide transition speed
	        pauseTime: 5000, // How long each slide will show
	        startSlide: 0, // Set starting Slide (0 index)
	        directionNav: true, // Next & Prev navigation
	        controlNav: true, // 1,2,3... navigation
	        controlNavThumbs: true, // Use thumbnails for Control Nav
	        pauseOnHover: true, // Stop animation while hovering
	        manualAdvance: false, // Force manual transitions
	        prevText: 'Prev', // Prev directionNav text
	        nextText: 'Next', // Next directionNav text
	        randomStart: false, // Start on a random slide
	        beforeChange: function(){}, // Triggers before a slide transition
	        afterChange: function(){}, // Triggers after a slide transition
	        slideshowEnd: function(){}, // Triggers after all slides have been shown
	        lastSlide: function(){}, // Triggers when last slide is shown
	        afterLoad: function(){} // Triggers when slider has loaded
	    });
	});
});

//function to resize all .bb_column_1 divs to the same height
	
function bB_column_height(){

	var currentTallest = 0,
		currentRowStart = 0,
		rowDivs = new Array(),
		Sel,
		topPosition = 0;

 	jQuery('.bB_column_1').each(function() {

		Sel = jQuery(this);
		topPostion = Sel.position().top;

		if (currentRowStart != topPostion) {

		// we just came to a new row.  Set all the heights on the completed row
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}

			// set the variables for the new row
			rowDivs.length = 0; // empty the array
			currentRowStart = topPostion;
			currentTallest = Sel.height();
			rowDivs.push(Sel);

		} else {

			// another div on the current row.  Add it to the list and check if it's taller
			rowDivs.push(Sel);
			currentTallest = (currentTallest < Sel.height()) ? (Sel.height()) : (currentTallest);

		}
		// do the last row
		for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			rowDivs[currentDiv].height(currentTallest);
		}

	});
		
};

// This function reloads the page after a resize but only 
// if it finds the bB_column_1 div
jQuery(window).bind('resize', function(e){
	if (jQuery('.bB_column_1').length) {
		if (window.RT) clearTimeout(window.RT);
			window.RT = setTimeout(function(){
				this.location.reload(false); /* false to get page from cache */
			}, 100);
	}
});