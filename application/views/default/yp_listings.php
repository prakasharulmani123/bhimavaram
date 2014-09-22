<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<h1><?php echo anchor('yellowpages/index','Browse Listings');?> / <?php echo anchor('yellowpages/listings/'.$content['category']['id'],$content['category']['name']);?></h1>
<?php if(count($content['listings'])==0){?>
<?php 
	if(count($content['categories'])>0)	
	{
		echo "<ul class='cat-list clearfix curve4'>";
		foreach($content['categories'] as $cat)
		{
			echo "<li>".anchor('yellowpages/listings/'.$cat['id'],$cat['name'])."</li>";
		}
		echo "</ul>";
	}
?>
<div class="center-align center abovePadding20">No matching listings found! <br /> <?php echo anchor('yellowpages/add','Submit New Listing!');?></div>
<?php
}else{
	if(count($content['categories'])>0)	
	{
		echo "<ul class='cat-list clearfix curve4'>";
		foreach($content['categories'] as $cat)
		{
			echo "<li>".anchor('yellowpages/listings/'.$cat['id'],$cat['name'])."</li>";
		}
		echo "</ul>";
	}
?>

<ul id="listings">
<?php
foreach($content['listings'] as $listing)
{
	//echo $listing['title'].'|'.$listing['slug'].'<br>';
?>
<li class="clearfix">
<?php echo anchor('yellowpages/'.$listing['slug'],showAvatar($listing['picture'],$listing['title'],array('class'=>'pull-left')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span9">
	<div class="listing-rating-container"><div class="rating-container" title="<?php echo $listing['review_score'];?>"></div><div class="users-count">Rated by <?php echo $listing['total_reviews'];?> Users</div></div>
	<h3><?php echo anchor('yellowpages/'.$listing['slug'],$listing['title']);?></h3>    
    <div class="details clearfix top-15"><span>Category :</span> <?php echo anchor('yellowpages/listings/'.$listing['category'],$this->df->get_field_value('yp_categories',array('id'=>$listing['category']),'name')).'</span> | <span>Location :</span> '.$listing['areaname'];?><br /></div><div class="details clearfix"><span>Address :</span> <?php echo $listing['address'];?></div>
    <div class="details clearfix"><span>Phone : </span><?php echo $listing['phone']; if(strlen($listing['mobile'])>1){?> | <span>Mobile : </span><?php echo $listing['mobile'];}?></div>
    <div class="details span7"><?php echo anchor('yellowpages/'.$listing['slug'],'View more details &rarr;',array('class'=>'more-info-link'));?></div>
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