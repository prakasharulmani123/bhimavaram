jQuery(function(){
	jQuery('.add-fields').click(function(){
		jQuery('form div.fields').append('<div class="clear">&nbsp;</div><input type="file" name="userfile[]" class="offset1" >');
	});
});//jQuery Ends