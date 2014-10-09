jQuery(function(){
	jQuery('.add-fields').click(function(){
		jQuery('form div.fields').append('<div class="clear">&nbsp;</div><input name="answer[]" data-required="true" type="text" class="span7 pull-left" placeholder="Answer Option" />');
	});
	
	jQuery('.poll-edit-form').submit(function(event){
/*		 event.preventDefault();
		jQuery('input.answer-box').val(jQuery(this).attr('rel'));
		jQuery('.poll-edit-form').submit();*/
	});//submission ends
});//jQuery Ends