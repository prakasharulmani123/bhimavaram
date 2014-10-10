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
  <div class="slider"> <img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/slider.jpg" width="700" height="318" alt=""></div>
  <div class="slider-right">
    <div class="bhi-videocont">
      <div class="widget-heading">
        <h2> Video News </h2>
      </div>
      <div class="widget-content"> <img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/video-ad.jpg" width="239" height="154" alt=""></div>
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
        <ul>
          <li> Ambulance : 223666 </li>
          <li>Bus Stand : 08816226514 </li>
          <li>Railway Station : 08816232777 </li>
          <li>Police Station 1 Town : 234333</li>
        </ul>
      </div>
    </div>
    <div class="imp-cont">
      <div class="widget-heading">
        <h2>Movies </h2>
        <a href="#">View All </a> </div>
      <div class="moviescroll">
        <div class="movie-thumb"><img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/movie-thumb.png" width="204" height="152" alt="">
          <div class="movie-name"> <a href="#">Aagadu</a></div>
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
					echo '<div class="ad">';
                    echo '<a ' . $ad_another . '</a>';
					echo '</div>';
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
