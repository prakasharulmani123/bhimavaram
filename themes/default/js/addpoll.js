jQuery(function(){
	jQuery('.add-fields').click(function(){
		jQuery('form div.fields').append('<div class="clear">&nbsp;</div><input name="answer[]" data-required="true" type="text" class="span7 pull-left" placeholder="Answer Option" />');
	});
});//jQuery Ends