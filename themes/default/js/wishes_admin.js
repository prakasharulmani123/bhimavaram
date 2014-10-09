jQuery(function(){
	jQuery('.delete-wish').click(function(){
		return confirm('Are you sure to delete this wish?');
	});
	
	jQuery('.approve-wish').change(function(){
		 var values=jQuery(this).val();
		 //values=values.split(":");
		 jQuery.post(baseUrl+'index.php/admin/wishes/updatewish',{values:values},function(data){
			 alert(data);
		});//ajax ends
	});
});//jQuery Ends