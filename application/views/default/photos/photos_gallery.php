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