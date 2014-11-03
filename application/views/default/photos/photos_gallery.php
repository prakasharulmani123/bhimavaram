<style>
/*
.inner-left {
  margin: 20px 0 !important;
  width: 965px !important;
}
*/
.widget-heading h1 {
  border-bottom: 1px dotted #cccccc;
  line-height: 100%;
  margin: 0;
  padding: 0 0 20px;
}

.widget-heading {
	padding:0 !important;
	margin-top:15px;
}

#galleries{
margin: 15px 0;
float: left;
}

</style>
<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>


<!--<div class="center clearfix"><?php echo showAd('image','600','90');?></div>-->

<div class="widget-heading">
<h1>Photo Galleries</h1>
</div>

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