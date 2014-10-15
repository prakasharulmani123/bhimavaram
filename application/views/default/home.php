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
                echo '<div class="item ';
                if ($i == 0)
                    echo 'active';
                echo '"><div class="news-image">';
                echo anchor('news/' . $citynews['slug'], '<img src="' . newsPicture($citynews['id']) . '"/>');
                echo '</div><div class="caption-news">';
                echo '<div class="caption_title">'.anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 11)).'</div>';
                echo '<div class="caption_desc">'.  word_limiter(strip_tags(html_entity_decode($citynews['content'])),20).'</div>';
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
        <div class="carousel slide" id="video_news">
          <div class="carousel-inner">
            <?php 
			  $utube = new YoutubeVideoDetails();
			  $videos_cnt = 0;
              $ttl_videos_cnt = count($content['videos']);
			  ?>
            <?php foreach($content['videos'] as $x => $video){ ?>
            <div class="item <?php if($x == 0) echo "active"?>"> <?php echo anchor('videos/' . $video['slug'], '<img src="' . get_youtube_thumb($video['url']) . '" width="239" height="154"/>'); ?> </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="ad">
        <?php
		$ads150 = showAds('image', '300', '150', 1, 'ad1');
		echo $ads150;
		?>
      </div>
    </div>
  </div>
  <div class="clr"></div>
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
          <div id="latest_movie1" class="widget_body carousel slide vertical">
            <div class="carousel-inner">
            <marquee direction="up" behavior="scroll" style="overflow: hidden;">
              <?php foreach($content['movies'] as $x => $movie){ ?>
              <div class="item <?php if($x == 0) echo "active"?>" movie_thumb> <img src="<?php echo $this->settings->uploaderPath().$movie['picture'] ?>" width="204" height="152" alt=""/>
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
        <h2>HYDERABAD 101</h2>
      </div>
      <div class="bhi-tabs-content">
        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" href="#news_tab">News</a> </li>
          <li><a data-toggle="tab" href="#cinema_tab">Cinema</a></li>
          <li><a data-toggle="tab" href="#events_tab">Events</a></li>
          <li><a data-toggle="tab" href="#deals_tab">Deals</a></li>
          <li><a data-toggle="tab" href="#jobs_tab">Jobs</a> </li>
          <li><a data-toggle="tab" href="#videos_tab">Videos</a></li>
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="news_tab">
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
              <img src="<?php echo newsPicture($citynews['id']) ?>" width="127" height="112" alt=""> 
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
          </div>
          
          <div class="tab-pane" id="cinema_tab">
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
          </div>
          
          <div class="tab-pane" id="events_tab">
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
          </div>
          
          <div class="tab-pane" id="deals_tab">
            <div id="deals" class="carousel slide news-list">
              <div class="carousel-inner">
                <?php foreach ($content['deals'] as $key => $deal) { ?>
                <div class="item <?php if($key == 0) echo "active"?>">
                  <div class="news-thumb">
                  	<img src="<?php echo $this->settings->uploaderPath() . $deal['picture'] ?>" width="127" height="112" alt=""/>
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
          </div>
          
          <div class="tab-pane" id="jobs_tab">
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
          </div>
          
          <div class="tab-pane" id="videos_tab">
            <div id="videos" class="carousel slide  news-list image-list moveies-video-carousel"> 
              <!-- Carousel items -->
              
              <div class="carousel-inner">
                <?php foreach ($content['videos'] as $video_key => $video) { ?>
                <div class="item <?php if($video_key == 0) echo "active"?>">
                  <div class="news-thumb">
                  	<img src="<?php echo get_youtube_thumb($video['url']) ?>" width="127" height="112" alt=""/>
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
          </div>
          
        </div>
      </div>
    </div>
    
    <div class="adpart2">
      <?php
		$ads150_another = showAds('image', '300', '150', 3, '');
	
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
  </div>
</div>
