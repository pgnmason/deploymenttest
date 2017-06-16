$(function() {

	
	// Products navigation
	
	$('#products #sidebar nav > ul > li > a').click(function(e) {
		
		e.preventDefault();
		//$(this).next().toggleClass('active');
		
		$(this).next().slideToggle('fast');
      
	});
	
	
	//Form label in field resplacement

	$('label').inFieldLabels();
	

    //Homepage slideshow
    
    $('.flexslider').flexslider({
    	animation: 'slide',
    	slideshowSpeed: 4000,
    	controlNav: false,
		directionNav: false,
		keyboard: false,
		touch: false,
    });
    

});