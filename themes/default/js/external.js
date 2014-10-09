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
	
});