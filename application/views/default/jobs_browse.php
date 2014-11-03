<!--<div class="center clearfix" style="text-align:left !important"><?php echo showAd('image','600','90');?></div>-->
<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<div class="clearfix">&nbsp;</div>


<?php //echo $start_date = date("Y-m-d H:i:s", strtotime('next Saturday'));?>

<ul class="span4 pull-left" id="categories-list">
	<li class="filter-heading">Job Industry  <?php echo anchor('jobs/resetfilter/industry','Reset',array('class'=>'reset'));?></li>
    <?php
    foreach($content['industries'] as $industry)
	{
		if(uridata('3')==$industry['id'])
		{
		echo '<li class="active">'.anchor('jobs/index/'.$industry['id'].'/'.$content['jobtype'].'/'.$content['jobqualification'],$industry['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('jobs/index/'.$industry['id'].'/'.$content['jobtype'].'/'.$content['jobqualification'],$industry['name']).'</li>';		
		}
	}
	?>
    <div class="clearbig">&nbsp;</div>
	<li class="filter-heading">Job Type <?php echo anchor('jobs/resetfilter/type','Reset',array('class'=>'reset'));?></li>
    <?php
    foreach($content['types'] as $type)
	{
		if(uridata('4')==$type['id'])
		{
		echo '<li class="active">'.anchor('jobs/index/'.$content['jobindustry'].'/'.$type['id'].'/'.$content['jobqualification'],$type['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('jobs/index/'.$content['jobindustry'].'/'.$type['id'].'/'.$content['jobqualification'],$type['name']).'</li>';		
		}
	}
	?>
    <div class="clearbig">&nbsp;</div>
	<li class="filter-heading">Qualification <?php echo anchor('jobs/resetfilter/qualification','Reset',array('class'=>'reset'));?></li>
    <?php
    foreach($content['qualifications'] as $qualification)
	{
		if(uridata('5')==$qualification['id'])
		{
		echo '<li class="active">'.anchor('jobs/index/'.$content['jobindustry'].'/'.$content['jobtype'].'/'.$qualification['id'],$qualification['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('jobs/index/'.$content['jobindustry'].'/'.$content['jobtype'].'/'.$qualification['id'],$qualification['name']).'</li>';		
		}
	}
	?>
    
            <li>
<?php   
	$sidebar_show_ads = showAds('image','120','250',5, 'adbox',$this->uri->segment(1));
	$sidebar_show_ads_array = explode('<a ', $sidebar_show_ads);
	$sidebar_show_ad_count = count($sidebar_show_ads_array) - 1;
	
	foreach ($sidebar_show_ads_array as $key => $sidebar_show_ad) {
		if($sidebar_show_ad){?>
        <div data-ride="carousel" class="carousel left-side-ad ad side sidebar_image slide">
          <div class="carousel-inner">
        	<?php
			for($j=1; $j<=$sidebar_show_ad_count ; $j++){
				$array_key = $j+$key > $sidebar_show_ad_count ? $j+$key - $sidebar_show_ad_count : $j+$key; ?>
                <div class="item ads300 <?php echo $j == 1 ? 'active' : '' ?>">
                <?php echo '<a ' . $sidebar_show_ads_array[$array_key] . '</a>'; ?>
                </div>
			<?php } ?>
            </div>
        </div>
        <?php
		}
	}
?>

    </li>
    
</ul><!--Categories-List Ends-->
<div id="news-list" class="span9 pull-left">
<h1>Browse Jobs (<?php echo $content['total'];?> Jobs)</h1>
<?php 
//print_r($content['listings']);
if(count($content['listings'])!=0){?>
<ul id="listings">
<?php
	foreach($content['listings'] as $listing)
	{
		//echo $content['listings']['title'];		
		$business=$this->df->get_single_row('yp_listings',array('id'=>$listing['business']));
		//print_r($business);
?>
<li class="clearfix">
<?php echo anchor('jobs/'.$listing['slug'],showAvatar($business['picture'],$listing['name'],array('class'=>'pull-left')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span6 pull-left">
	<h3><?php echo anchor('jobs/'.$listing['slug'],$listing['title']);?></h3>  
	<div class="details clearfix margintop-15"><span></span><?php 
	
	if($listing['business']!='0')
	{
		echo anchor('yellowpages/'.$business['slug'],$business['title']);
	}
	else
	{
		echo $listing['business_name'];
	}
		
	?></div>
    <div class="details clearfix margintop-15"><span>Location</span> : <?php echo $listing['location'];?><br /><span>Industry</span> : <?php echo $this->df->get_field_value('jobs_categories',array('id'=>$listing['category']),'name');?></div>
    <div class="details clearfix margintop-15"><span>Exp. </span> : <?php echo $listing['exp_from'].' - '.$listing['exp_to'].' Years';?> | <span>Salary</span>: <?php echo $listing['salary_from'].' - '.$listing['salary_to'].' Lakhs';?></div>
    <div class="details clearfix"><span><?php echo anchor('jobs/'.$listing['slug'],'View Job Details');?></span></div>
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
<div class="center-align center abovePadding20">No jobs found! <br /> <?php echo anchor('jobs/add','Post a Job Vacancy!');?></div>
<?php }?>
</div>