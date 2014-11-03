<?php //echo $start_date = date("Y-m-d H:i:s", strtotime('next Saturday'));?>
<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<!--<div class="center clearfix" style="text-align:left !important"><?php echo showAd('image','600','90');?></div>-->
<div class="clearfix">&nbsp;</div>
<ul class="span3 pull-left cate-list" id="categories-list">
	<li class="filter-heading">Categories</li>
    <?php
	//print_r($content['categories']);
//	$content['parentcategory'];
    foreach($content['categories'] as $category)
	{
		if($content['parentcategory']==$category['id'])
		{
			$subs=$this->df->get_multi_row('yp_categories',array('parentid'=>$category['id']));
			echo '<li>'.anchor('deals/index/'.$category['id'],$category['name']);
			echo "<ul class='sub-cats'>";
			foreach($subs as $sub)
			{
				if($content['category']==$sub['id'])
				{
				echo '<li class="active">'.anchor('deals/index/'.$sub['id'],$sub['name']).'</li>';	
				}
				else
				{
				echo '<li>'.anchor('deals/index/'.$sub['id'],$sub['name']).'</li>';		
				}				
			}
			echo '</ul></li>';
	
		}
		else
		{
			if($content['category']==$category['id'])
			{
				$subs=$this->df->get_multi_row('yp_categories',array('parentid'=>$category['id']));
				echo '<li>'.anchor('deals/index/'.$category['id'],$category['name']);
				echo "<ul class='sub-cats'>";
				foreach($subs as $sub)
				{
					if($content['category']==$sub['id'])
					{
					echo '<li class="active">'.anchor('deals/index/'.$sub['id'],$sub['name']).'</li>';	
					}
					else
					{
					echo '<li>'.anchor('deals/index/'.$sub['id'],$sub['name']).'</li>';		
					}				
				}
				echo '</ul></li>';
			}
			else
			{
				echo '<li>'.anchor('deals/index/'.$category['id'],$category['name']).'</li>';
			}
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
          <div class="carousel-inner" style="height:256px;">
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
<div id="news-list" class="span10 pull-left">

<div class=" widget-heading">
<h1><?php if($content['category']=='0'){echo 'Browse Deals';} echo $this->df->get_field_value('yp_categories',array('id'=>$content['category']),'name');?> (<?php echo $content['total'];?> Deals)</h1>
</div>
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
<?php echo anchor('deals/'.$listing['slug'],showAvatar($listing['picture'],$listing['title'],array('class'=>'pull-left', 'style' => 'max-width:none')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span7 pull-left">
	<!--<div class="listing-rating-container pull-right"><div class="rating-container" title="<?php echo $listing['review_score'];?>"></div><div class="users-count">Rated by <?php echo $listing['total_reviews'];?> Users</div></div>-->
	<h3><?php echo anchor('deals/'.$listing['slug'],$listing['title']);?></h3>  
	<div class="details clearfix margintop-15"><span>at</span> <?php echo anchor('yellowpages/'.$business['slug'],$business['title']);?></div>
    <div class="details clearfix margintop-15"><span>Duration</span> : <?php echo date("d M, Y",strtotime($listing['starts_on'])).' - '.date("d M, Y",strtotime($listing['closes_on']));?><br /><span>Description</span> : <?php echo word_limiter(strip_tags(htmlspecialchars_decode($listing['description'])),5);?></div>
   <div class="details clearfix"><span><?php echo anchor('deals/'.$listing['slug'],'View Deal Details');?></span></div>
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
<div class="center-align center abovePadding20">No jobs found! <br /> <?php //echo anchor('jobs/add','Post !');?></div>
<?php }?>
</div>