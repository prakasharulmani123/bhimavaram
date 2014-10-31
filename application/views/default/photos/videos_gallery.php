<style>
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
<div class="clearfix">&nbsp;</div>

<?php
//echo youtube_thumbs('http://www.youtube.com/watch?v=BMP5Qcqq-Wc', 1);
?>
<div class="widget-heading"><h1>Browse Videos</h1></div>
<?php if(count($content['listings'])==0){?>
<div class="center-align center abovePadding20">No videos found!</div>
<?php }else{
?>

<ul id="galleries">
<?php
$utube=new YoutubeVideoDetails();
foreach($content['listings'] as $listing)
{	
	$video= parse_url($listing['url']);
	parse_str($video['query'], $query);
	$videoKey=$query['v'];
	$utube->video($videoKey);
	$imgurl=str_replace('https','http',$utube->get_thumbnail());

	//echo $listing['title'].'|'.$listing['slug'].'<br>';
?>
<li class="clearfix">
<?php 
echo anchor('videos/'.$listing['slug'],'<img src="'.get_youtube_thumb($listing['url']).'" />',array('class'=>'listing-img'));?>
<div class="details span7"><?php echo anchor('videos/'.$listing['slug'],character_limiter(ucwords(strtolower($listing['title'])),18),array('class'=>'more-info-link'));?></div>
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