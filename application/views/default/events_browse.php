<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<?php //echo $start_date = date("Y-m-d H:i:s", strtotime('next Saturday'));?>

<ul class="span3 pull-left" id="categories-list">
	<li <?php if(!uridata('3')){ echo ' class="active" ';}?>><?php echo anchor('events/index/0/everything','Everything');?></li>
    <?php
    foreach($content['categories'] as $category)
	{
		if(uridata('3')==$category['id'])
		{
		echo '<li class="active">'.anchor('events/index/'.$category['id'].'/everything',$category['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('events/index/'.$category['id'].'/everything',$category['name']).'</li>';		
		}
	}
	?>
</ul><!--Categories-List Ends-->
<div id="news-list" class="span10 pull-left">
<h1>Events : <?php if(!uridata('3')){echo 'Everything';}else{echo $content['category']['name'];}?></h1>
<?php $alldays=array(
		'everything'=>'Everything',
		'today'=>'Today',
		'tomorrow'=>'Tomorrow',				
		'weekend'=>'Weekend',
		'month'=>'This Month'
		);
?>
<div class="btn-group">
	<?php
    foreach($alldays as $key=>$value)
	{
		$cat=uridata('3')?uridata('3'):'0';
		if($key==uridata('4'))
		{
		echo anchor('events/index/'.$cat.'/'.$key,$value,array('class'=>'btn btn-danger'));
		}
		else
		{
		echo anchor('events/index/'.$cat.'/'.$key,$value,array('class'=>'btn'));
		}
	}
	?>
</div>
<?php 
//print_r($content['listings']);
if(count($content['listings'])!=0){?>
<ul id="listings">
<?php
	foreach($content['listings'] as $listing)
	{
		echo $content['listings']['title'];
?>
<li class="clearfix">
<?php echo anchor('events/'.$listing['slug'],showAvatar($listing['picture'],$listing['name'],array('class'=>'pull-left')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span7 pull-left">
	<h3><?php echo anchor('events/'.$listing['slug'],$listing['name']);?></h3>  
    <div class="details clearfix margintop-15"><span>When </span><?php echo date("d M, Y",strtotime($listing['start_date'])).' at '.$listing['start_time'];?></div>
    <div class="details clearfix margintop-15"><span>Where </span><?php echo $listing['venue_name'].', '.$listing['venue_address'];?></div>
    <div class="details clearfix"><span><?php echo anchor('events/'.$listing['slug'],'View event details');?></span></div>
</div>
</li>
<?php		
	}
?>
</ul>
<div class="clear">&nbsp;</div>
<?php 
echo $content['navigation'];
} else{?>
<div class="center-align center abovePadding20">No events found! <br /> <?php echo anchor('events/add','Submit a New Event!');?></div>
<?php }?>
</div>