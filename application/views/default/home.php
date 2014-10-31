<style type="text/css">
/*
ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 32px;
	border-bottom: 1px solid #999;
	border-left: 1px solid #999;
	width: 100%;
}
ul.tabs li {
	float: left;
	margin: 0;
	padding: 0;
	height: 31px;
	line-height: 31px;
	border: 1px solid #999;
	border-left: none;
	margin-bottom: -1px;
	background: #e0e0e0;
	overflow: hidden;
	position: relative;
}
ul.tabs li a {
	text-decoration: none;
	color: #000;
	display: block;
	font-size: 1.2em;
	padding: 0 20px;
	border: 1px solid #fff;
	outline: none;
}
ul.tabs li a:hover {
	background: #ccc;
}	
html ul.tabs li.active a, html ul.tabs li.active a:hover  {
	color:#FFF !important;
	background: #000;
	border-bottom: 1px solid #fff;
	
}
.tab_container {
	border: 1px solid #999;
	border-top: none;
	clear: both;
	float: left; 
	width: 100%;
	background: #fff;
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
}
.tab_content {
	padding: 20px;
	font-size: 1.2em;
}
.tab_content h2 {
	font-weight: normal;
	padding-bottom: 10px;
	border-bottom: 1px dashed #ddd;
	font-size: 1.8em;
}
.tab_content h3 a{
	color: #254588;
}
.tab_content img {
	float: left;
	margin: 0 20px 20px 0;
	border: 1px solid #ddd;
	padding: 5px;
}
*/
</style>


<div class="bhi-bodycont">
  <?php if(hiddencities(userdata('cityid')) == false) {?> 
  <div class="bhi-topscroll">
  	
<ul id="flexiselDemo3">
<?php $executive_ads = showAdsInArray('image', '300', '60', 15, 'span6'); ?>
  <?php
	$initial_executive_ads_count = 0;
	$executive_ads_count = count($executive_ads);

		foreach ($executive_ads as $executive_ad) { ?>
	    <li><?php  echo $executive_ad; ?></li>
<?php $initial_executive_ads_count++; 
}
?>
</ul>    


<!--<style type="text/css">
.carousel-inner .active.left { left: -10%; right:10%;}
.carousel-inner .next        { left: 10%; right:-10%;}
/*
.carousel-control.left,.carousel-control.right {background-image:none no-repeat; }

.col-lg-2 {width: 20%;}
*/
</style>-->

<?php /*?><div class="col-lg-6 col-md-offset-3">
<div class="carousel slide" id="myCarousel">
<?php $executive_ads = showAdsInArray('image', '300', '60', 15, 'span6'); ?>
  <div class="carousel-inner" style="height:65px; margin-left:10px;">
  <?php
	$initial_executive_ads_count = 0;
	$executive_ads_count = count($executive_ads);

	//for($i=1; $i<=2; $i++){
		foreach ($executive_ads as $executive_ad) { ?>
    <div class="item <?php echo $initial_executive_ads_count == 0 ? 'active' : '' ?>">
      <div class="col-lg-6" style="float:left;padding:5px;"><?php  echo $executive_ad; ?></div>
    </div>
<?php $initial_executive_ads_count++; 
}
//}	?>
    
  </div>
  <!--<a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>-->
</div>
</div><?php */?>

    <!--<div class="carousel" id="executive_ads" data-ride="carousel">
      <div class="carousel-inner">
        <?php $executive_ads = showAdsInArray('image', '300', '60', 15, 'span6'); ?>
        <div class="item active ads300">
          <?php
                $initial_executive_ads_count = 0;
                $executive_ads_count = count($executive_ads);

                foreach ($executive_ads as $executive_ad) {
                    $initial_executive_ads_count++;
					
					echo '<div class="topad">';
                    echo $executive_ad;
					echo '</div>';
					
                    if ($initial_executive_ads_count % 3 == 0) {
                        if ($executive_ads_count > $initial_executive_ads_count) {
                            echo '</div>';
                            echo '<div class="item ads300">';
                        }
                    }
                }
          ?>
        </div>
      </div>
    </div>-->
    
  </div>
  
  <div class="slider">
  
	<?php $count_jumbtron = count($content['topnews']); ?>
    <?php if($count_jumbtron > 0){ ?>
    
    <div id="sliderFrame">
        <div id="homeslider">
            <?php 
			foreach ($content['topnews'] as $k => $citynews) { 
				if(substr($citynews['slug'],0,4) == 'http'){
					echo '<a href="'.$citynews['slug'].'"><img src="' . importantnewsOrgPicture($citynews['id']) . '" alt="#htmlcaption'.$k.'"/></a>';
				}
				else{
					echo anchor('importantnews/' . $citynews['slug'], '<img src="' . importantnewsOrgPicture($citynews['id']) . '" alt="#htmlcaption'.$k.'"/>');
				}
			} 
			
			?>
        </div>
        <?php foreach ($content['topnews'] as $k => $citynews) { ?>
        <div id="htmlcaption<?php echo $k?>" style="display: none;">
        <?php
                echo '<div class="caption-news">';
                echo '<div class="caption_title">';
				
				if(substr($citynews['slug'],0,4) == 'http'){
					echo '<a href="'.$citynews['slug'].'">'.word_limiter($citynews['title'], 11).'</a>';
				}
				else{
					echo anchor('importantnews/' . $citynews['slug'], word_limiter($citynews['title'], 11));
				}
				echo '</div>';
				
                echo '<div class="caption_desc">'.  word_limiter(strip_tags(html_entity_decode($citynews['content'])),20).'</div>';
                echo '<div class="read_more">';
                if(substr($citynews['slug'],0,4) == 'http'){
					echo '<a href="'.$citynews['slug'].'">Read More >></a>';
				}
				else{
	                echo anchor('importantnews/' . $citynews['slug'], 'Read More >>');
				}
                echo '</div></div>';
			?>
        </div>
        <?php } ?>
    </div>
    
    <!--<div id="jumbtron_carousel" class="carousel slide">
    
    
    
      <?php
            echo '<ol class="carousel-indicators">';
            foreach ($content['topnews'] as $k => $citynews) {
                echo '<li data-target="#jumbtron_carousel" data-slide-to="' . $k . '" ';
                if ($k == 0)
                    echo 'class="active"';
                echo '></li>';
            }
            echo '</ol>';
            echo '<div class="carousel-inner">';
            foreach ($content['topnews'] as $i => $citynews) {
                echo '<div class="item ';
                if ($i == 0)
                    echo 'active';
                echo '"><div class="news-image">';
				
                if(substr($citynews['slug'],0,4) == 'http'){
					echo '<a href="'.$citynews['slug'].'"><img src="' . importantnewsPicture($citynews['id']) . '"/></a>';
				}
				else{
					echo anchor('importantnews/' . $citynews['slug'], '<img src="' . importantnewsPicture($citynews['id']) . '"/>');
				}
				
                echo '</div><div class="caption-news">';
                echo '<div class="caption_title">';
				
				if(substr($citynews['slug'],0,4) == 'http'){
					echo '<a href="'.$citynews['slug'].'">'.word_limiter($citynews['title'], 11).'</a>';
				}
				else{
					echo anchor('importantnews/' . $citynews['slug'], word_limiter($citynews['title'], 11));
				}
				echo '</div>';
				
                echo '<div class="caption_desc">'.  word_limiter(strip_tags(html_entity_decode($citynews['content'])),20).'</div>';
                echo '<div class="read_more">';
                if(substr($citynews['slug'],0,4) == 'http'){
					echo '<a href="'.$citynews['slug'].'">Read More >></a>';
				}
				else{
	                echo anchor('importantnews/' . $citynews['slug'], 'Read More >>');
				}
                echo '</div></div></div>';
            }
            echo '</div>';
            ?>
    </div>-->
    <?php }else{ ?>
    	<div class="coming-soon">Coming Soon</div>
    <?php } ?>
  </div>
  
  
  <div class="slider-right">
    <div class="bhi-videocont">
      <div class="widget-heading">
        <h2> Video News </h2>
      </div>
      <div class="widget-content">
        <div class="carousel slide" id="video_news">
          <div class="carousel-inner">
            <?php 
			  $utube = new YoutubeVideoDetails();
			  $videos_cnt = 0;
              $ttl_videos_cnt = count($content['videos']);
			  ?>
            <?php foreach($content['videos'] as $x => $video){ ?>
            <div class="item <?php if($x == 0) echo "active"?>"> <?php echo anchor('videos/' . $video['slug'], '<img src="' . get_youtube_thumb($video['url']) . '" width="239" height="154"/>'); ?> 
			<div class="video_news_title">
            <?php 
			if(strlen($video['title']) > 20) { 
				$video_title = substr($video['title'], 0, 20).'...';
			} else {
				$video_title = $video['title'];
			}
			echo anchor('videos/' . $video['slug'], $video_title);
			?>
            </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      
      <div class="ad">
      
        <div class="carousel slide home_page_right_side_ad">
          <div class="carousel-inner">
            <?php 
			$ads150 = showAds('image', '300', '150', 5, 'ad1'); 
            $ads150_list = explode('<a ', $ads150);
			$first_ads = array();
            foreach($ads150_list as $ad150){ 
				if($ad150){
					$first_ads[] = $ad150;
				}
			}
			if(count($first_ads) > 0){
				foreach($first_ads as $first_ad_key => $first_ad_value){
			?>
					<div class="item <?php if($first_ad_key == 0) echo "active"?>"> <?php echo '<a ' . $first_ad_value . '</a>'; ?></div>
			<?php
                }
			}
			?>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
  <div class="home-left">
    <div class="imp-cont">
      <div class="widget-heading">
        <h2>IMP Phones</h2>
      </div>
      <div class="imp-bg">
      <?php $count_numbers = count($content['numbers']);?>
             <?php if($count_numbers > 0){ ?>
        <ul id="phone-numbers" class="news-list">
          <?php
            foreach ($content['numbers'] as $number) {
                echo '<li><a href="javascript:void(0)">' . $number['name'] . ' : ' . $number['phone'] . '</a></li>';
            }
            ?>
        </ul>
         <?php }else{ ?>
         		<div class="coming-soon" style="min-height:130px !important;">Coming Soon</div>
		  <?php } ?>
      </div>
    </div>
    <div class="imp-cont">
      <div class="widget-heading">
        <h2>Movies </h2><?php echo anchor('movies/index', 'View All'); ?><!--<a href="#">View All </a>--></div>
      <div class="moviescroll">
        <div class="movie-thumb">
          <div id="latest_movie1" class="widget_body carousel slide vertical">
            <div class="carousel-inner">
            <marquee direction="up" behavior="scroll" style="overflow: hidden;" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);">
              <?php foreach($content['movies'] as $x => $movie){ ?>
              <div class="item <?php if($x == 0) echo "active"?>"> 
              <?php echo anchor('movies/' . $movie['slug'], '<img src="' . $this->settings->uploaderPath().$movie["picture"] . '" width="204" height="152"/>'); ?>
                <div class="movie-name"> <?php echo anchor('movies/'.$movie['slug'], word_limiter($movie['name'], 10))?></div>
              </div>
              <?php } ?>
              </marquee>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="home-right">
  
    <div class="bhi-tabs-cont">
      <div class="widget-heading">
        <h2><?php echo userdata('city'); ?></h2>
      </div>
      
      <div class="container bhi-tabs-content">

    <ul class="tabs nav-tabs">
          <li><a href="#news_tab">News</a> </li>
          <li><a href="#cinema_tab">Cinema</a></li>
          <li><a href="#events_tab">Events</a></li>
          <li><a href="#deals_tab">Deals</a></li>
          <li><a href="#jobs_tab">Jobs</a> </li>
          <li><a href="#videos_tab">Videos</a></li>
    </ul>
    <div class="tab_container tab-content">
          <!--news-->
          <div class="tab_content" id="news_tab">
			 <?php $count_citynews = count($content['citynews']);?>
             <?php if($count_citynews > 0){ ?>

            <div id="topnews-slider" class="carousel slide news-slider" >
             
              <div class="carousel-inner">
                <?php
				
				foreach ($content['citynews'] as $m => $citynews) {
					echo '<div class="item ';
					if ($m == 0)
						echo ' active ';
					echo '">';
					echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
					if ($m == 0)
						echo ' class="active" ';
					echo '></li>';
					?>
			<div class="news-thumb">
              <img src="<?php echo newsPicture($citynews['id']) ?>" width="127" height="112" alt="<?php echo $citynews['title']?>"> 
            </div>
			<div class="tabsmall-content">
			  <?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 11)) ?>
	  		 <p> <?php echo word_limiter(strip_tags(html_entity_decode($citynews['content'])),20); ?> </p>
            </div>
            <div class="clr"></div>
				<?php
					echo '</div>';
					$m++;
				}
				?>
              </div>
            </div>

            <!--carusel ends-->
            <ul>
              <?php
                    $citynewscnt = 0;
                    foreach ($content['citynews'] as $citynews) {
                        if ($citynewscnt < 5) {
                            ?>
              <li><?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 5)); ?></li>
              <?php
                            $citynewscnt++;
                        }
                    }
                    ?>
              <li class="more-link"><?php echo anchor('news/index', 'More News &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
			  <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--cinema-->
          <div class="tab_content" id="cinema_tab">
			 <?php $count_cinenews = count($content['cinenews']);?>
             <?php if($count_cinenews > 0){ ?>
             
             <div id="topcinenews-slider" class="carousel slide cinenews-slider" >
             
              <div class="carousel-inner">
                <?php
				
				foreach ($content['cinenews'] as $m => $cinenews) {
					echo '<div class="item ';
					if ($m == 0)
						echo ' active ';
					echo '">';
					echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
					if ($m == 0)
						echo ' class="active" ';
					echo '></li>';
					?>
			<div class="news-thumb">
              <img src="<?php echo newsPicture($cinenews['id']) ?>" width="127" height="112" alt="<?php echo $cinenews['title']?>"> 
            </div>
			<div class="tabsmall-content">
			  <?php echo anchor('news/' . $cinenews['slug'], word_limiter($cinenews['title'], 11)) ?>
	  		 <p> <?php echo word_limiter(strip_tags(html_entity_decode($cinenews['content'])),20); ?> </p>
            </div>
            <div class="clr"></div>
				<?php
					echo '</div>';
					$m++;
				}
				?>
              </div>
            </div>

            <ul id="cinema-news" class="news-list">
              <?php
				$pcount = 1;
				foreach ($content['cinenews'] as $citynews) {
					if ($pcount < 6) {
			  ?>
              	<li><?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 5)); ?></li>
              <?php
					$pcount++;
					}
				}
		      ?>
              <li class="more-link"><?php echo anchor('news/index/cinema', 'More Cinema &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
			  <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>

          </div>
          
          <!--events-->
          <div class="tab_content" id="events_tab">
			 <?php $count_events = count($content['events']);?>
             <?php if($count_events > 0){ ?>
             
             <div id="events-slider" class="carousel slide events-slider" >
             
              <div class="carousel-inner">
                <?php
				
				foreach ($content['events'] as $m => $events) {
					echo '<div class="item ';
					if ($m == 0)
						echo ' active ';
					echo '">';
					echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
					if ($m == 0)
						echo ' class="active" ';
					echo '></li>';
					?>
			<div class="news-thumb">
              <img src="<?php echo eventsPicture($events['id']) ?>" width="127" height="112" alt="<?php echo $events['name']?>"> 
            </div>
			<div class="tabsmall-content">
			  <?php echo anchor('events/' . $events['slug'], word_limiter($events['name'], 11)) ?>
	  		 <p> <?php echo word_limiter(strip_tags(html_entity_decode($events['description'])),20); ?> </p>
            </div>
            <div class="clr"></div>
				<?php
					echo '</div>';
					$m++;
				}
				?>
              </div>
            </div>
            
            <ul id="events" class="news-list">
              <?php
                    foreach ($content['events'] as $event) {
                        ?>
              <li><?php echo anchor('events/' . $event['slug'], word_limiter($event['name'], 5)); ?></li>
              <?php
                    }
                    ?>
              <li class="more-link"><?php echo anchor('events/index', 'More Events &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
             <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--deals-->
          <div class="tab_content" id="deals_tab">
          <?php $count_deals = count($content['deals']);?>
             <?php if($count_deals > 0){ ?>
            <div id="deals" class="carousel slide news-list">
              <div class="carousel-inner">
                <?php foreach ($content['deals'] as $key => $deal) { ?>
                <div class="item <?php if($key == 0) echo "active"?>">
                  <div class="news-thumb">
                  	<img src="<?php echo $this->settings->uploaderPath() . $deal['picture'] ?>" width="127" height="112" alt="<?php echo $deal['title']?>"/>
                  </div>
                  <div class="tabsmall-content">
				  	<?php echo anchor('deals/'.$deal['slug'], word_limiter($deal['title'], 11)); ?><br/>
                    <?php echo word_limiter(strip_tags(html_entity_decode($deal['description'])),20); ?> 
                  </div>
                  <div class="clr"></div>
                </div>
                <?php } ?>
                <!--<a class="class-links right span11" data-slide="next" href="#deals">Browse more deals<i class="icon-circle-arrow-right"></i></a>-->
              </div>
            </div>
            
            <ul id="deals" class="news-list">
              <?php
			  		$dcount = 0;
                    foreach ($content['deals'] as $deal) {
						if($dcount == 5){break;}
                        ?>
              <li><?php echo anchor('deals/' . $deal['slug'], word_limiter($deal['title'], 5)); ?></li>
              <?php
			  	$dcount++;
                    }
                    ?>
              <li class="more-link"><?php echo anchor('deals/index', 'More Deals &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
            <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--jobs-->
          <div class="tab_content" id="jobs_tab">
          <?php $count_jobs = count($content['jobs']);?>
             <?php if($count_jobs > 0){ ?>
            <div id="jobs" class="carousel slide  news-list"> 
              <!-- Carousel items -->
              <div class="carousel-inner">
                <?php foreach ($content['jobs'] as $job_key => $job) { ?>
                <div class="item <?php if($job_key == 0) echo "active"?>">
                  <!--<div class="news-thumb">
                  	<img src="<?php echo $this->settings->uploaderPath() . $deal['picture'] ?>" width="127" height="112" alt=""/>
                  </div>-->
                  <div class="tabsmall-content">
				  	<?php echo anchor('jobs/'.$job['slug'], word_limiter($job['title'], 11)); ?><br/>
                    <?php echo word_limiter(strip_tags(html_entity_decode($job['description'])),20); ?> 
                  </div>
                  <div class="clr"></div>
                </div>
                <?php } ?>
                <!--<a class="class-links right" data-slide="next" href="#jobs">More Jobs<i class="icon-circle-arrow-right"></i></a>-->
              </div>
              <!--/carousel-inner-->
            </div>
            
            <ul id="jobs" class="news-list">
              <?php
			  		$jcount = 0;
                    foreach ($content['jobs'] as $jobs) {
						if($jcount == 5){break;}
                        ?>
              <li><?php echo anchor('jobs/' . $jobs['slug'], word_limiter($jobs['title'], 5)); ?></li>
              <?php
			  	$jcount++;
                    }
                    ?>
              <li class="more-link"><?php echo anchor('jobs/index', 'More Jobs &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
            <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--videos-->
          <div class="tab_content" id="videos_tab">
          <?php $count_videos = count($content['videos']);?>
             <?php if($count_videos > 0){ ?>
            <div id="videos" class="carousel slide  news-list image-list moveies-video-carousel"> 
              <!-- Carousel items -->
              
              <div class="carousel-inner">
                <?php foreach ($content['videos'] as $video_key => $video) { ?>
                <div class="item <?php if($video_key == 0) echo "active"?>">
                  <div class="news-thumb">
                  	<img src="<?php echo get_youtube_thumb($video['url']) ?>" width="127" height="112" alt="<?php echo $video['title']?>"/>
                  </div>
                  <div class="tabsmall-content">
				  	<?php echo anchor('videos/'.$video['slug'], word_limiter($video['title'], 11)); ?><br/>
                  </div>
                  <div class="clr"></div>
                </div>
                <?php } ?>
                <!--<a class="class-links right" data-slide="next" href="#videos">Browse more videos<i class="icon-circle-arrow-right"></i></a>-->
              </div>
            </div>
            
            <ul id="videos" class="news-list">
              <?php
			  		$vcount = 0;
                    foreach ($content['videos'] as $videos) {
						if($vcount == 5){break;}
                        ?>
              <li><?php echo anchor('videos/' . $videos['slug'], word_limiter($videos['title'], 5)); ?></li>
              <?php
			  	$vcount++;
                    }
                    ?>
              <li class="more-link"><?php echo anchor('videos/index', 'More Videos &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
             <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>

    </div>
</div>


      <?php /*?><div class="bhi-tabs-content">
        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" href="#news_tab">News</a> </li>
          <li><a data-toggle="tab" href="#cinema_tab">Cinema</a></li>
          <li><a data-toggle="tab" href="#events_tab">Events</a></li>
          <li><a data-toggle="tab" href="#deals_tab">Deals</a></li>
          <li><a data-toggle="tab" href="#jobs_tab">Jobs</a> </li>
          <li><a data-toggle="tab" href="#videos_tab">Videos</a></li>
          
        </ul>
        <div class="tab-content">
       	  
          <!--news-->
          <div class="tab-pane fade in active" id="news_tab">
			 <?php $count_citynews = count($content['citynews']);?>
             <?php if($count_citynews > 0){ ?>

            <div id="topnews-slider" class="carousel slide news-slider" >
             
              <div class="carousel-inner">
                <?php
				
				foreach ($content['citynews'] as $m => $citynews) {
					echo '<div class="item ';
					if ($m == 0)
						echo ' active ';
					echo '">';
					echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
					if ($m == 0)
						echo ' class="active" ';
					echo '></li>';
					?>
			<div class="news-thumb">
              <img src="<?php echo newsPicture($citynews['id']) ?>" width="127" height="112" alt="<?php echo $citynews['title']?>"> 
            </div>
			<div class="tabsmall-content">
			  <?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 11)) ?>
	  		 <p> <?php echo word_limiter(strip_tags(html_entity_decode($citynews['content'])),20); ?> </p>
            </div>
            <div class="clr"></div>
				<?php
					echo '</div>';
					$m++;
				}
				?>
              </div>
            </div>

            <!--carusel ends-->
            <ul>
              <?php
                    $citynewscnt = 0;
                    foreach ($content['citynews'] as $citynews) {
                        if ($citynewscnt < 5) {
                            ?>
              <li><?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 5)); ?></li>
              <?php
                            $citynewscnt++;
                        }
                    }
                    ?>
              <li class="more-link"><?php echo anchor('news/index', 'More News &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
			  <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--cinema-->
          <div class="tab-pane fade" id="cinema_tab">
			 <?php $count_cinenews = count($content['cinenews']);?>
             <?php if($count_cinenews > 0){ ?>
             
             <div id="topcinenews-slider" class="carousel slide cinenews-slider" >
             
              <div class="carousel-inner">
                <?php
				
				foreach ($content['cinenews'] as $m => $cinenews) {
					echo '<div class="item ';
					if ($m == 0)
						echo ' active ';
					echo '">';
					echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
					if ($m == 0)
						echo ' class="active" ';
					echo '></li>';
					?>
			<div class="news-thumb">
              <img src="<?php echo newsPicture($cinenews['id']) ?>" width="127" height="112" alt="<?php echo $cinenews['title']?>"> 
            </div>
			<div class="tabsmall-content">
			  <?php echo anchor('news/' . $cinenews['slug'], word_limiter($cinenews['title'], 11)) ?>
	  		 <p> <?php echo word_limiter(strip_tags(html_entity_decode($cinenews['content'])),20); ?> </p>
            </div>
            <div class="clr"></div>
				<?php
					echo '</div>';
					$m++;
				}
				?>
              </div>
            </div>

            <ul id="cinema-news" class="news-list">
              <?php
				$pcount = 1;
				foreach ($content['cinenews'] as $citynews) {
					if ($pcount < 6) {
			  ?>
              	<li><?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 5)); ?></li>
              <?php
					$pcount++;
					}
				}
		      ?>
              <li class="more-link"><?php echo anchor('news/index/cinema', 'More News &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
			  <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>

          </div>
          
          <!--events-->
          <div class="tab-pane fade" id="events_tab">
			 <?php $count_events = count($content['events']);?>
             <?php if($count_events > 0){ ?>
             
             <div id="events-slider" class="carousel slide events-slider" >
             
              <div class="carousel-inner">
                <?php
				
				foreach ($content['events'] as $m => $events) {
					echo '<div class="item ';
					if ($m == 0)
						echo ' active ';
					echo '">';
					echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
					if ($m == 0)
						echo ' class="active" ';
					echo '></li>';
					?>
			<div class="news-thumb">
              <img src="<?php echo eventsPicture($events['id']) ?>" width="127" height="112" alt="<?php echo $events['name']?>"> 
            </div>
			<div class="tabsmall-content">
			  <?php echo anchor('events/' . $events['slug'], word_limiter($events['name'], 11)) ?>
	  		 <p> <?php echo word_limiter(strip_tags(html_entity_decode($events['description'])),20); ?> </p>
            </div>
            <div class="clr"></div>
				<?php
					echo '</div>';
					$m++;
				}
				?>
              </div>
            </div>
            
            <ul id="events" class="news-list">
              <?php
                    foreach ($content['events'] as $event) {
                        ?>
              <li><?php echo anchor('events/' . $event['slug'], word_limiter($event['name'], 5)); ?></li>
              <?php
                    }
                    ?>
              <li class="more-link"><?php echo anchor('events/index', 'More Events &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
             <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--deals-->
          <div class="tab-pane fade" id="deals_tab">
          <?php $count_deals = count($content['deals']);?>
             <?php if($count_deals > 0){ ?>
            <div id="deals" class="carousel slide news-list">
              <div class="carousel-inner">
                <?php foreach ($content['deals'] as $key => $deal) { ?>
                <div class="item <?php if($key == 0) echo "active"?>">
                  <div class="news-thumb">
                  	<img src="<?php echo $this->settings->uploaderPath() . $deal['picture'] ?>" width="127" height="112" alt="<?php echo $deal['title']?>"/>
                  </div>
                  <div class="tabsmall-content">
				  	<?php echo anchor('deals/'.$deal['slug'], word_limiter($deal['title'], 11)); ?><br/>
                    <?php echo word_limiter(strip_tags(html_entity_decode($deal['description'])),20); ?> 
                  </div>
                  <div class="clr"></div>
                </div>
                <?php } ?>
                <!--<a class="class-links right span11" data-slide="next" href="#deals">Browse more deals<i class="icon-circle-arrow-right"></i></a>-->
              </div>
            </div>
            
            <ul id="deals" class="news-list">
              <?php
			  		$dcount = 0;
                    foreach ($content['deals'] as $deal) {
						if($dcount == 5){break;}
                        ?>
              <li><?php echo anchor('deals/' . $deal['slug'], word_limiter($deal['title'], 5)); ?></li>
              <?php
			  	$dcount++;
                    }
                    ?>
              <li class="more-link"><?php echo anchor('deals/index', 'More Deals &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
            <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--jobs-->
          <div class="tab-pane fade" id="jobs_tab">
          <?php $count_jobs = count($content['jobs']);?>
             <?php if($count_jobs > 0){ ?>
            <div id="jobs" class="carousel slide  news-list"> 
              <!-- Carousel items -->
              <div class="carousel-inner">
                <?php foreach ($content['jobs'] as $job_key => $job) { ?>
                <div class="item <?php if($job_key == 0) echo "active"?>">
                  <!--<div class="news-thumb">
                  	<img src="<?php echo $this->settings->uploaderPath() . $deal['picture'] ?>" width="127" height="112" alt=""/>
                  </div>-->
                  <div class="tabsmall-content">
				  	<?php echo anchor('jobs/'.$job['slug'], word_limiter($job['title'], 11)); ?><br/>
                    <?php echo word_limiter(strip_tags(html_entity_decode($job['description'])),20); ?> 
                  </div>
                  <div class="clr"></div>
                </div>
                <?php } ?>
                <!--<a class="class-links right" data-slide="next" href="#jobs">More Jobs<i class="icon-circle-arrow-right"></i></a>-->
              </div>
              <!--/carousel-inner-->
            </div>
            
            <ul id="jobs" class="news-list">
              <?php
			  		$jcount = 0;
                    foreach ($content['jobs'] as $jobs) {
						if($jcount == 5){break;}
                        ?>
              <li><?php echo anchor('jobs/' . $jobs['slug'], word_limiter($jobs['title'], 5)); ?></li>
              <?php
			  	$jcount++;
                    }
                    ?>
              <li class="more-link"><?php echo anchor('jobs/index', 'More Jobs &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
            <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
          <!--videos-->
          <div class="tab-pane fade" id="videos_tab">
          <?php $count_videos = count($content['videos']);?>
             <?php if($count_videos > 0){ ?>
            <div id="videos" class="carousel slide  news-list image-list moveies-video-carousel"> 
              <!-- Carousel items -->
              
              <div class="carousel-inner">
                <?php foreach ($content['videos'] as $video_key => $video) { ?>
                <div class="item <?php if($video_key == 0) echo "active"?>">
                  <div class="news-thumb">
                  	<img src="<?php echo get_youtube_thumb($video['url']) ?>" width="127" height="112" alt="<?php echo $video['title']?>"/>
                  </div>
                  <div class="tabsmall-content">
				  	<?php echo anchor('videos/'.$video['slug'], word_limiter($video['title'], 11)); ?><br/>
                  </div>
                  <div class="clr"></div>
                </div>
                <?php } ?>
                <!--<a class="class-links right" data-slide="next" href="#videos">Browse more videos<i class="icon-circle-arrow-right"></i></a>-->
              </div>
            </div>
            
            <ul id="videos" class="news-list">
              <?php
			  		$vcount = 0;
                    foreach ($content['videos'] as $videos) {
						if($vcount == 5){break;}
                        ?>
              <li><?php echo anchor('videos/' . $videos['slug'], word_limiter($videos['title'], 5)); ?></li>
              <?php
			  	$vcount++;
                    }
                    ?>
              <li class="more-link"><?php echo anchor('videos/index', 'More Videos &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
             <?php }else{ ?>
              <div class="coming-soon">Coming Soon</div>
              <?php } ?>
          </div>
          
        </div>
      </div><?php */?>
    </div>
    
    <div class="adpart2">
      
      <div class="carousel slide home_page_right_side_ad">
          <div class="carousel-inner">
            <?php 
			$ads150_another1 = showAds('image', '300', '150', 5, '');
            $ads150_list1 = explode('<a ', $ads150_another1);
			$first_ads1 = array();
            foreach($ads150_list1 as $ad1501){ 
				if($ad1501){
					$first_ads1[] = $ad1501;
				}
			}
			if(count($first_ads1) > 0){
				foreach($first_ads1 as $first_ad1_key => $first_ad1_value){
			?>
					<div class="item <?php if($first_ad1_key == 0) echo "active"?>">
                      <div class="ad"> 
						<?php echo '<a ' . $first_ad1_value . '</a>'; ?>
                      </div>
                    </div>
			<?php
                }
			}
			?>
          </div>
        </div>
        
        <div class="carousel slide home_page_right_side_ad">
          <div class="carousel-inner">
            <?php 
			$ads150_another2 = showAds('image', '300', '150', 5, '');
            $ads150_list2 = explode('<a ', $ads150_another2);
			$first_ads2 = array();
            foreach($ads150_list2 as $ad1502){ 
				if($ad1502){
					$first_ads2[] = $ad1502;
				}
			}
			if(count($first_ads2) > 0){
				foreach($first_ads2 as $first_ad2_key => $first_ad2_value){
			?>
					<div class="item <?php if($first_ad2_key == 0) echo "active"?>">
                      <div class="ad"> 
						<?php echo '<a ' . $first_ad2_value . '</a>'; ?>
                      </div>
                    </div>
			<?php
                }
			}
			?>
          </div>
        </div>
        
        <div class="carousel slide home_page_right_side_ad">
          <div class="carousel-inner">
            <?php 
			$ads150_another3 = showAds('image', '300', '150', 5, '');
            $ads150_list3 = explode('<a ', $ads150_another3);
			$first_ads3 = array();
            foreach($ads150_list3 as $ad1503){ 
				if($ad1503){
					$first_ads3[] = $ad1503;
				}
			}
			if(count($first_ads3) > 0){
				foreach($first_ads3 as $first_ad3_key => $first_ad3_value){
			?>
					<div class="item <?php if($first_ad3_key == 0) echo "active"?>">
                      <div class="ad"> 
						<?php echo '<a ' . $first_ad3_value . '</a>'; ?>
                      </div>
                    </div>
			<?php
                }
			}
			?>
          </div>
        </div>
        
    </div>
    
    <div class="bhi-scrollad">
      <?php $bottom_footer_ads = showAdsInArray('image','175','60',25); ?>
      <div class="carousel" id="bottom_footer_ads" data-ride="carousel">
        <div class="carousel-inner">
          <div class="item active">
            <?php 
        $initial_bottom_footer_ads_count = 0;
        $bottom_footer_ads_count=count($bottom_footer_ads);
        
        foreach($bottom_footer_ads as $bottom_footer_ad){
            $initial_bottom_footer_ads_count++;
            
            echo $bottom_footer_ad;
            
            if($initial_bottom_footer_ads_count%3==0)	
            {						
                if($bottom_footer_ads_count > $initial_bottom_footer_ads_count)
                {
                    echo '</div>';
                    echo '<div class="item">';
                }
            }
        }
        ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="recent-classified">
    <div class="widget-heading">
      <h2>Recent Classifieds </h2>
      <?php echo anchor('classifieds/add', '<i class="icon-plus-sign-alt"></i> Post your ad free', array('class' => 'pull-right')); ?></div>
      <?php $count_classifieds = count($content['classifieds']);?>
      <?php if($count_classifieds > 0){ ?>
    <div class="recent-classified-bg">
      <div id="myCarousel" class="carousel slide align-center span19 classified-holder"> 
        <!-- Carousel items -->
        <div class="carousel-inner">
          <div class="item active">
            <?php
			$cnt = 0;
			$ttlcnt = count($content['classifieds']);
			foreach ($content['classifieds'] as $classified) {
				$cnt++;
				?>
            <li class="span3 movie"><?php echo anchor('classifieds/' . $classified['slug'], '<img src="' . $this->settings->uploaderPath() . $classified['picture'] . '"/><div class="classified_link">' . word_limiter($classified['title'], 6) . '<br><span class="timeago" title="' . $classified['date_listed'] . '">&nbsp;</span></div>'); ?></li>
            <?php
                        if ($cnt % 5 == 0) {
                            if ($ttlcnt > $cnt) {
                                echo '</div>';
                                echo '<div class="item">';
                            }
                        }
                    }
                    ?>
          </div>
        </div>
        <!--/carousel-inner-->
        <div class="clearbig">&nbsp;</div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&nbsp;</a> <a class="right carousel-control" href="#myCarousel" data-slide="next">&nbsp;</a> <!--<a class="class-links right span18" href="#myCarousel" data-slide="next">Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i></a>-->
        <?php //echo anchor('classifieds/index','Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i>',array('class'=>'class-links right span18'));   ?>
      </div>
    </div>
    <?php }else{ ?>
              <div class="coming-soon" style="margin: 36px 0px 0;min-height: 80px;">Coming Soon</div>
              <?php } ?>
  </div>
  <?php }else{ ?>
  <div class="coming-soon" style="margin: 36px 0px 0;min-height: 264px;">Coming Soon</div>
  <?php } ?>
</div>
