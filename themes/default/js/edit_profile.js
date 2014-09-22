jQuery(function(){
	jQuery('.nav-tabs a').click(function(){
		jQuery('.profile-form').attr('action',baseUrl+'index.php/profile/index'+jQuery(this).attr('href'));
	});//nav-tabs ends
});//jQuery Ends