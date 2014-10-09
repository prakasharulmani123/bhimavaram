jQuery(function(){
	 jQuery("#subcategory").chained("#category");
	 
	 //check closed box
	 jQuery('.closed-box').click(function(){
		 var ele=jQuery(this);
		 if(ele.attr('checked')=='checked')
		 {
			ele.parents('.controls').find('.span2').removeAttr("placeholder").attr('readonly','readonly').val('Closed');
			
		 }
		 else
		 {
			ele.parents('.controls').find('.from').attr("placeholder",'09:00 AM');
			ele.parents('.controls').find('.to').attr("placeholder",'06:00 PM');
			ele.parents('.controls').find('.span2').removeAttr('readonly').val(''); 
			//ele.parents('.controls').find('.span2').attr("data-required",'true');
		 }
//		 
		});//closed-box ends
});//jQuery Ends