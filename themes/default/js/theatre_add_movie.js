jQuery(function(){

 jQuery(".tm-input").tagsManager({
        typeahead: true,
        //typeaheadAjaxSource: baseUrl+'index.php/post/getTags',
        //typeaheadAjaxPolling: true,
        blinkBGColor_1: '#FFFF9C',
        blinkBGColor_2: '#CDE69C',
		tagsContainer:'.tags-holder',
		tagClass:'tm-tag-warning'		,
		hiddenTagListId:'tagsList',
    });
});//jQuery Ends