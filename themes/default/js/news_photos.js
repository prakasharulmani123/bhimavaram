jQuery(function(){
	jQuery('.add-fields').click(function(){
		jQuery('form div.fields').append('<div class="clearbig">&nbsp;</div><input type="file" class="offset1" name="userfile[]" >');
	});
});//jQuery Ends