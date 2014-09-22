jQuery(function(){
	 jQuery("#subcategory").chained("#category");
	 
	 //check closed box
	 jQuery('.free-box').click(function(){
		 var ele=jQuery(this);
		 if(ele.attr('checked')=='checked')
		 {
			ele.parents('.controls').find('.span2').removeAttr("placeholder").attr('readonly','readonly').val('0');
			
		 }
		 else
		 {
			ele.parents('.controls').find('.span2').removeAttr('readonly').val(''); 
			//ele.parents('.controls').find('.span2').attr("data-required",'true');
		 }
//		 
		});//closed-box ends
		
		
		
});//jQuery Ends