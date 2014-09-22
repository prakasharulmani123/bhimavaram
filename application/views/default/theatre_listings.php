<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<h1><?php echo anchor('movies/theatres','Browse Theatres');?></h1>
<?php if(count($content['listings'])==0){?>
<div class="center-align center abovePadding20">No matching listings found!</div>
<?php }else{
?>

<ul id="listings">
<?php
foreach($content['listings'] as $listing)
{
	//echo $listing['title'].'|'.$listing['slug'].'<br>';
?>
<li class="clearfix">
<?php echo anchor('movies/theatre/'.$listing['slug'],showAvatar($listing['picture'],$listing['name'],array('class'=>'pull-left')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span9">
	<div class="listing-rating-container"><div class="rating-container" title="<?php echo $listing['review_score'];?>"></div><div class="users-count">Rated by <?php echo $listing['total_reviews'];?> Users</div></div>
	<h3><?php echo anchor('movies/theatre/'.$listing['slug'],$listing['name']);?></h3>    
    <div class="details clearfix"><?php echo $listing['address'];?></div>
    <div class="details clearfix"><span>Timings </span> : <?php echo $listing['timings_from'].' - '.$listing['timings_to'];?></div>
    <div class="details clearfix"><span>Phone </span> : <?php echo $listing['phone'];?></div>
    <div class="details clearfix links-list"><span>Movies Playing : </span><?php echo getMovies($listing['id']);?></div>
    <div class="details span7"><?php echo anchor('movies/theatre/'.$listing['slug'],'View more details &rarr;',array('class'=>'more-info-link'));?></div>
</div>
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