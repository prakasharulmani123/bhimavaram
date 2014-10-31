<div class="span5 pull-right" id="sidebar">
  <?php if($content['single_page'])
	{
		?>
  <!--<div class="share-btn pull-left">
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_google_plusone_share"></a>
        <a class="addthis_button_pinterest_share"></a>
        <a class="addthis_button_email"></a>
        </div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51ed30806c650b5f"></script>
	</div>
    <div class="clearbig">&nbsp;</div>-->
  <?php
	}
	?>
  <?php 
	$controller = $this->uri->segment(1);
	if($controller == 'importantnews'){
		$controller = 'news';
	}
	$sidebar_show_ads = showAds('image','300','300',5, 'adbox',$controller);
	$sidebar_show_ads_array = explode('<a ', $sidebar_show_ads);
	$sidebar_show_ad_count = count($sidebar_show_ads_array) - 1;
	
	foreach ($sidebar_show_ads_array as $key => $sidebar_show_ad) {
		if($sidebar_show_ad){ ?>
        <div data-ride="carousel" class="carousel right-side-ad ad side sidebar_image slide">
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
</div>
<!--SideBar Ends-->

