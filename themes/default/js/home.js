jQuery(function(){
	
	jQuery('.home-tabs a').click(function(){
		if(event.preventDefault) event.preventDefault();
		event.returnValue = false;
		var ele=jQuery(this);
		var eleParent=ele.parents('.home-tabs');
		eleParent.find('a').removeClass('active');
		ele.addClass('active');
		var target=jQuery(this).attr('href');
		var targetParent=jQuery(ele).parents('.tabs-holder');
		targetParent.find('ul').hide();
		var targetTab=targetParent.find(target);
		targetParent.find(targetTab).show();
		jQuery('.carousel').carousel({
		  cycle:true
		});
	});
	jQuery('.mini-tabs .home-tabs a:first,.home-tabs a:first,.classfieds .home-tabs a:first,.column-2 a:first,.cinema-column a:first').addClass('active');
	jQuery('.tabs-holder ul').hide();
	jQuery('.mini-tabs ul:first,.tabs-holder ul:first,#classfieds ul,.column-2 ul:first,.cinema-column ul:first').show();
	jQuery('#classifieds-list').slideDown();
	
	$('#slider').AnySlider({
		animation: 'fade',
		interval: 3000,
		rtl: true,
		showControls: false,
		startSlide: 2
	});

jQuery(".timeago").timeago();

jQuery('.news-list .carousel').carousel({
  interval: 4000,
  cycle:true
})

		jQuery('#photocarousel').carousel({
		  cycle:false,
		});


});//jQuery Ends