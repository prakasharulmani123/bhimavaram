</head>
<body id="default-body">
<div id="page-loading">Please wait...</div>
<div class="container" id="header-container">
	<div class="span20 clearfix" id="topbar">
	<?php // echo $this->html->generateUL(array('Home','Classifieds','Yellow Pages'),array('id'=>'topbar'));?>
    <div class="span3 wishes-title h6 upper">Wishes</div>
    <div class="span12 wish-container sidePadding10">    	
		<ul class="wish-text" id="wish-text-scroller">
        	<?php echo getWishes();?>
        </ul>
    </div><!--Wishes Ends-->
    <a href="#post-wish" class="span3 wishes-button pull-left h6 upper" role="button" data-toggle="modal"><i class="icon-plus-sign icon-white"></i>Submit a wish</a>
	</div><!--TopBar Ends-->
    <div id="logobar" class="clearfix span20">
    	<div class="span5 pull-left" id="logo-container">
        	<?php echo anchor(base_url(),getLogo(),array('id'=>'logo'));?>
            <div class="change-city"><?php echo userdata('city');?>
                <a href="#change-city" role="button" data-toggle="modal">(Change)</a>
             </div>
        </div><!--logo-container Ends-->
         <div class="span10 pull-left" id="header-ad-spot">
         		<?php echo showAds('image','468','60', '5'); ?>
       </div>    
                
            	
         <div class="span4 pull-right" id="profile-info">
            	<?php 
				if(userdata('uid'))
				{
					
				?>
                <div class="span4 column-2" id="social-media-links">
                    <ul>
                        <li class="twitter"><?php echo anchor('http://twitter.com/designfellow','Twitter',array('target'=>'_blank'));?></li>
                        <li class="facebook"><?php echo anchor('http://facebook.com/designfellow','facebook',array('target'=>'_blank'));?></li>
                        <li class="gplus"><?php echo anchor('http://plusya.com/designfellow','Google+',array('target'=>'_blank'));?></li>
                        <li class="pinterest"><?php echo anchor('http://pinterest.com/designfellow','Pinterest',array('target'=>'_blank'));?></li>
                    </ul>
                </div><!--social ends--> 
                <div class="clear">&nbsp;</div>
                <?php echo showAvatar(userdata('picture'),userdata('name'),array('class'=>'profile-img pull-left'));?>                
                <div class="profile-data pull-left"><?php echo anchor('profile/index',userdata('name'));?><div class="profile-links"><?php echo anchor('profile/index','My Profile');?> | <?php echo anchor('site/signout','Signout');?></div></div>
                <?php
				}
				else
				{
				?>
				<div class="clearbig">&nbsp;</div>
                <div style="margin-top:18px;">
				<?php
					echo showAvatar(userdata('picture'),userdata('name'),array('class'=>'profile-img pull-left'));
				?>
                <div class="profile-data pull-left"><?php echo anchor('start/register','Another Guest');?><div class="profile-links"><?php echo anchor('start/register','Create Account');?> | <?php echo anchor('start/signin','Sign in');?></div></div>
                </div>
                <?php
				}
				?>  
                <div class="clear">&nbsp;</div>             
         </div>        
    </div><!--LogoBar Ends-->
 	<div class="clear">&nbsp;</div>
    <div id="menubar" class="clearfix"> 
		<ul class="menubar clearfix">
        <li class="first"><?php echo anchor('start/index','<i class="icon-home"></i>');?></li>
        <li><?php echo anchor('news/index','News');?></li>
        <li><?php echo anchor('yellowpages/index','Yellow Pages');?>
<!--        	<ul>
				<li><?php echo anchor('yellowpages/index','Browse Listings');?></li>            
            	<li><?php echo anchor('yellowpages/add','Add New Listing');?></li>
            </ul>        
-->        </li>
        <li><?php echo anchor('movies/index','Movies');?></li>
        <li><?php echo anchor('deals/index','Deals');?></li>
        <li><?php echo anchor('classifieds/index','Classifieds');?></li>
        <li><?php echo anchor('events/index','Events');?></li>
        <li><?php echo anchor('jobs/index','Jobs');?></li>
        <li><a href="#">More</a>
        	<ul>
            	<li><?php echo anchor('photos/index','Photo Galleries');?></li>
                <li><?php echo anchor('videos/index','Videos');?></li>
                <li><?php echo anchor('polls/index','Polls');?></li>
                <li><?php echo anchor('areas/index','Area Information');?></li>
            </ul>
        </li>   
    	<?php  /*echo $this->html->generateUL(
		array(
		'Home'=>array('link'=>'start/index'),
		'News'=>array('link'=>'news/index'),
		'Yellow Pages'=>array('link'=>'yellowpages/index'),
		'Movies'=>array('link'=>'movies/index'),
		'Deals and Discounts'=>array('link'=>'deals/index'),				
		'Jobs'=>array('link'=>'jobs/index'),
		'Classifieds'=>array('link'=>'classifieds/index'),
		'Devotional'=>array('link'=>'devotional/index'),
		'Events'=>array('link'=>'events/index'),		
		'more'=>array('link'=>'yellowpages/index','class'=>'last dropdown')
		),
		array('class'=>'menubar upper'),true);*/?>
        <li class="last">
                <?php echo form_open('start/searchresults',array("class"=>"form-search",'data-validate'=>'parsley'));?>
                       <input type="text" class="input-medium search-query input-search-box span3" name="q" data-required="true" placeholder="Search" value="<?php echo (uridata('2')=='searchresults')?uridata('3'):'';?>">

  <input type="hidden" name="searchtype" value="<?php echo userdata('searchtype')?userdata('searchtype'):'yellowpages';?>" />
  <button type="submit" class="search-btn"><i class="icon-search icon-white"></i></button>
</form>
        </li>
            <!--<li class="last">-->
<!--                             <ul class="nav pull-right" id="search-dropdown">-->
                        <li class="dropdown search-menu-holder"><a href="#" class="dropdown-toggle searchtext" data-toggle="dropdown"><?php echo userdata('searchtext')?userdata('searchtext'):'Yellow Pages';?><b class="caret"></b></a>
                            <ul class="dropdown-menu" id="search-options">
                                <li><a href="javascript:void(0)" rel="yellowpages">Yellow Pages</a></li>
                                <li><a href="javascript:void(0)" rel="classifieds">Classifieds</a></li>
                                <li><a href="javascript:void(0)" rel="news">News</a></li>
                                <li><a href="javascript:void(0)" rel="deals">Deals</a></li>
                                <li><a href="javascript:void(0)" rel="movies">Movies</a></li>
                                <li><a href="javascript:void(0)" rel="jobs">Jobs</a></li>
                            </ul>
                        </li>
                   <!-- </ul>-->
             <!--</li>-->
		</ul>    	
    </div><!--MenuBar Ends-->
    <!--============================================================================================-->
    <div class="clearbig">&nbsp;</div>
    <!---------===================-->
    
    <div class="span19" id="header-scroll-ad">
    	<div class="span2 pull-left upper center">Sponsored :</div>
        <div class="span15 pull-left scrolller">
        <ul>
    	<li><?php echo showAd('text','750','24');?></li>
        <li><?php echo showAd('text','750','24');?></li>
        <li><?php echo showAd('text','750','24');?></li>        
        <li><?php echo showAd('text','750','24');?></li>        
        <li><?php echo showAd('text','750','24');?></li>        
        </ul>
        </div>
    	<div class="span2 pull-right upper right sidePadding10"><?php //echo anchor('ads/request','Advertise here');?></div>        
    </div><!--Header-scroll-ad Ends-->   
</div><!--Header-container Ends-->
 <?php echo show_message();?><!--Flash-Message Ends-->
<!--<div class="span20 center clearfix"><?php echo showAd('image','728','90');?></div>-->
<div class="container" id="main-content">
<div class="span13 pull-left" id="content-box">