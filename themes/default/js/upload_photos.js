jQuery(function(){
	jQuery('.add-fields').click(function(){
		jQuery('form div.fields').append('<div class="clearbig">&nbsp;</div><input name="title[]" data-required="true" type="text" class="span4 pull-left" placeholder="Photo Title" /><input type="file" class="offset1" name="userfile[]" >');
	});
});//jQuery Ends