jQuery(document).ready(function(){
	jQuery('#header-ad-spot').innerfade({
			speed: 1000,
			timeout: 5000,
			type: 'sequence',
			containerheight: 'auto'
	});
	
	jQuery('#bottom_footer_ads').carousel({
			interval: 4000,
		 	cycle:true,
	});
	
	jQuery('#executive_ads').carousel({
        interval: 4000,
        cycle: true,
    });
	
	jQuery('#header-ad-spot').show();
	
	jQuery("#bhinew-scroll,#header-scroll-ad").css("visibility", "visible");
	
});

(function ($) {
	 $.support.placeholder = ('placeholder' in document.createElement('input'));
 })(jQuery);


 //fix for IE7 and IE8
 $(function () {
	 if (!$.support.placeholder) {
		 $("[placeholder]").focus(function () {
			 if ($(this).val() == $(this).attr("placeholder")) $(this).val("");
		 }).blur(function () {
			 if ($(this).val() == "") $(this).val($(this).attr("placeholder"));
		 }).blur();

		 $("[placeholder]").parents("form").submit(function () {
			 $(this).find('[placeholder]').each(function() {
				 if ($(this).val() == $(this).attr("placeholder")) {
					 $(this).val("");
				 }
			 });
		 });
	 }
	 
	 /*
	 
	 $('#myCarousel').carousel({
		interval: 5000,
	});
	

	$('#myCarousel .item').each(function(){
	  var next = $(this).next();
	  if (!next.length) {
		next = $(this).siblings(':first');
	  }
	  next.children(':first-child').clone().appendTo($(this));
	  
	  for (var i=0;i<3;i++) {
		next=next.next();
		if (!next.length) {
			next = $(this).siblings(':first');
		}
		
		next.children(':first-child').clone().appendTo($(this));
	  }
	});
	*/
	
	/*
	$("#flexiselDemo3").flexisel({
        visibleItems: 3,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 5000,            
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });
	*/

 });
 