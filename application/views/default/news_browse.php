<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<div class="clearfix">&nbsp;</div>

<ul class="span3 pull-left" id="categories-list">
    <li <?php if (!uridata('3')) {
    echo ' class="active" ';
} ?>><?php echo anchor('news/index', 'Everything'); ?></li>
    <?php
    foreach ($content['categories'] as $category) {
        if (uridata('3') == $category['slug']) {
            echo '<li class="active">' . anchor('news/index/' . $category['slug'], $category['name']) . '</li>';
        } else {
            echo '<li>' . anchor('news/index/' . $category['slug'], $category['name']) . '</li>';
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
</ul>
<?php 
/*
$sidebar_show_ads = showAds('image','120','250',5, 'adbox','');
echo '<div id="categories-list">';
$sidebar_show_ads_array = explode('<a ', $sidebar_show_ads);
foreach ($sidebar_show_ads_array as $sidebar_show_ad) {
	if($sidebar_show_ad){
	echo '<div class="ad side sidebar_image">';
	echo '<a ' . $sidebar_show_ad . '</a>';
	echo '</div>';
	}
}
echo '</div>';
*/
?>

<!--Categories-List Ends-->
<div id="news-list" class="span10 pull-left">
    <div class=" widget-heading">
        <h1>News : <?php if (!uridata('3')) {
        echo 'Everything';
    } else {
        echo ucwords(uridata('3'));
    } ?></h1>
    </div>
    <?php
//print_r($content['listings']);
    if (count($content['listings']) != 0) {
        ?>
        <ul id="listings">
            <?php
            foreach ($content['listings'] as $listing) {
                echo $content['listings']['title'];
                ?>
                <li class="clearfix bor-bot-thin">
                    <div class="rating"></div>
                    <div class="listing-details span7 pull-left">
                        <h3><?php echo anchor('news/' . $listing['slug'], $listing['title']); ?></h3>  
                        <div class="details clearfix margintop-15"><span>Posted on </span><?php echo date("d M, Y", strtotime($listing['date_added'])); ?></div>
                        <div class="details clearfix"><span><?php echo word_limiter(strip_tags(htmlspecialchars_decode($listing['content'])), 16); ?><?php echo anchor('news/' . $listing['slug'], 'Read news'); ?></span></div>
                    </div>
                    <?php echo anchor('news/' . $listing['slug'], '<img src="' . newsPicture($listing['id']) . '" alt="' . $listing['title'] . '" class="pull-left"/>', array('class' => 'listing-img')); ?>
                </li>
                <?php
            }
            ?>
        </ul>
        <div class="clear">&nbsp;</div>
        <?php
        echo $content['navigation'];
    } else {
        ?>
        <div class="center-align center abovePadding20">No news found! <br /> <?php //echo anchor('news/add','Submit a News!'); ?></div>
<?php } ?>
</div>
