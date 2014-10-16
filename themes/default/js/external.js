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
 });