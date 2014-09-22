jQuery(function(){
	jQuery('a.bookmark-this').click(function(){		
		jQuery('#page-loading').fadeIn();
		var data=jQuery(this).attr('rel').split(':');
		var itemtype=data[0];
		var itemid=data[1];
		jQuery.post(baseUrl+'index.php/actions/bookmark',{itemtype:itemtype,itemid:itemid},function(data){
			jQuery('a.bookmark-this').toggleClass('btn-success');
			jQuery('#page-loading').fadeOut();
		});//AJAX Ends
	});
});//jQuery Ends