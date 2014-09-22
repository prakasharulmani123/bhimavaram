<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<h1 class="noline">Photo Galleries</h1>
<?php if(count($content['listings'])==0){?>
<div class="center-align center abovePadding20">No galleries found!</div>
<?php }else{
?>

<ul id="galleries">
<?php
foreach($content['listings'] as $listing)
{
	//echo $listing['title'].'|'.$listing['slug'].'<br>';
?>
<li class="clearfix">
<?php 
$picture=$this->df->get_field_value('photos',array('albumid'=>$listing['id']),'photo');
echo anchor('photos/gallery/'.$listing['slug'],'<img src="'.$this->settings->baseUrl().'/uploads/thumb/'.$picture.'" />',array('class'=>'listing-img'));?>
<div class="details span7"><?php echo anchor('photos/gallery/'.$listing['slug'],character_limiter(ucwords(strtolower($listing['name'])),25),array('class'=>'more-info-link'));?></div>
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