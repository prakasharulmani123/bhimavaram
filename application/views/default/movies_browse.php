<!--<div class="center clearfix" style="text-align:left !important"><?php echo showAd('image','600','90');?></div>-->
<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<div class="clearfix">&nbsp;</div>
<?php //echo $start_date = date("Y-m-d H:i:s", strtotime('next Saturday'));?>
<ul class="span4 pull-left" id="categories-list">
  <li><?php echo anchor('movies/theatres','Browse Theatres',array('class'=>'btn btn-danger btn-block'));?></li>
  <div class="clearbig">&nbsp;</div>
  <li class="filter-heading">Movie Category <?php echo anchor('movies/resetfilter/category','Reset',array('class'=>'reset'));?></li>
  <?php
    foreach($content['categories'] as $category)
	{
		if(uridata('3')==$category['id'])
		{
		echo '<li class="active">'.anchor('movies/index/'.$category['id'].'/'.$content['language'],$category['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('movies/index/'.$category['id'].'/'.$content['language'],$category['name']).'</li>';		
		}
	}
	?>
  <div class="clearbig">&nbsp;</div>
  <li class="filter-heading">Language <?php echo anchor('movies/resetfilter/language','Reset',array('class'=>'reset'));?></li>
  <?php
    foreach($content['languages'] as $language)
	{
		if(uridata('4')==$language['id'])
		{
		echo '<li class="active">'.anchor('movies/index/'.$content['category'].'/'.$language['id'],$language['name']).'</li>';	
		}
		else
		{
		echo '<li>'.anchor('movies/index/'.$content['category'].'/'.$language['id'],$language['name']).'</li>';		
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
    
</ul>

<!--Categories-List Ends-->
<div id="news-list" class="span9 pull-left">
  <div class=" widget-heading">
    <h1>Browse Movies (<?php echo $content['total'];?> Movies)</h1>
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
    <li class="clearfix"> <?php echo anchor('movies/'.$listing['slug'],showAvatar($listing['picture'],$listing['name'],array('class'=>'pull-left', 'style' => 'max-width:none')),array('class'=>'listing-img'));?>
      <div class="rating"></div>
      <div class="listing-details span6 pull-left"> 
        <!--<div class="listing-rating-container"><div class="rating-container" title="<?php echo $listing['review_score'];?>"></div><div class="users-count">Rated by <?php echo $listing['total_reviews'];?> Users</div></div>-->
        <h3><?php echo anchor('movies/'.$listing['slug'],$listing['name'].' ('.urldecode($this->df->get_field_value('movie_certificate',array('id'=>$listing['certificate']),'name')).')');?></h3>
        <div class="details clearfix margintop-15"><span>Language </span> : <?php echo $this->df->get_field_value('movies_languages',array('id'=>$listing['language']),'name');?><span class="left15">Realesed on </span> : <?php echo date("d M, Y",strtotime($listing['release_date']));?></div>
        <div class="details clearfix margintop-15"><span>Cast</span> : <?php echo $listing['cast'];?></div>
        <div class="details clearfix margintop-15 padding-links"><span>Thatres</span> : <?php echo getTheatres($listing['id']);?></div>
        <div class="details clearfix"><span><?php echo anchor('movies/'.$listing['slug'],'View Movie Details');?></span></div>
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
  <div class="center-align center abovePadding20">No movies found! <br />
    <?php //echo anchor('jobs/add','Post !');?>
  </div>
  <?php }?>
</div>
