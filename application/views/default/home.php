<div class="full-width span20 home-page">
    <div class="carousel" id="executive_ads" data-ride="carousel">
        <div class="carousel-inner">
            <?php $executive_ads = showAdsInArray('image', '300', '60', 15, 'span6'); ?>
            <div class="item active ads300">
                <?php
                $initial_executive_ads_count = 0;
                $executive_ads_count = count($executive_ads);

                foreach ($executive_ads as $executive_ad) {
                    $initial_executive_ads_count++;

                    echo $executive_ad;

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
    <div class="span14">
        <!--CAROUSEL START-->
        <div id="jumbtron_carousel" class="carousel slide">
            <?PHP
            $count_jumbtron = count($content['citynews']);
            echo '<ol class="carousel-indicators">';
            foreach ($content['citynews'] as $k => $citynews) {
                echo '<li data-target="#jumbtron_carousel" data-slide-to="' . $k . '" ';
                if ($k == 0)
                    echo 'class="active"';
                echo '></li>';
            }
            echo '</ol>';
            echo '<div class="carousel-inner">';
            foreach ($content['citynews'] as $i => $citynews) {
                echo '<div class="item ';
                if ($i == 0)
                    echo 'active';
                echo '"><div class="news-image">';
                echo anchor('news/' . $citynews['slug'], '<img src="' . newsPicture($citynews['id']) . '"/>');
                echo '</div><div class="caption-news">';
                echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 11));
                echo '</div></div>';
            }
            echo '</div>';
            ?>
        </div>
        <!--CAROUSEL END-->

        <div class="span5">
            <div class="widget">
                <h3 class="widget_title">IMP Phones</h3>
                <div class="widget_body">                    
                    <ul id="phone-numbers" class="news-list">
                        <?php
                        foreach ($content['numbers'] as $number) {
                            echo '<li><a href="javascript:void(0)">' . $number['name'] . ' : ' . $number['phone'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="widget">
                <h3 class="widget_title">Movies <span class="pull-right">View All &gt;</span></h3>
                <div id="latest_movie" class="widget_body carousel slide">
                    <div class="carousel-inner">
                        <?php
                        foreach ($content['movies'] as $x => $movie) {
                            echo '<div class="item ';
                            if ($x == 0)
                                echo "active";
                            echo '">' . anchor('movies/' . $movie['slug'], '<img src="' . $this->settings->uploaderPath() . $movie['picture'] . '"/>' . $movie['name']) . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="column-2 dashboard_tabs pull-left">
            <div class="widget">
                <h3 class="widget_title">Hyderabad 101</h3>
                <div class="widget_body">
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#news_tab">News</a> </li>
                        <li><a data-toggle="tab" href="#events_tab">Events</a></li>
                        <li><a data-toggle="tab" href="#deals_tab">Deals</a></li>
                        <li><a data-toggle="tab" href="#jobs_tab">Jobs</a> </li>
                        <li><a data-toggle="tab" href="#videos_tab">Videos</a></li>
                        <li><a data-toggle="tab" href="#cinema_tab">Cinema</a></li>
                        <!--<a href="#deals">Deals and Discounts</a>--> 
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="news_tab">
                            <ul id="top-news" class="news-list">
                                <div id="topnews-slider" class="carousel slide news-slider" >
                                    <ol class="carousel-indicators">
                                        <?php
                                        foreach ($content['topnews'] as $n => $citynews) {
                                            echo '<li data-target="#topnews-slider" data-slide-to="' . $newcnt . '" class="news-slider ';
                                            if ($n == 0)
                                                echo ' active ';
                                            echo '"></li>';
                                        }
                                        ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        foreach ($content['topnews'] as $m => $citynews) {
                                            echo '<div class="item ';
                                            if ($m == 0)
                                                echo ' active ';
                                            echo '">';
                                            echo '<li data-target="#topnews-slider" data-slide-to="' . $m . '" ';
                                            if ($m == 0)
                                                echo ' class="active" ';
                                            echo '></li>';
                                            echo anchor('news/' . $citynews['slug'], '<img src="' . newsPicture($citynews['id']) . '"/>');
                                            echo '<div class="caption-news">' . anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 11)) . '</div>';
                                            echo '</div>';
                                            $m++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!--carusel ends-->
                                <?php
                                $citynewscnt = 0;
                                foreach ($content['topnews'] as $citynews) {
                                    if ($citynewscnt < 6) {
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
                            <div id="deals" class="carousel slide span12 news-list image-list moveies-video-carousel"> 
                                <div class="carousel-inner">
                                    <div class="item active"> 
                                        <?php
                                        $deals_cnt = 0;
                                        $ttl_deals_cnt = count($content['deals']);
                                        foreach ($content['deals'] as $deal) {
                                            $deals_cnt++;
                                            ?>
                                            <li class="span3 movie"><?php echo anchor('deals/' . $deal['slug'], '<img src="' . $this->settings->uploaderPath() . $deal['picture'] . '"/>' . $deal['title']); ?></li>
                                            <?php
                                            if ($deals_cnt % 4 == 0) {
                                                if ($ttl_deals_cnt > $deals_cnt) {
                                                    echo '</div>';
                                                    echo '<div class="item">';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <li class="more-link span12"><a class="class-links right span11" data-slide="next" href="#deals">Browse more deals<i class="icon-circle-arrow-right"></i></a></li>
                            </div>
                        </div>
                        <div class="tab-pane" id="jobs_tab">
                            <div id="jobs" class="carousel slide  news-list image-list moveies-video-carousel"> 
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="item active"> 
                                        <?php
                                        $jobs_cnt = 0;
                                        $ttl_jobs_cnt = count($content['jobs']);
                                        foreach ($content['jobs'] as $job) {
                                            $jobs_cnt++;
                                            ?>
                                            <li class="span3 movie"><?php echo anchor('jobs/' . $job['slug'], $job['title'] . ' / ' . $job['location']); ?><</li>
                                            <?php
                                            if ($jobs_cnt % 4 == 0) {
                                                if ($ttl_jobs_cnt > $jobs_cnt) {
                                                    echo '</div>';
                                                    echo '<div class="item">';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!--/carousel-inner-->
                                <li class="more-link "><a class="class-links right" data-slide="next" href="#jobs">More Jobs<i class="icon-circle-arrow-right"></i></a></li>
                            </div>
                        </div>                            
                        <div class="tab-pane" id="videos_tab">
                            <div id="videos" class="carousel slide  news-list image-list moveies-video-carousel"> 
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="item active"> 
                                        <?php
                                        $utube = new YoutubeVideoDetails();
                                        $videos_cnt = 0;
                                        $ttl_videos_cnt = count($content['videos']);
                                        foreach ($content['videos'] as $video) {
                                            $videos_cnt++;
                                            ?>
                                            <li class="span3 movie"><?php echo anchor('videos/' . $video['slug'], '<img src="' . get_youtube_thumb($video['url']) . '"/>' . $video['title']); ?></li>
                                            <?php
                                            if ($videos_cnt % 3 == 0) {
                                                if ($ttl_videos_cnt > $videos_cnt) {
                                                    echo '</div>';
                                                    echo '<div class="item">';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!--/carousel-inner-->
                                <li class="more-link "><a class="class-links right" data-slide="next" href="#videos">Browse more videos<i class="icon-circle-arrow-right"></i></a></li>
                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="column-2 sidebar">
        <div class="widget">
            <h3 class="widget_title">Video News</h3>
            <div class="widget_body">
                <?php
                $ads150 = showAds('image', '300', '150', 4, '');
                $adsList = explode('<a ', $ads150);
                foreach ($adsList as $ad) {
                    echo '<a ' . $ad . '</a>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="pull-left span20">
        <h3 class="widget_title">Recent Classifieds <span class="pull-right"><?php echo anchor('classifieds/add', '<i class="icon-plus-sign-alt"></i> Post your ad free', array('class' => 'pull-right')); ?></span></h3>
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
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&nbsp;</a> 
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&nbsp;</a> 
            <a class="class-links right span18" href="#myCarousel" data-slide="next">Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i></a>
            <?php //echo anchor('classifieds/index','Browse more ads &nbsp;<i class="icon-circle-arrow-right"></i>',array('class'=>'class-links right span18'));   ?>
        </div>
    </div>


    <div class="news-holder span6 tabs-holder">
        <div class="span6 news-title home-tabs"> <a href="#city-news" class="span3 first"><?php echo userdata('city'); ?> News</a> <a href="#top-news" class="span3">Top News</a> </div>
        <div class="clear">&nbsp;</div>
        <ul id="city-news" class="news-list">
            <div id="citynews-slider" class="carousel slide news-slider" >

                <!--carusel ends-->
                <?php
                $citynewscnt = 0;
                foreach ($content['citynews'] as $citynews) {
                    if ($citynewscnt < 6) {
                        //	if($citynewscnt==0)
                        //{
                        ?>

                        <!--<li class="featured">
                        <?php //echo anchor('news/'.$citynews['slug'],'<img src="'.newsPicture($citynews['id']).'"/><div>'.word_limiter($citynews['title'],14).'</div>');  ?>
                              </li>-->
                        <?php
                        //}
                        //else
                        //{
                        ?>
                        <li><?php echo anchor('news/' . $citynews['slug'], word_limiter($citynews['title'], 5)); ?></li>
                        <?php
                        //}
                        $citynewscnt++;
                    }
                }
                ?>
                <li class="more-link"><?php echo anchor('news/index', 'More News &nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
        </ul>
        <!--News-list Ends-->

        <!--News-list Ends--> 
    </div>
    <!--news-holder ends-->

    <div class="span6 news-holder tabs-holder column-2">
        <?php //echo anchor('http://tastyshare.com/',$this->html->themeImg('300_2.jpg'),array('class'=>'ad_300_300','target'=>'_blank'));   ?>
        <div class="news-title white sidePadding10 single center"> <span class="caps">Featured Photos</span> </div>
        <div id="photocarousel" class="carousel slide align-center span6"> 
            <!-- Carousel items -->
            <div class="carousel-inner">
                <?php
                $cnt = 0;
                $ttlcnt = count($content['photos']);
                foreach ($content['photos'] as $photo) {
                    ?>
                    <div class="item<?php
                    if ($cnt == 0) {
                        echo ' active ';
                    }
                    ?>"> <?php echo anchor('photos/show/' . $photo['id'], '<img src="' . $this->settings->baseUrl() . 'uploads/thumb/' . $photo['photo'] . '"/>'); ?> </div>
                         <?php
                         /* if($cnt%2==0)	
                           {
                           if($ttlcnt > $cnt)
                           {
                           echo '</div>';
                           echo '<div class="item">';
                           }
                           } */
                         $cnt++;
                     }
                     ?>
            </div>
            <!--/carousel-inner-->
            <div class="clearbig">&nbsp;</div>
            <a class="left carousel-control" href="#photocarousel" data-slide="prev">&nbsp;</a> <a class="right carousel-control" href="#photocarousel" data-slide="next">&nbsp;</a>
            <div class="clearbig">&nbsp;</div>
            <?php echo anchor('photos/index', 'Browse photo galleries &nbsp;<i class="icon-circle-arrow-right"></i>', array('class' => 'class-links right')); ?> </div>
        <!--/myCarousel--> 
    </div>
    <!--COlumn-2 ends-->

    <!--start-->

    <!-- end -- >
    
    <!-- Testing-->

    <div class="clearbig">&nbsp;</div>

    <div class="news-holder span6 tabs-holder" id="poll-box" >
        <div class="span6 news-title home-tabs single center"> <span>Poll of the week</span> </div>
        <div class="listing-details pull-left">
            <h3><?php echo anchor('polls/' . $content['poll']['slug'], $content['poll']['question'] . ' (' . $content['poll']['total_votes'] . ' Votes)', array('class' => 'grey-link')); ?></h3>
            <?php echo form_open('polls/vote', array('class' => 'form-horizontal password-form', 'data-validate' => 'parsley')); ?>
            <?php
            $answers = $this->df->get_multi_row('poll_answers', array('questionid' => $content['poll']['id']));
            foreach ($answers as $ans) {
                $percent = round(($ans['votes'] / $content['poll']['total_votes']) * 100, 1);
                ?>
                <!--    <div class="answer-box pull-left span5">--> 
                <!---->
                <?php
                if (userdata('uid')) {
                    ?>
                <?php } ?>
                <?php
                echo '<div class="poll-option btn pull-left span5 left">' . '<label class="radio"><input type="radio" name="answer"  value="' . $ans['id'] . '" data-required="true">' . $ans['answer'] . ' (' . $percent . '%)' . '</label></div>';
                //echo '<div class="poll-option btn pull-left span2">'.$ans['answer'].' ('.$percent.'% )'.'</div>';
                ?>
                <!--</label>--> 

                <!--	<div class="progress progress-success offset1">    	
                <div class="bar" style="width: <?php echo $percent; ?>%"></div>
              </div>--> 
                <!--    </div>-->
                <?php
            }
            ?>
            <input type="hidden" name="questionid" value="<?php echo $content['poll']['id']; ?>" />
            <input type="hidden" name="slug" value="<?php echo $content['poll']['slug']; ?>" />
            <div class="clearbig">&nbsp;</div>
            <?php
            if (userdata('uid')) {
                ?>
                <div class="clearbig">&nbsp;</div>
                <button type="submit" class="btn btn-danger span5 submit-btn">Submit Vote</button>
                <?php
            } else {
                ?>
                <div class="span5 center align-center"><?php echo anchor('start/signin', 'Please login to vote'); ?></div>
                <?php
            }
            ?>
            </form>
            <hr />
            <?php
            if (count($content['pollcomment']) > 0) {
                $polluser = $this->df->get_single_row('users', array('uid' => $content['pollcomment']['uid']));
                echo showAvatar($polluser['picture'], $polluser['name'], array('class' => 'poll-profile-img pull-left'));
                echo '<div class="poll-message"><span class="highlight poll-title">' . $polluser['name'] . '</span></div>';
                echo '<div class="poll-message">' . htmlspecialchars_decode(word_limiter($content['pollcomment']['comment'], 8)) . '</div>';
                ?>
                <?php
            }
            ?>
        </div>
        <div class="span6 more-links center"> <?php
            echo anchor('polls/index', '<i class="icon-reorder"></i> Browse Polls', array('class' => 'pull-left'));
            echo anchor('polls/' . $content['poll']['slug'], '<i class="icon-comment-alt"></i> Comment on this', array('class' => 'pull-right'));
            ?> </div>
    </div>

    <div class="clearbig">&nbsp;</div>
    <div>

        <!--/myCarousel--> 
    </div>
    <!--Containr ends--> 
</div>
<!--span20 ends--> 
