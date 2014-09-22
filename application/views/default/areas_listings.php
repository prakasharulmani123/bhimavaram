<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('areas/index','Areas List ('.userdata('city').')');?><span class="divider">/</span></li>
  
 </ul>
<div id="news-list" class="span10 pull-left">
<h1 class="noline"><?php echo userdata('city');?> Areas List</h1>
<?php 
//print_r($content['listings']);
if(count($content['listings'])!=0){?>
<ul id="listings" class="span12 offset1">
<?php
	foreach($content['listings'] as $listing)
	{
		//echo $content['listings']['question'];
?>
<li class="clearfix span3">
	<?php echo anchor('areas/'.$listing['slug'],$listing['name']);?>
</li>
<?php		
	}
?>
</ul>
<div class="clear">&nbsp;</div>
<?php 
} else{?>
<div class="center-align center abovePadding20">No areas found!</div>
<?php }?>
</div>