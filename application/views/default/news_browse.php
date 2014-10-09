<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<ul class="span3 pull-left" id="categories-list">
	<li <?php if(!uridata('3')){ echo ' class="active" ';}?>><?php echo anchor('news/index','Everything');?></li>
    <?php
    foreach($content['categories'] as $category)
	{
		if(uridata('3')==$category['slug'])
		{
		echo '<li class="active">'.anchor('news/index/'.$category['slug'],$category['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('news/index/'.$category['slug'],$category['name']).'</li>';		
		}
	}
	?>
</ul><!--Categories-List Ends-->
<div id="news-list" class="span10 pull-left">
<h1>News : <?php if(!uridata('3')){echo 'Everything';}else{echo ucwords(uridata('3'));}?></h1>
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
<?php echo anchor('news/'.$listing['slug'],'<img src="'.newsPicture($listing['id']).'" alt="'.$listing['title'].'" class="pull-left"/>',array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span7 pull-left">
	<h3><?php echo anchor('news/'.$listing['slug'],$listing['title']);?></h3>  
    <div class="details clearfix margintop-15"><span>Posted on </span><?php echo date("d M, Y",strtotime($listing['date_added']));?></div>
    <div class="details clearfix"><span><?php echo word_limiter(strip_tags(htmlspecialchars_decode($listing['content'])),16);?><?php echo anchor('news/'.$listing['slug'],'Read news');?></span></div>
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
<div class="center-align center abovePadding20">No news found! <br /> <?php //echo anchor('news/add','Submit a News!');?></div>
<?php }?>
</div>