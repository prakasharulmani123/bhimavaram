<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('photos/index','Photo Galleries');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['album']['name'],8);?></li>
</ul>
 <h1 class="noline"><?php echo $content['album']['name'];?> <p><?php echo htmlspecialchars_decode($content['album']['description']);?></p>
</h1>
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
//$picture=$this->df->get_field_value('photos',array('albumid'=>$listing['id']),'photo');
echo anchor('photos/show/'.$listing['id'],'<img src="'.$this->settings->baseUrl().'/uploads/thumb/'.$listing['photo'].'" />',array('class'=>'listing-img'));?>
<div class="details span7"><?php echo anchor('photos/show/'.$listing['id'],character_limiter(ucwords(strtolower($listing['title'])),25),array('class'=>'more-info-link'));?></div>
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
<div class="clearbig">&nbsp;</div>