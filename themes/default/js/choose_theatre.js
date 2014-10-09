jQuery(function(){
	 jQuery("#theatre").chained("#city");
	 jQuery('a.delete_movie').click(function(){
		 return confirm("Are you sure to delete this movie?");
	});
});//jQuery Ends