
  <div class="bhinew-scroll">
    <div class="bhinew-scrollheading"> Wishes </div>
    <div class="bhinew-scrolltxt">
    	<div class="wish-container sidePadding10">    	
                <ul class="wish-text" id="wish-text-scroller">
                    <?php echo getWishes(); ?>
                </ul>
            </div>
    </div>
    <div class="bhinew-wishbg">
    <a href="#post-wish" data-toggle="modal"> <i class="fa fa-plus-circle"></i> Submit a wish </a>
    </div>
  </div>
  
  <div class="bhinew-inncontainer2">
    <div class="bhinew-logo">
	<?php echo anchor(base_url(), getLogo(), array('id' => 'logo')); ?>
    <?php echo userdata('city'); ?><a href="#change-city" role="button" data-toggle="modal">(Change)</a>
    </div>
    <div class="bhinew-logo-header-ad" id="header-ad-spot">
      <?php echo showAds('image', '468', '60', '5'); ?>
    </div>
    <div class="bhinew-profilelink"><?php echo anchor('start/register', 'Create Account'); ?><br/>
     <?php echo anchor('start/signin', 'Sign in'); ?></div>
    <div class="bhi-menucont">
      <div class="bhi-menuleft"> </div>
      <div class="bhi-menubg">
        <div class="bhi-menu">
          <div class="ddsmoothmenu" id="smoothmenu1">
            <!--<ul>
              <li><a href="#"> <i class="fa fa-home"></i> Home </a></li>
              <li><a href="#"> News </a></li>
              <li><a href="#"> Yellow Pages </a></li>
              <li><a href="#"> Movies </a></li>
              <li><a href="#"> Deals </a></li>
              <li><a href="#"> Classifieds </a></li>
              <li><a href="#"> Events </a></li>
              <li><a href="#"> Jobs </a></li>
              <li><a href="#"> More</a>
                <ul>
                  <li><a href="#">Photo Galleries</a></li>
                  <li><a href="#">Videos</a></li>
                  <li><a href="#">Polls</a></li>
                  <li><a href="#">Area Information</a></li>
                </ul>
              </li>
            </ul>-->
            <ul class="menubar clearfix">
                    <li class="first"><?php echo anchor('start/index', '<i class="fa fa-home"></i> Home'); ?></li>
                    <li><?php echo anchor('news/index', 'News'); ?></li>
                    <li><?php echo anchor('yellowpages/index', 'Yellow Pages'); ?>
                        <!--        	<ul>
                                                        <li><?php echo anchor('yellowpages/index', 'Browse Listings'); ?></li>            
                                        <li><?php echo anchor('yellowpages/add', 'Add New Listing'); ?></li>
                                    </ul>        
                        -->        </li>
                    <li><?php echo anchor('movies/index', 'Movies'); ?></li>
                    <li><?php echo anchor('deals/index', 'Deals'); ?></li>
                    <!--<li><?php echo anchor('classifieds/index', 'Classifieds'); ?></li>-->
                    <li><?php echo anchor('events/index', 'Events'); ?></li>
                    <li><?php echo anchor('jobs/index', 'Jobs'); ?></li>
                    <li><a href="#">More</a>
                        <ul>
                            <li><?php echo anchor('photos/index', 'Photo Galleries'); ?></li>
                            <li><?php echo anchor('videos/index', 'Videos'); ?></li>
                            <li><?php echo anchor('polls/index', 'Polls'); ?></li>
                            <li><?php echo anchor('areas/index', 'Area Information'); ?></li>
                        </ul>
                    </li>   
                     <li class="dropdown search-menu-holder"><a href="#" class="dropdown-toggle searchtext" data-toggle="dropdown" style="background:#FFFFFF; float:left; height:30px; margin-top:5px; color:#156EB0"><?php echo userdata('searchtext') ? userdata('searchtext') : 'Yellow Pages'; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" id="search-options">
                            <li><a href="javascript:void(0)" rel="yellowpages">Yellow Pages</a></li>
                            <li><a href="javascript:void(0)" rel="classifieds">Classifieds</a></li>
                            <li><a href="javascript:void(0)" rel="news">News</a></li>
                            <li><a href="javascript:void(0)" rel="deals">Deals</a></li>
                            <li><a href="javascript:void(0)" rel="movies">Movies</a></li>
                            <li><a href="javascript:void(0)" rel="jobs">Jobs</a></li>
                        </ul>
                    </li>
                    <li class="last">
                    <?php echo form_open('start/searchresults', array("class" => "form-search", 'data-validate' => 'parsley')); ?>
                        <input type="text" class="input-medium search-query input-search-box span3" name="q" data-required="true" placeholder="Search" value="<?php echo (uridata('2') == 'searchresults') ? uridata('3') : ''; ?>">

                        <input type="hidden" name="searchtype" value="<?php echo userdata('searchtype') ? userdata('searchtype') : 'yellowpages'; ?>" />
                        <button type="submit" class="search-btn"><i class="icon-search icon-white"></i></button>
                        </form>
                    </li>
                   
                </ul> 
          </div>
        </div>
        <div class="search-field">
        
        
         </div>
      </div>
      <div class="bhi-menuright"> </div>
    </div>
    <div class="span16" id="header-scroll-ad">
                <div class="span2 pull-left upper center">Sponsored :</div>
                <div class="span14 pull-left scrolller">
                    <ul>
                        <li><?php echo showAd('text', '750', '24'); ?></li>
                        <li><?php echo showAd('text', '750', '24'); ?></li>
                        <li><?php echo showAd('text', '750', '24'); ?></li>        
                        <li><?php echo showAd('text', '750', '24'); ?></li>        
                        <li><?php echo showAd('text', '750', '24'); ?></li>        
                    </ul>
                </div>
            </div>
    <div class="bhi-social"> 
    <img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/facebook.png" width="22" height="21" alt=""> 
    <img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/twitter.png" width="22" height="21" alt=""> 
    <img src="<?php echo $this->settings->baseUrl(); ?>themes/default/images/gplus.png" width="22" height="21" alt="">
    </div>
 

