<?php 
$itemtitle=$content['event']['name'];
$itemid=$content['event']['id'];
$itemtype='events';
?>
<!--<div class="center clearfix" style="text-align:left !important"><?php echo showAd('image','600','90');?></div>-->
<div class="bhi-topscroll">
    <div class="carousel" data-ride="carousel" id="inner-topad">
      <div class="carousel-inner">
        <?php $executive_ads = showAdsInArray('image', '650', '90', 15, 'span6',$this->uri->segment(1)); ?>
        <div class="item active ads300">
          <?php
                $initial_executive_ads_count = 0;
                $executive_ads_count = count($executive_ads);

                foreach ($executive_ads as $executive_ad) {
                    $initial_executive_ads_count++;
					
					echo '<div class="topad">';
                    echo $executive_ad;
					echo '</div>';
					
                    if ($initial_executive_ads_count % 1 == 0) {
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
<?php /*?><div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div><?php */?>
<div class="clr">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('events/index/'.$content['event']['category'].'/everything','Events / '.$this->df->get_field_value('events_categories',array('id'=>$content['event']['category']),'name'));?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['event']['name'],8);?></li></ul>
 
 
<div class="widget-heading"><h1 style="line-height:normal"><div class="span12"><?php echo $content['event']['name'];?></div></h1></div>

<!-- New content -->
<div class="listing-img detail-img">
	<?php if(strlen($content['event']['picture'])>2){?>
	    <?php echo showBigAvatar($content['event']['picture'],$content['event']['title'],array('class'=>''));?>
    <?php }?>
</div>

<div id="listing-details">
<div class="listing-rating-container" style="width:75%;">
    Posted on <?php echo date("d M, Y",strtotime($content['event']['date_posted']));?> in <?php echo anchor('events/index/'.$content['event']['category'].'/everything',$this->df->get_field_value('events_categories',array('id'=>$content['event']['category']),'name'));?>
<!-- | <a href="#comments-box"><i class="icon-comment-alt"></i>&nbsp; <?php echo $content['event']['total_comments']?> Comments</a> | <a href="#comment-item" role="button" data-toggle="modal">Post a comment</a>-->

    </div>
<?php /*?>
<div class="listing-rating-container"><div class="rating-container" title="<?php echo $content['deal']['review_score'];?>"></div></div>
<div class="users-count"><?php echo '<a href="#reviews-box">'.$content['movie']['total_reviews'].' Reviews</a>';?>
   <?php
	if(userdata('uid'))
	{
?>
 | <a href="#review-item" role="button" data-toggle="modal">Rate this</a>
 <?php }?> </div>
 <?php */?>

<div class="listing-meta span8">
<div class="meta-title span3">Date<span>:</span></div>
<div class="meta-data span4"><?php echo date("d M ",strtotime($content['event']['start_date'].' 00:00:00')).' - '.date("d M Y",strtotime($content['event']['end_date'].' 00:00:00'));?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Timings<span>:</span></div>
<div class="meta-data span4"><?php echo $content['event']['start_time'].' - '.$content['event']['end_time'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Venue<span>:</span></div>
<div class="meta-data span4"><?php echo $content['event']['venue_name'];?></div>

<?php if(strlen($content['event']['url'])>4){?>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Website<span>:</span></div>
<div class="meta-data span4"><?php echo anchor($content['event']['url'],'Click here to visit',array('class'=>'','target'=>'_blank'));?></div>
<?php }?>

<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Ticket Price<span>:</span></div>
<div class="meta-data span4"><?php echo $price=($content['event']['price']=='0')?'Free':'<i class="icon-rupee"></i>&nbsp; '.$content['event']['price'];?> <?php if(strlen($content['event']['price'])>3){echo anchor($content['event']['ticket_url'],'Buy Tickets',array('class'=>'span2 pull-right btn btn-primary top-15','target'=>'_blank'));}?></div>

<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Address<span>:</span></div>
<div class="meta-data span4"><?php echo $content['event']['venue_address'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Contact<span>:</span></div>
<div class="meta-data span4"><?php echo $content['event']['phone'];?> / <?php echo $content['event']['email'];?></div>

</div><!--Listing-meta Ends-->
</div><!--Listing-Details Ends-->
<div class="sidePadding10 span11">
<div class="description" style="text-align:justify; padding:0px !important;">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['event']['description']);?>
</div>



</div><!--Listing-Meta-Right Ends-->



<!-- Old content --->
<?php /*?>
<div id="listing-details span13">
<h1 class="noline"><?php echo $content['event']['name'];?>
</h1>
    <div class="ad-meta">
    Posted on <?php echo date("d M, Y",strtotime($content['event']['date_posted']));?> in <?php echo anchor('events/index/'.$content['event']['category'].'/everything',$this->df->get_field_value('events_categories',array('id'=>$content['event']['category']),'name'));?>
<!-- | <a href="#comments-box"><i class="icon-comment-alt"></i>&nbsp; <?php echo $content['event']['total_comments']?> Comments</a> | <a href="#comment-item" role="button" data-toggle="modal">Post a comment</a>-->

    </div>
    

    <div class="news-content span12 pull-left">
           <?php if(strlen($content['event']['picture'])>2){?>
        
         <?php echo showBigAvatar($content['event']['picture'],$content['event']['title'],array('class'=>''));?>
        <?php }?>
    
    <div class="event-details span5 pull-left">
        <span class="heading-title">Date </span><div class="meta-divide">&nbsp;</div><?php echo date("d M ",strtotime($content['event']['start_date'].' 00:00:00')).' - '.date("d M Y",strtotime($content['event']['end_date'].' 00:00:00'));?>
		<div class="meta-divide">&nbsp;</div>
        <span class="heading-title">Timings </span><div class="meta-divide">&nbsp;</div><?php echo $content['event']['start_time'].' - '.$content['event']['end_time'];?>
        <div class="meta-divider">&nbsp;</div>
        <span class="heading-title">Venue </span> <div class="meta-divide">&nbsp;</div><?php echo $content['event']['venue_name'];?>
        <div class="meta-divider">&nbsp;</div>
        <?php if(strlen($content['event']['url'])>4){
		?>
        <span class="heading-title">Website</span> <div class="meta-divide">&nbsp;</div><?php echo anchor($content['event']['url'],'Click here to visit',array('class'=>'','target'=>'_blank'));?>
        <div class="meta-divider">&nbsp;</div>		
		<?php	
		}?>
        <span class="heading-title">Ticket Price </span><div class="meta-divide">&nbsp;</div><?php echo $price=($content['event']['price']=='0')?'Free':'<i class="icon-rupee"></i>&nbsp; '.$content['event']['price'];?> 
        
        <?php if(strlen($content['event']['price'])>3){echo anchor($content['event']['ticket_url'],'Buy Tickets',array('class'=>'span2 pull-right btn btn-primary top-15','target'=>'_blank'));}?>       

    </div><!--Event-Details Ends--> 
    </div>   
</div><!--Listing-Meta-Right Ends-->

<div class="meta-divider">&nbsp;</div>

<div class="description span12">
<div class="span5 pull-left">
<span class="heading-title">Address </span>   <div class="meta-divide">&nbsp;</div> <div class="address"><?php echo $content['event']['venue_address'];?></div>
</div>
<div class="span6 pull-left offset1">
<span class="heading-title">Contact </span> <div class="meta-divide">&nbsp;</div> <div class="address"><?php echo $content['event']['phone'];?> / <?php echo $content['event']['email'];?></div>        
</div>

<div class="meta-divider">&nbsp;</div>
<span class="heading-title">Description</span>
<div class="meta-divider">&nbsp;</div>
<div style="text-align:justify">
<?php echo htmlspecialchars_decode($content['event']['description']);?>
</div>
</div>
<?php */?>

<div class="meta-divider">&nbsp;</div>
<div class="span13 well well-mini" style="margin-left:0px;">
<!--<a href="#comment-item" class="btn btn-primary comment-item" role="button" data-toggle="modal"><i class="icon-comment-alt"></i>&nbsp; Post a comment</a>
--><?php echo showBookmark('events',$content['event']['id']);?>    
<?php echo showReport('events',$content['event']['id']);?>

</div>
<div class="meta-divider">&nbsp;</div>
<div class="related-news">
<?php if(count($content['related'])>0){?>
<ul id="listings">
<h4>Related Posts</h4>
<?php
	foreach($content['related'] as $listing)
	{
		//echo $content['listings']['title'];
		if($listing['id']!=$itemid)
		{
?>
<li class="clearfix">
<?php echo anchor('news/'.$listing['slug'],showAvatar($listing['picture'],$listing['title'],array('class'=>'pull-left')),array('class'=>'listing-img'));?>
<div class="rating"></div>
<div class="listing-details span7 pull-left">
	<h3><?php echo anchor('news/'.$listing['slug'],$listing['title']);?></h3>  
    <div class="details clearfix margintop-15"><span>Posted on </span><?php echo date("d M, Y",strtotime($listing['date_added']));?></div>
    <div class="details clearfix"><span><?php echo word_limiter(strip_tags(htmlspecialchars_decode($listing['content'])),16);?><?php echo anchor('news/'.$listing['slug'],'Read news');?></span></div>
</div>
</li>
<?php	
		}
	}
?>
</ul>
<?php }?>
</div><!--related-news Ends-->
<div id="reviews-box">
    <?php //echo $this->general->getComments($itemtype,$itemid,uri_string())?>
</div><!--Reviews-List Ends-->
<!--==========Modal Boxes Starts============-->

<div id="report-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Report this page" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="messageModal">Report this page (<?php echo $itemtitle;?>)</h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('actions/report',array('class'=>'bigform','data-validate'=>'parsley'));
		echo $this->html->formField('label','Report Type','Please choose report type',array('class'=>'email'));
		echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-required'=>"true",'id'=>'category'));
		echo $this->html->formField('label','Message','Please enter your message',array('class'=>'email'));
		echo $this->html->formField('textarea','message-required','',array('placeholder'=>'Your message','class'=>'span10','rows'=>'5','data-required'=>"true"));		
   ?>
   <input type="hidden" value="<?php echo $itemid;?>" name="itemid" />
   <input type="hidden" value="<?php echo $itemtype;?>" name="itemtype" />
   <input type="hidden" value="<?php echo uri_string();?>" name="itemurl" />   
   		<button class="btn btn-primary submit-btn">Submit Report</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>


<div id="comment-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Post a comment" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="messageModal">Post a comment on "<?php echo $itemtitle;?>"</h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('actions/comment',array('class'=>'bigform','data-validate'=>'parsley'));
		//echo $this->html->formField('label','Report Type','Please choose a rating',array('class'=>'email'));
		//echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-required'=>"true",'id'=>'category'));
	?>
    <div class="clearbig">&nbsp;</div>
	<?php
		echo $this->html->formField('label','Message','Your Comment',array('class'=>'email'));
		echo $this->html->formField('textarea','comment-required','',array('placeholder'=>'Your review','class'=>'span10 wysiwyg','rows'=>'5','data-required'=>"true"));		
   ?>
   <input type="hidden" value="<?php echo $itemid;?>" name="itemid" />
   <input type="hidden" value="<?php echo $itemtype;?>" name="itemtype" />
   <input type="hidden" value="<?php echo uri_string();?>" name="itemurl" /> 
   		<button class="btn btn-primary submit-btn">Post Comment</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>
<div class="meta-divider">&nbsp;</div>