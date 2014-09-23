<div class="full-width span20 home-page">
  <div class="carousel" id="executive_ads" data-ride="carousel">
    <div class="carousel-inner">
      <?php $executive_ads = showAdsInArray('image','300','60',15,'span6'); ?>
      <div class="item active ads300">
        <?php 
        $initial_executive_ads_count=0;
        $executive_ads_count=count($executive_ads);
        
        foreach($executive_ads as $executive_ad){
            $initial_executive_ads_count++;
            
            echo $executive_ad;
            
            if($initial_executive_ads_count%3==0)	
            {						
                if($executive_ads_count > $initial_executive_ads_count)
                {
                    echo '</div>';
                    echo '<div class="item ads300">';
                }
            }
        }
        ?>
      </div>
    </div>
  </div>
  <div class="news-holder span6 tabs-holder">
    <div class="span6 news-title home-tabs"> <a href="#city-news" class="span3 first"><?php echo userdata('city');?> News</a> <a href="#top-news" class="span3">Top News</a> </div>
    <div class="clear">&nbsp;</div>
    <ul id="city-news" class="news-list">
      <div id="citynews-slider" class="carousel slide news-slider" >
        <ol class="carousel-indicators">
          <?php 
						$newcnt=0;
						foreach($content['citynews'] as $citynews)
						{					
					?>
          <li data-target="#citynews-slider" data-slide-to="<?php echo $newcnt;?>" class="news-slider<?php if($newcnt==0){ echo ' active ';}?>"></li>
          <?php
						$newcnt++;
						}
					?>
        </ol>
        <div class="carousel-inner">
          <?php 
						$newcnt=0;
						foreach($content['citynews'] as $citynews)
						{		
									
					?>
          <div class="item<?php if($newcnt==0){ echo ' active ';}?>">
            <li data-target="#citynews-slider" data-slide-to="<?php echo $newcnt;?>" <?php if($newcnt==0){ echo ' class="active" ';}?>></li>
            <?php echo anchor('news/'.$citynews['slug'],'<img src="'.newsPicture($citynews['id']).'"/>');?>
            <div class="carousel-caption"> <?php echo anchor('news/'.$citynews['slug'],word_limiter($citynews['title'],11));?> </div>
          </div>
          <?php
						$newcnt++;
						}
					?>
        </div>
      </div>
      <!--carusel ends-->
      <?php
				$citynewscnt=0;
            	foreach($content['citynews'] as $citynews)
				{
					if($citynewscnt<6)
					{
				//	if($citynewscnt==0)
					//{
			?>
      
      <!--<li class="featured">
				<?php //echo anchor('news/'.$citynews['slug'],'<img src="'.newsPicture($citynews['id']).'"/><div>'.word_limiter($citynews['title'],14).'</div>');?>
            </li>-->
      <?php 
					//}
					//else
					//{
			?>
      <li><?php echo anchor('news/'.$citynews['slug'],word_limiter($citynews['title'],5));?></li>
      <?php
				//}
				$citynewscnt++;
					}
				}
			?>
      <li class="more-link"><?php echo anchor('news/index','More News &nbsp;<i class="icon-circle-arrow-right"></i>');?></li>
    </ul>
    <!--News-list Ends-->
    <ul id="top-news" class="news-list">
      <div id="topnews-slider" class="carousel slide news-slider" >
        <ol class="carousel-indicators">
          <?php 
						$newcnt=0;
						foreach($content['topnews'] as $citynews)
						{	
										
					?>
          <li data-target="#topnews-slider" data-slide-to="<?php echo $newcnt;?>" class="news-slider<?php if($newcnt==0){ echo ' active ';}?>"></li>
          <?php
						$newcnt++;
						}
					?>
        </ol>
        <div class="carousel-inner">
          <?php 
						$newcnt=0;
						foreach($content['topnews'] as $citynews)
						{					
					?>
          <div class="item<?php if($newcnt==0){ echo ' active ';}?>">
            <li data-target="#topnews-slider" data-slide-to="<?php echo $newcnt;?>" <?php if($newcnt==0){ echo ' class="active" ';}?>></li>
            <?php echo anchor('news/'.$citynews['slug'],'<img src="'.newsPicture($citynews['id']).'"/>');?>
            <div class="carousel-caption"> <?php echo anchor('news/'.$citynews['slug'],word_limiter($citynews['title'],11));?> </div>
          </div>
          <?php
						$newcnt++;
						}
					?>
        </div>
      </div>
      <!--carusel ends-->
      <?php
				$citynewscnt=0;
            	foreach($content['topnews'] as $citynews)
				{
					if($citynewscnt<6)
					{
			?>
      <li><?php echo anchor('news/'.$citynews['slug'],word_limiter($citynews['title'],5));?></li>
      <?php
				$citynewscnt++;
					}
				}
			?>
      <li class="more-link"><?php echo anchor('news/index','More News &nbsp;<i class="icon-circle-arrow-right"></i>');?></li>
    </ul>
    <!--News-list Ends--> 
  </div>
  <!--news-holder ends-->
  <div class="span6 news-holder tabs-holder column-2 cinema-column">
    <div class="span6 news-title home-tabs"> 
    <a href="#events" class="span3 first">Events</a> <a href="#city-news" class="span3">Cinema News</a> </div>
    <ul id="events" class="news-list">
      <?php
        	foreach($content['events'] as $event)
			{
		?>
      <li><?php echo anchor('events/'.$event['slug'],word_limiter($event['name'],5));?></li>
      <?php 
		}
		?>
      <li class="more-link"><?php echo anchor('events/index','More Events &nbsp;<i class="icon-circle-arrow-right"></i>');?></li>
    </ul>
    <!--movies Ends-->
    <ul id="city-news" class="news-list">
      <?php
				$pcount=1;
            	foreach($content['cinenews'] as $citynews)
				{
					if($pcount<6)
					{
					
			?>
      <li><?php echo anchor('news/'.$citynews['slug'],word_limiter($citynews['title'],5));?></li>
      <?php				
					$pcount++;
					}
				}
			?>
      <li class="more-link"><?php echo anchor('news/index/cinema','More News &nbsp;<i class="icon-circle-arrow-right"></i>');?></li>
    </ul>
    <!--News-list Ends--> 
  </div>
  <div class="span6 news-holder tabs-holder column-2">
    <?php //echo anchor('http://tastyshare.com/',$this->html->themeImg('300_2.jpg'),array('class'=>'ad_300_300','target'=>'_blank'));?>
    <div class="news-title white sidePadding10 single center"> <span class="caps">Featured Photos</span> </div>
    <div id="photocarousel" class="carousel slide align-center span6"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
        <?php
        $cnt=0;
        $ttlcnt=count($content['photos']);
        foreach($content['photos'] as $photo)
        {
       
        ?>
        <div class="item<?php if($cnt==0){ echo ' active ';}?>"> <?php echo anchor('photos/show/'.$photo['id'],'<img src="'.$this->settings->baseUrl().'uploads/thumb/'.$photo['photo'].'"/>');?> </div>
        <?php
        /*if($cnt%2==0)	
        {						
        if($ttlcnt > $cnt)
        {
            echo '</div>';
            echo '<div class="item">';
        }
        }*/
		 $cnt++;
        }
        ?>
      </div>
      <!--/carousel-inner-->
      <div class="clearbig">&nbsp;</div>
      <a class="left carousel-control" href="#photocarousel" data-slide="prev">&nbsp;</a> <a class="right carousel-control" href="#photocarousel" data-slide="next">&nbsp;</a>
      <div class="clearbig">&nbsp;</div>
      <?php echo anchor('photos/index','Browse photo galleries &nbsp;<i class="icon-circle-arrow-right"></i>',array('class'=>'class-links right'));?> </div>
    <!--/myCarousel--> 
  </div>
  <!--COlumn-2 ends-->
  
  <!--start-->
  <div class="news-holder span12 tabs-holder mini-tabs">
    <div class="span12 news-title movie-tabs"> 
    <a href="#movies" class="span3">Movies</a> 
    <a href="#videos" class="span3">Videos</a> 
    <a href="#jobs" class="span3">Jobs</a> 
    <a href="#deals" class="span3">Deals and Discounts</a> 
    </div>
    <!-- Movies Carousel START-->
    <div id="movies" class="carousel slide span12 news-list image-list moveies-video-carousel"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
      <div class="item active"> 
        <?php
        $movies_cnt=0;
        $ttl_movies_cnt=count($content['movies']);
        foreach($content['movies'] as $movie)
        {
       		$movies_cnt++;
        ?>
        <li class="span3 movie"> <?php echo anchor('movies/'.$movie['slug'],'<img src="'.$this->settings->uploaderPath().$movie['picture'].'"/>'.$movie['name']);?> </li>
        <?php
			if($movies_cnt%4==0)	
			{						
				if($ttl_movies_cnt > $movies_cnt)
				{
					echo '</div>';
					echo '<div class="item">';
				}
			}
        }
        ?>
        
        </div>
      </div>
      <!--/carousel-inner-->
      <li class="more-link span12"><a class="class-links right span11" data-slide="next" href="#movies">Browse more movies<i class="icon-circle-arrow-right"></i></a></li>
    </div>
    <!-- Movies Carousel END-->
    
    <!-- Videos Carousel START-->
    <div id="videos" class="carousel slide span12 news-list image-list moveies-video-carousel"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
      <div class="item active"> 
        <?php
		$utube=new YoutubeVideoDetails();
        $videos_cnt=0;
        $ttl_videos_cnt=count($content['videos']);
        foreach($content['videos'] as $video)
        {
       		$videos_cnt++;
        ?>
        <li class="span3 movie"><?php echo anchor('videos/'.$video['slug'],'<img src="'.get_youtube_thumb($video['url']).'"/>'.$video['title']);?></li>
        <?php
			if($videos_cnt%3==0)	
			{						
				if($ttl_videos_cnt > $videos_cnt)
				{
					echo '</div>';
					echo '<div class="item">';
				}
			}
        }
        ?>
        </div>
      </div>
      <!--/carousel-inner-->
      <li class="more-link span12"><a class="class-links right span11" data-slide="next" href="#videos">Browse more videos<i class="icon-circle-arrow-right"></i></a></li>
    </div>
    <!-- Videos Carousel END-->
    
    <!-- jobs Carousel START-->
    <div id="jobs" class="carousel slide span12 news-list image-list moveies-video-carousel"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
      <div class="item active"> 
        <?php
        $jobs_cnt=0;
        $ttl_jobs_cnt=count($content['jobs']);
        foreach($content['jobs'] as $job)
        {
       		$jobs_cnt++;
        ?>
        <li class="span3 movie"><?php echo anchor('jobs/'.$job['slug'],$job['title'].' / '.$job['location']);?><</li>
        <?php
			if($jobs_cnt%4==0)	
			{						
				if($ttl_jobs_cnt > $jobs_cnt)
				{
					echo '</div>';
					echo '<div class="item">';
				}
			}
        }
        ?>
        </div>
      </div>
      <!--/carousel-inner-->
      <li class="more-link span12"><a class="class-links right span11" data-slide="next" href="#jobs">More Jobs<i class="icon-circle-arrow-right"></i></a></li>
    </div>
    <!-- jobs Carousel END-->
    
    <!-- deals Carousel START-->
    <div id="deals" class="carousel slide span12 news-list image-list moveies-video-carousel"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
      <div class="item active"> 
        <?php
        $deals_cnt=0;
        $ttl_deals_cnt=count($content['deals']);
        foreach($content['deals'] as $deal)
        {
       		$deals_cnt++;
        ?>
        <li class="span3 movie"><?php echo anchor('deals/'.$deal['slug'],'<img src="'.$this->settings->uploaderPath().$deal['picture'].'"/>'.$deal['title']);?></li>
        <?php
			if($deals_cnt%4==0)	
			{						
				if($ttl_deals_cnt > $deals_cnt)
				{
					echo '</div>';
					echo '<div class="item">';
				}
			}
        }
        ?>
        </div>
      </div>
      <!--/carousel-inner-->
      <li class="more-link span12"><a class="class-links right span11" data-slide="next" href="#deals">Browse more deals<i class="icon-circle-arrow-right"></i></a></li>
    </div>
    <!-- deals Carousel END-->
    <!--/myCarousel--> 
  </div>
  <!-- end -- >
  
    <!-- Testing-->
  
  <div class="clearbig">&nbsp;</div>
  <div class="news-holder span6">
    <?php 
	$ads150=showAds('image','300','150',4,'');
	$adsList=explode('<a ',$ads150);	


	echo '<a '.$adsList[1].'</a>';
	//echo showAd('image','300','150');//echo anchor('http://tastyshare.com/',$this->html->themeImg('300_150.png'),array('class'=>'ad_300_150','target'=>'_blank'));?>
    <div class="clearbig">&nbsp;</div>
    <div class="clearbig">&nbsp;</div>
    <div class="clearbig">&nbsp;</div>
    <div class="span6">
      <div class="carousel-title caps center">Important Phone Numbers</div>
      <ul id="phone-numbers" class="news-list">
        <?php
            foreach($content['numbers'] as $number)
			{
			?>
        <li><a href="javascript:void(0)"><?php echo $number['name'].' : '.$number['phone'];?></a></li>
        <?php
			}
			?>
      </ul>
    </div>
    <!--Carousel Ends--> 
  </div>
  <div class="news-holder span6 tabs-holder" id="poll-box" >
    <div class="span6 news-title home-tabs single center"> <span>Poll of the week</span> </div>
    <div class="listing-details pull-left">
      <h3><?php echo anchor('polls/'.$content['poll']['slug'],$content['poll']['question'].' ('.$content['poll']['total_votes'].' Votes)',array('class'=>'grey-link'));?></h3>
      <?php echo form_open('polls/vote',array('class'=>'form-horizontal password-form','data-validate'=>'parsley'));?>
      <?php
	$answers=$this->df->get_multi_row('poll_answers',array('questionid'=>$content['poll']['id']));
    	foreach($answers as $ans)
		{
			$percent=round(($ans['votes']/$content['poll']['total_votes'])*100,1);
	?>
      <!--    <div class="answer-box pull-left span5">--> 
      <!---->
      <?php
    if(userdata('uid'))
	{
	?>
      <?php }?>
      <?php 
  echo '<div class="poll-option btn pull-left span5 left">'.'<label class="radio"><input type="radio" name="answer"  value="'.$ans['id'].'" data-required="true">'.$ans['answer'].' ('.$percent.'%)'.'</label></div>';
  //echo '<div class="poll-option btn pull-left span2">'.$ans['answer'].' ('.$percent.'% )'.'</div>';
  
  ?>
      <!--</label>--> 
      
      <!--	<div class="progress progress-success offset1">    	
      <div class="bar" style="width: <?php echo $percent;?>%"></div>
    </div>--> 
      <!--    </div>-->
      <?php
		}
	?>
      <input type="hidden" name="questionid" value="<?php echo $content['poll']['id'];?>" />
      <input type="hidden" name="slug" value="<?php echo $content['poll']['slug'];?>" />
      <div class="clearbig">&nbsp;</div>
      <?php
    if(userdata('uid'))
	{
	?>
      <div class="clearbig">&nbsp;</div>
      <button type="submit" class="btn btn-danger span5 submit-btn">Submit Vote</button>
      <?php
	}
	else
	{
	?>
      <div class="span5 center align-center"><?php echo anchor('start/signin','Please login to vote');?></div>
      <?php
	}
	?>
      </form>
      <hr />
      <?php
     if(count($content['pollcomment'])>0)
	 {
		 $polluser=$this->df->get_single_row('users',array('uid'=>$content['pollcomment']['uid']));
		 echo showAvatar( $polluser['picture'], $polluser['name'],array('class'=>'poll-profile-img pull-left'));
		echo '<div class="poll-message"><span class="highlight poll-title">'.$polluser['name'].'</span></div>';
		echo '<div class="poll-message">'.htmlspecialchars_decode(word_limiter($content['pollcomment']['comment'],8)).'</div>';					

	 ?>
      <?php
	 }
	 ?>
    </div>
    <div class="span6 more-links center"> <?php echo anchor('polls/index','<i class="icon-reorder"></i> Browse Polls',array('class'=>'pull-left'));
				echo anchor('polls/'.$content['poll']['slug'],'<i class="icon-comment-alt"></i> Comment on this',array('class'=>'pull-right'));
				?> </div>
  </div>
  <div class="news-holder span6 ad-holders">
    <?php //echo showAd('image','300','150');//echo anchor('http://tastyshare.com/',$this->html->themeImg('300_150.png'),array('class'=>'ad_300_150','target'=>'_blank'));?>
    <?php //echo showAd('image','300','150');//echo anchor('http://tastyshare.com/',$this->html->themeImg('300_150.png'),array('class'=>'ad_300_150','target'=>'_blank'));?>
    <?php //echo showAd('image','300','150');//echo anchor('http://tastyshare.com/',$this->html->themeImg('300_150.png'),array('class'=>'ad_300_150','target'=>'_blank'));
		//echo showAds('image','300','150',3,'');
		echo '<a '.$adsList[2].'</a>';
		echo '<a '.$adsList[3].'</a>';
		echo '<a '.$adsList[4].'</a>';
	?>
  </div>
  <div class="clearbig">&nbsp;</div>
  <div>
    <div id="myCarousel" class="carousel slide align-center span19 classified-holder">
      <div class="carousel-title caps">Recent Classifieds <?php echo anchor('classifieds/add','<i class="icon-plus-sign-alt"></i> Post your ad free',array('class'=>'pull-right'));?> </div>
      <!-- Carousel items -->
      <div class="carousel-inner">
        <div class="item active">
          <?php
    //		echo '<pre>';
    //		print_r($content['classifieds']);
				$cnt=0;
				$ttlcnt=count($content['classifieds']);
                foreach($content['classifieds'] as $classified)
                {
					$cnt++;
				?>
          <li class="span3 movie"><?php echo anchor('classifieds/'.$classified['slug'],'<img src="'.$this->settings->uploaderPath().$classified['picture'].'"/><div>'.word_limiter($classified['title'],6).'<br><span class="timeago" title="'.$classified['date_listed'].'">&nbsp;</span></div>');?></li>
          <?php
					if($cnt%5==0)	
					{						
						if($ttlcnt > $cnt)
						{
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
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&nbsp;</a> 
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&nbsp;</a> 
      <a class="class-links right span18" href="#myCarousel" data-slide="next">Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i></a>
      <?php //echo anchor('classifieds/index','Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i>',array('class'=>'class-links right span18'));?>
    </div>
    <!--/myCarousel--> 
  </div>
  <!--Containr ends--> 
</div>
<!--span20 ends--> 
