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
	$sidebar_show_ads = showAds('image','300','300',5, 'adbox');
	$sidebar_show_ads_array = explode('<a ', $sidebar_show_ads);
	foreach ($sidebar_show_ads_array as $sidebar_show_ad) {
		if($sidebar_show_ad){
		echo '<div class="ad sidebar_image">';
		echo '<a ' . $sidebar_show_ad . '</a>';
		echo '</div>';
		}
	}
	?>
</div><!--SideBar Ends-->