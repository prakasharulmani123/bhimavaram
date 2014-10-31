<div class="bhi-topscroll">
    <div class="carousel" data-ride="carousel" id="inner-topad">
      <div class="carousel-inner">
        <?php $executive_ads = showAdsInArray('image', '650', '90', 15, 'span6',$this->uri->segment(1)); ?>
        <div class="item active ads300">
          <?php
                $initial_executive_ads_count = 0;
                $executive_ads_count = count($executive_ads);

                foreach ($executive_ads as $executive_ad) {
                    $initial_executive_ads_count++;
					
					echo '<div class="topad">';
                    echo $executive_ad;
					echo '</div>';
					
                    if ($initial_executive_ads_count % 1 == 0) {
                        if ($executive_ads_count > $initial_executive_ads_count) {
                            echo '</div>';
                            echo '<div class="item ads300">';
                        }
                    }
                }
          ?>
      </div>
    </div>
  </div>
</div>

<!--<div class="center clearfix" style="text-align:left !important"><?php echo showAd('image','600','90');?></div>-->
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
<div class="rating"></div>
<div class="listing-details span7 pull-left">
	<h3><?php echo anchor('events/'.$listing['slug'],$listing['name']);?></h3>  
    <div class="details clearfix margintop-15"><span>When </span><?php echo date("d M, Y",strtotime($listing['start_date'])).' at '.$listing['start_time'];?></div>
    <div class="details clearfix margintop-15"><span>Where </span><?php echo $listing['venue_name'].', '.$listing['venue_address'];?></div>
    <div class="details clearfix"><span><?php echo anchor('events/'.$listing['slug'],'View event details');?></span></div>
</div>
<?php echo anchor('events/'.$listing['slug'],showAvatar($listing['picture'],$listing['name'],array('class'=>'pull-left', 'style' => 'max-width:none')),array('class'=>'listing-img'));?>
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