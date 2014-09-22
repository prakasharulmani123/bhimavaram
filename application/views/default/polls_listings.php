<div class="center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('polls/index','Polls');?></li>
 </ul>
<div id="news-list" class="span10 pull-left">
<h1 class="noline">Recent Polls</h1>
<?php 
//print_r($content['listings']);
if(count($content['listings'])!=0){?>
<ul id="listings">
<?php
	foreach($content['listings'] as $listing)
	{
		//echo $content['listings']['question'];
?>
<li class="clearfix span12">
<div class="listing-details pull-left">
	<h3><?php echo anchor('polls/'.$listing['slug'],$listing['question'].' ('.$listing['total_votes'].' Votes)');?></h3>  
	<?php
	$answers=$this->df->get_multi_row('poll_answers',array('questionid'=>$listing['id']));
    	foreach($answers as $ans)
		{
			$percent=round(($ans['votes']/$listing['total_votes'])*100,1);
	?>
    <div class="answer-box pull-left span5">
    <?php echo $ans['answer'].' ('.$percent.'% )';?>
	<div class="progress progress-success">    	
      <div class="bar" style="width: <?php echo $percent;?>%"></div>
    </div>
    </div>
	<?php
		}
	?>
    <div class="clearbig">&nbsp;</div>
    <div class="details clearfix right"><?php echo anchor('polls/'.$listing['slug'],'View Poll Details');?></div>
     <div class="clearbig">&nbsp;</div>
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
<div class="center-align center abovePadding20">No news found! <br /> <?php echo anchor('news/add','Submit a News!');?></div>
<?php }?>
</div>