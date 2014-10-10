<div class="bhi-bodycont">
  <div class="bhi-topscroll">
    <div class="carousel" id="executive_ads" data-ride="carousel">
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
    </div>
  </div>
  
  <div class="slider"> 
	<div id="jumbtron_carousel" class="carousel slide">
            <?PHP
            $count_jumbtron = count($content['topnews']);
            echo '<ol class="carousel-indicators">';
            foreach ($content['citynews'] as $k => $citynews) {
                echo '<li data-target="#jumbtron_carousel" data-slide-to="' . $k . '" ';
                if ($k == 0)
                    echo 'class="active"';
                echo '></li>';
            }
            echo '</ol>';
            echo '<div class="carousel-inner">';
            foreach ($content['topnews'] as $i => $citynews) {
//                echo '<pre>';var_dump($citynews);
                echo '<div class="item ';
                if ($i == 0)
                    echo 'active';
                echo '"><div class="news-image">';
                echo anchor('news/' . $citynews['slug'], '<img src="' . newsPicture($citynews['id']) . '"/>');
                echo '</div><div class="caption-news">';
                echo '<div class="caption_title">'.anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 11)).'</div>';
                echo '<div class="caption_desc">'.  word_limiter(strip_tags(html_entity_decode($citynews['content'])),50).'</div>';
                echo '<div class="read_more">'.anchor('news/' . $citynews['slug'], 'Read More >>').'</div>';
                echo '</div></div>';
            }
            echo '</div>';
            ?>
        </div>
  </div>
  
  <div class="slider-right">
    <div class="bhi-videocont">
      <div class="widget-heading">
        <h2> Video News </h2>
      </div>
      
      <div class="widget-content"> 
      
        <div class="carousel slide">
            <div class="carousel-inner">
              <?php 
			  $utube = new YoutubeVideoDetails();
			  $videos_cnt = 0;
              $ttl_videos_cnt = count($content['videos']);
			  ?>
                <?php foreach($content['videos'] as $x => $video){ ?>
                    <div class="item <?php if($x == 0) echo "active"?>">
                    	<?php echo anchor('videos/' . $video['slug'], '<img src="' . get_youtube_thumb($video['url']) . '" width="239" height="154"/>'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        
      </div>
      
      <div class="ad"> 
        <?php
		$ads150 = showAds('image', '300', '150', 1, '');
		echo $ads150;
		?>
      </div>
      
    </div>
  </div>
  
  <div class="home-left">
    <div class="imp-cont">
      <div class="widget-heading">
        <h2>IMP Phones</h2>
      </div>
      <div class="imp-bg">
        <ul id="phone-numbers" class="news-list">
			<?php
            foreach ($content['numbers'] as $number) {
                echo '<li><a href="javascript:void(0)">' . $number['name'] . ' : ' . $number['phone'] . '</a></li>';
            }
            ?>
        </ul>
      </div>
    </div>
    <div class="imp-cont">
      <div class="widget-heading">
        <h2>Movies </h2>
        <a href="#">View All </a> </div>
      <div class="moviescroll">
        <div class="movie-thumb">
        
        <div id="latest_movie" class="widget_body carousel slide">
            <div class="carousel-inner">
                <?php foreach($content['movies'] as $x => $movie){ ?>
                    <div class="item <?php if($x == 0) echo "active"?>">
                        <img src="<?php echo $this->settings->uploaderPath().$movie['picture'] ?>" width="204" height="152" alt=""/>
                        <div class="movie-name"> <?php echo anchor('movies/'.$movie['slug'], $movie['name'])?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        </div>
      </div>
    </div>
  </div>
  
  <div class="home-right">
    <div class="bhi-tabs-cont">
      <div class="widget-heading">
        <h2>HYDERABAD 101</h2>
      </div>
      <div class="bhi-tabs-content">
        <div class="news-thumb"><img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/news-thumb.jpg" width="127" height="112" alt=""> </div>
        <div class="tabsmall-content"> <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a> <br/>
          Etiam cursus enim orci, vel sodales nunc porta vel. Maecenas elementum nisi eget ipsum rutrum fringilla. </div>
        <div class="clr"></div>
        <ul>
          <li> Integer ultrices tellus id massa ullamcorper volutpat. Integer </li>
          <li> mattis blandit dui, non dignissim felis volutpat id. </li>
          <li> Morbi egestas sodales tellus, in pellentesque dui maximus vitae. </li>
          <li> Aliquam tristique massa id purus eleifend, vitae accumsan massa </li>
          <li> commodo. Cras et volutpat turpis. Sed quam nunc, imperdiet </li>
        </ul>
      </div>
    </div>
    <div class="adpart2">
    <?php
	$ads150_another = showAds('image', '300', '150', 2, '');
	
	$adsList_another = explode('<a ', $ads150_another);
	foreach ($adsList_another as $ad_another) {
		if($ad_another){
		echo '<div class="ad">';
		echo '<a ' . $ad_another . '</a>';
		echo '</div>';
		}
	}
	?>
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
    <div class="recent-classified-bg">
      <div id="myCarousel" class="carousel slide align-center span19 classified-holder"> 
        <!-- Carousel items -->
        <div class="carousel-inner">
          <div class="item active">
            <?php
                    //		echo '<pre>';
                    //		print_r($content['classifieds']);
                    $cnt = 0;
                    $ttlcnt = count($content['classifieds']);
                    foreach ($content['classifieds'] as $classified) {
                        $cnt++;
                        ?>
            <li class="span3 movie"><?php echo anchor('classifieds/' . $classified['slug'], '<img src="' . $this->settings->uploaderPath() . $classified['picture'] . '"/><div>' . word_limiter($classified['title'], 6) . '<br><span class="timeago" title="' . $classified['date_listed'] . '">&nbsp;</span></div>'); ?></li>
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
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&nbsp;</a> <a class="right carousel-control" href="#myCarousel" data-slide="next">&nbsp;</a> <a class="class-links right span18" href="#myCarousel" data-slide="next">Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i></a>
        <?php //echo anchor('classifieds/index','Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i>',array('class'=>'class-links right span18'));   ?>
      </div>
    </div>
  </div>
</div>
