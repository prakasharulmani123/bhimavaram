jQuery(function(){
	var cityid=jQuery('input[name=cityid]').val();
	if(cityid=="")
	{
		jQuery('#change-city').modal('show');
	}


	jQuery('.rating-container').raty({
 score: function() {
    return $(this).attr('title');
  },
  width: 150,
  readOnly: true
});
	jQuery('.rating-active-container').raty({
  width: 150,
  half : true,
  target: '.rating-text',
  click:function(score, evt) {
    jQuery('#rating-active-score').val(score);
	jQuery('.rating-text').empty().append(score+'/5.0');
  }
});

//enable wysiwyg
jQuery('.wysiwyg').wysihtml5({
	"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
	"emphasis": true, //Italics, bold, etc. Default true
	"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
	"html": false, //Button which allows you to edit the generated HTML. Default false
	"link": false, //Button to insert a link. Default true
	"image": false, //Button to insert an image. Default true,
	"color": false //Button to change color of font  
});

/*	jQuery('a.bookmark-this').click(function(){		
		jQuery('#page-loading').fadeIn();
		var data=jQuery(this).attr('rel').split(':');
		var itemtype=data[0];
		var itemid=data[1];
		jQuery.post(baseUrl+'index.php/actions/bookmark',{itemtype:itemtype,itemid:itemid},function(data){
			jQuery('a.bookmark-this').toggleClass('btn-success');
			jQuery('#page-loading').fadeOut();
		});//AJAX Ends
	});//bookmark ends*/
	 jQuery('a.bookmark-this').click(function(){	
  			if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
                window.sidebar.addPanel(document.title,window.location.href,'');
            } else if(window.external && ('AddFavorite' in window.external)) { // IE Favorite
                window.external.AddFavorite(location.href,document.title); 
            } else if(window.opera && window.print) { // Opera Hotlist
                this.title=document.title;
                return true;
            } else { // webkit - safari/chrome
                alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
            }
  });//bookmark ends
//jQuery('ul.wysihtml5-toolbar').addClass('span10');

//search ends
jQuery('#search-options li a').click(function(){
	var searchType=jQuery(this).attr('rel');
	var searchText=jQuery(this).text();
	jQuery.post(baseUrl+'index.php/start/setsearch',{type:searchType,text:searchText},function(data){
		jQuery('.searchtext').empty().append(searchText+'<b class="caret"></b>');	
		jQuery('input[name=searchtype]').val(searchType);
	});	//Ajax Ends
});//search opions ends

//jQuery('#wish-text-scroller').ticker({controls: false,        // Whether or not to show the jQuery News Ticker controls
//titleText: '',displayType: 'reveal'});
jQuery('#wish-text-scroller').liScroll({travelocity: 0.03});
jQuery('.scrolller').vTicker();

});//jQuery Ends



/*jQuery(function(){
var marquee = $('div.wish-container');
marquee.each(function() {
    var mar = $(this),indent = mar.width();
    mar.marquee = function() {
        indent--;
        mar.css('text-indent',indent);
        if (indent < -1 * mar.children('div.wish-text').width()) {
            indent = mar.width();
        }		
    };
    mar.data('interval',setInterval(mar.marquee,1800/60));
});	
setTimeout('updateWish()',60000);
	});
	
function updateWish()
{
	jQuery.post(baseUrl+'index.php/start/getwish',{},function(data){
		if(data.length>0)
		{
			jQuery('div.wish-text').empty().append(data);
		}
		setTimeout('updateWish()',60000);
		});
		
}*/