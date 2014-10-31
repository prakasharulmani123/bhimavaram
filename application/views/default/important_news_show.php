<?php
$itemtitle = $content['news']['title'];
$itemid = $content['news']['id'];
$itemtype = 'news';
?>
<div class="center clearfix" style="text-align:left !important"><?php echo showAd('image','600','90');?></div>

<?php /*?><div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
    <?php echo showAd('image', '468', '60'); ?>
</div><?php */?>
<div class="clr">&nbsp;</div>
<ul class="breadcrumb">
    <li><?php echo anchor(base_url(), 'Home'); ?><span class="divider">/</span></li>
    <li><?php echo word_limiter($content['news']['title'], 8); ?></li></ul>
<div id="listing-details span13">
    <div class="widget-heading">
        <h1 class="noline"><?php echo $content['news']['title']; ?></h1>
    </div>
    <div class="ad-meta">
        Posted on <?php echo date("d M, Y", strtotime($content['news']['date_added'])); ?> <?php /*?>in <?php echo anchor('news/index/' . $this->df->get_field_value('news_categories', array('id' => $content['news']['category']), 'slug'), $this->df->get_field_value('news_categories', array('id' => $content['news']['category']), 'name')); ?>
        | <a href="#comments-box"><i class="icon-comment-alt"></i>&nbsp; <?php echo $content['news']['total_comments'] ?> Comments</a>   
        <?php
        if (userdata('uid')) {
            ?> | <a href="#comment-item" role="button" data-toggle="modal">Post a comment</a>
            <?php
        }
        ?><?php */?>

    </div>


    <div class="news-content">
        <!--           <?php if (strlen($content['news']['picture']) > 2) { ?>
                    
            <?php echo showBigAvatar($content['news']['picture'], $content['news']['title'], array('class' => '')); ?>
        <?php } ?>-->


        <div id="myCarousel" class="carousel slide span7">
            <ol class="carousel-indicators">
                <?php
                $pictures = $content['pictures'];
                //print_r($pictures);
//   
                for ($i = 0; $i < count($pictures); $i++) {
                    if ($i == 0) {
                        $class = ' class="active" ';
                    } else {
                        $class = '';
                    }
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $class; ?>></li>
                    <?php
                }
                ?>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($pictures as $pic) {
                    if ($i == 0) {
                        $class = ' active ';
                    } else {
                        $class = '';
                    }
                    ?>
                    <div class="item <?php echo $class; ?>"><img src="<?php echo $this->settings->baseUrl() . '/uploads/thumb/' . $pic['photo']; ?>" /></div>
                    <?php
                    $i++;
                }
                ?>
            </div>
            <!-- Carousel nav -->
        </div>

                <?php echo trim(htmlspecialchars_decode($content['news']['content'])); ?>




    </div>
</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span13" style="margin-left:6px;">
<?php
if (userdata('uid')) {
    ?>
        <a href="#comment-item" class="btn btn-primary comment-item" role="button" data-toggle="modal"><i class="icon-comment-alt"></i>&nbsp; Post a comment</a>
    <?php
} else {
    ?>
        <a href="<?php echo base_url() . 'index.php/start/signin'; ?>" class="btn btn-mini btn-primary comment-item" role="button" data-toggle="modal"><i class="icon-comment-alt"></i>&nbsp; Post a comment</a>

    <?php }
    ?>
    <?php // echo showBookmark('news', $content['news']['id']); ?>    
    <?php echo showReport('news', $content['news']['id']); ?>
</div>
<div class="meta-divider">&nbsp;</div>
<div class="related-news">
    <?php if (count($content['related']) > 0) { ?>
        <ul id="listings">
            <h4>Related Posts</h4>
        <?php
        foreach ($content['related'] as $listing) {
            //echo $content['listings']['title'];
            if ($listing['id'] != $itemid) {
                ?>
                    <li class="clearfix">
                        <div class="rating"></div>
                        <div class="listing-details span8 pull-left">
                            <h3>
                            <?php
							if(substr($listing['slug'],0,4) == 'http'){
								echo '<a href="'.$listing['slug'].'">'.$listing['title'].'</a>';
							}
							else{
								echo anchor('importantnews/' . $listing['slug'], $listing['title']);
							}
							?>
                            
						<?php //echo anchor('news/' . $listing['slug'], $listing['title']); ?></h3>  
                            <div class="details clearfix margintop-15"><span>Posted on </span><?php echo date("d M, Y", strtotime($listing['date_added'])); ?></div>
                            <div class="details clearfix"><span><?php echo word_limiter(strip_tags(htmlspecialchars_decode($listing['content'])), 16); ?>
							<?php
							if(substr($listing['slug'],0,4) == 'http'){
								echo '<a href="'.$listing['slug'].'">Read news</a>';
							}
							else{
								echo anchor('importantnews/' . $listing['slug'], 'Read news'); 
							}
							?>
                            
                            </span></div>
                        </div>
                        <div class="span2 pull-left"></div>
						<?php
                        $newpic = $this->df->get_field_value('important_news_photos', array('newsid' => $listing['id']), 'photo');
                        $img = '<img src="' . $this->settings->baseUrl() . '/uploads/thumb/' . $newpic . '" alt="' . $listing['title'] . '" class="pull-left" style="max-width: none;" />';
                        //echo anchor('importantnews/' . $listing['slug'], $img, array('class' => 'listing-img'));
                        ?>
                        <?php
							if(substr($listing['slug'],0,4) == 'http'){
								echo '<a href="'.$listing['slug'].'" class="listing-img">'.$img.'</a>';
							}
							else{
								echo anchor('importantnews/' . $listing['slug'], $img, array('class' => 'listing-img'));
							}
							?>
                    </li>
                        <?php
                    }
                }
                ?>
        </ul>
<?php } ?>
</div><!--related-news Ends-->
<div id="reviews-box">
<?php echo $this->general->getComments($itemtype, $itemid, uri_string()) ?>
</div><!--Reviews-List Ends-->
<!--==========Modal Boxes Starts============-->

<div id="report-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Report this page" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="messageModal">Report this page (<?php echo $itemtitle; ?>)</h3>
    </div>
    <div class="modal-body">
<?php
echo form_open('actions/report', array('class' => 'bigform', 'data-validate' => 'parsley'));
echo $this->html->formField('label', 'Report Type', 'Please choose report type', array('class' => 'email'));
echo $this->html->formField('dropdown', 'category-required', array('' => 'Select', 'illegal' => 'Illegal Content', 'spam' => 'Spam Content', 'duplicate' => 'Duplicate Content', 'others' => 'Others'), array('class' => 'span10', 'data-required' => "true", 'id' => 'category'));
echo $this->html->formField('label', 'Message', 'Please enter your message', array('class' => 'email'));
echo $this->html->formField('textarea', 'message-required', '', array('placeholder' => 'Your message', 'class' => 'span10', 'rows' => '5', 'data-required' => "true"));
?>
        <input type="hidden" value="<?php echo $itemid; ?>" name="itemid" />
        <input type="hidden" value="<?php echo $itemtype; ?>" name="itemtype" />
        <input type="hidden" value="<?php echo uri_string(); ?>" name="itemurl" />   
        <button class="btn btn-primary submit-btn">Submit Report</button>
        </form>

    </div>
    <div class="modal-footer">

    </div>
</div>


<div id="comment-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Post a comment" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="messageModal">Post a comment on "<?php echo $itemtitle; ?>"</h3>
    </div>
    <div class="modal-body">
<?php
echo form_open('actions/comment', array('class' => 'bigform', 'data-validate' => 'parsley'));
//echo $this->html->formField('label','Report Type','Please choose a rating',array('class'=>'email'));
//echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-required'=>"true",'id'=>'category'));
?>
        <div class="clearbig">&nbsp;</div>
<?php
echo $this->html->formField('label', 'Message', 'Your Comment', array('class' => 'email'));
echo $this->html->formField('textarea', 'comment-required', '', array('placeholder' => 'Your review', 'class' => 'span10 wysiwyg', 'rows' => '5', 'data-required' => "true"));
?>
        <input type="hidden" value="<?php echo $itemid; ?>" name="itemid" />
        <input type="hidden" value="<?php echo $itemtype; ?>" name="itemtype" />
        <input type="hidden" value="<?php echo uri_string(); ?>" name="itemurl" /> 
        <button class="btn btn-primary submit-btn">Post Comment</button>
        </form>

    </div>
    <div class="modal-footer">

    </div>
</div>