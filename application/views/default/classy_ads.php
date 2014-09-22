<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<h1><?php echo anchor('classifieds/index','Browse Ads');?> / <?php echo anchor('classifieds/ads/'.$content['category']['id'],$content['category']['name']);?></h1><?php if(count($content['listings'])==0){?>
<?php 
	if(count($content['categories'])>0)	
	{
		echo "<ul class='cat-list clearfix curve4'>";
		foreach($content['categories'] as $cat)
		{
			echo "<li>".anchor('classifieds/ads/'.$cat['id'],$cat['name'])."</li>";
		}
		echo "</ul>";
	}
?>
<div class="center-align center abovePadding20">No matching ads found! <br /> <?php echo anchor('classifieds/add','Submit New Listing!');?></div>
<?php
}else{
	if(count($content['categories'])>0)	
	{
		echo "<ul class='cat-list clearfix curve4'>";
		foreach($content['categories'] as $cat)
		{
			echo "<li>".anchor('classifieds/ads/'.$cat['id'],$cat['name'])."</li>";
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
<?php echo anchor('classifieds/'.$listing['slug'],showAvatar($listing['picture'],$listing['title'],array('class'=>'pull-left')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span9">
	<h3><?php echo anchor('classifieds/'.$listing['slug'],$listing['title']);?></h3>    
    <div class="details clearfix top-15">
    <span>Category :</span><?php echo anchor('classifieds/ads/'.$listing['category'],$this->df->get_field_value('classy_categories',array('id'=>$listing['category']),'name'));?>
    <span class="left10">Ad Type : </span><?php echo $listing['adtype'];?>
    </div>
    <div class="details clearfix top-15">
    	<span>Price :</span><?php if($listing['free']=='1'){echo ' Free';} else{ echo ' <i class="icon-rupee"></i>&nbsp;'.$listing['price'];}?>
	    <span class="left10">Date Posted : </span><?php echo date("d M, Y",strtotime($listing['date_posted']));?>
    </div>
    <div class="details span7"><?php echo anchor('classifieds/'.$listing['slug'],'View more details &rarr;',array('class'=>'more-info-link'));?></div>
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