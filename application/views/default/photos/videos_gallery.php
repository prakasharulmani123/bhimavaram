<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<?php
//echo youtube_thumbs('http://www.youtube.com/watch?v=BMP5Qcqq-Wc', 1);
?><h1 class="noline">Browse Videos</h1>
<?php if(count($content['listings'])==0){?>
<div class="center-align center abovePadding20">No videos found!</div>
<?php }else{
?>

<ul id="galleries">
<?php
$utube=new YoutubeVideoDetails();
foreach($content['listings'] as $listing)
{	
	$video= parse_url($listing['url']);
	parse_str($video['query'], $query);
	$videoKey=$query['v'];
	$utube->video($videoKey);
	$imgurl=str_replace('https','http',$utube->get_thumbnail());

	//echo $listing['title'].'|'.$listing['slug'].'<br>';
?>
<li class="clearfix">
<?php 
echo anchor('videos/'.$listing['slug'],'<img src="'.get_youtube_thumb($listing['url']).'" />',array('class'=>'listing-img'));?>
<div class="details span7"><?php echo anchor('videos/'.$listing['slug'],character_limiter(ucwords(strtolower($listing['title'])),18),array('class'=>'more-info-link'));?></div>
</li>
<?php
}

?>
</ul>
<div class="clear">&nbsp;</div>
<?php 
echo $content['navigation'];
}
?>