jQuery(function(){
jQuery('.datepicker').datepicker({format:'yyyy-mm-dd'});	 
/*jQuery('.timepicker').timepicker({
				minuteStep: 5,
                showInputs: false,
                disableFocus: true,
				//defaultTime:false
				});*/
				
jQuery('.fromtime').timepicker({
				minuteStep: 5,
                showInputs: false,
                disableFocus: true,	
				defaultTime:'09:00 AM'
				});
jQuery('.totime').timepicker({
					minuteStep: 5,
                showInputs: false,
                disableFocus: true,
				defaultTime:'06:00 PM'
				});								
	 //check closed box
	 jQuery('.free-box').click(function(){
		 var ele=jQuery(this);
		 if(ele.attr('checked')=='checked')
		 {
			ele.parents('.controls').find('.span2').removeAttr("placeholder").attr('readonly','readonly').val('0');
			jQuery('input[name=ticket_url]').attr('readonly','readonly').val('NA').removeAttr('data-required').removeAttr('data-type');
			
		 }
		 else
		 {
			ele.parents('.controls').find('.span2').removeAttr('readonly').val(''); 
			jQuery('input[name=ticket_url]').removeAttr('readonly').val('');
			//ele.parents('.controls').find('.span2').attr("data-required",'true');
		 }
//		 
		});//closed-box ends
		
		
		
});//jQuery Ends