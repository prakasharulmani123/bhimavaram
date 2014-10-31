<style>
.breadcrumb {
  margin: 0px 0 5px !important;
  padding: 8px 3px !important;
  float: left;
}

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

</style>

<!--<div class="center clearfix"><?php echo showAd('image','600','90');?></div>-->

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

<div class="clearfix">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo 'Areas List ('.userdata('city').')';?><span class="divider">/</span></li>
  
</ul>
<div class="widget-heading"><h1><?php echo userdata('city');?> Areas List</h1></div>

<div id="news-list" class="span10 pull-left">

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