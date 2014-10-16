<?php 
$itemtitle=$content['movie']['name'];
$itemid=$content['movie']['id'];
$itemtype='movies';
?>
<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>
<div class="clr">&nbsp;</div>
<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('movies/index','Movies');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['movie']['name'],8);?></li></ul>
<div class="listing-img detail-img" style="margin-right:20px;">
 <?php echo showBigAvatar($content['movie']['picture'],$content['movie']['name'],array('class'=>''));?>
<div class="clearbig">&nbsp;</div>
</div>
<div id="listing-details"><h1 class="noline"><div class="span8"><?php echo anchor('movies/'.$content['movie']['slug'],$content['movie']['name']).' ('.urldecode($this->df->get_field_value('movie_certificate',array('id'=>$content['movie']['certificate']),'name')).')';?></div></h1>
<div class="listing-rating-container"><div class="rating-container" title="<?php echo $content['movie']['review_score'];?>"></div></div><div class="users-count"><?php echo '<a href="#reviews-box">'.$content['movie']['total_reviews'].' Reviews</a>';?>
   <?php
	if(userdata('uid'))
	{
?>
 | <a href="#review-item" role="button" data-toggle="modal">Rate this</a>
 <?php }?> 
 </div>

<div class="listing-meta span8">
<div class="meta-title span3">Released on<span>:</span></div>
<div class="meta-data span4"><?php echo date("d M, Y",strtotime($content['movie']['release_date']));?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Category<span>:</span></div>
<div class="meta-data span4"><?php echo $this->df->get_field_value('movies_categories',array('id'=>$content['movie']['category']),'name');?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Language<span>:</span></div>
<div class="meta-data span4"><?php echo $this->df->get_field_value('movies_languages',array('id'=>$content['movie']['language']),'name');?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Cast<span>:</span></div>
<div class="meta-data span4"><?php echo $content['movie']['cast'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Director<span>:</span></div>
<div class="meta-data span4"><?php echo $content['movie']['director'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Music Director<span>:</span></div>
<div class="meta-data span4"><?php echo $content['movie']['music'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Producer<span>:</span></div>
<div class="meta-data span4"><?php echo $content['movie']['camera'];?></div>
</div><!--Listing-meta Ends-->
</div><!--Listing-Details Ends-->
<div class="sidePadding10 span11">
<div class="clearbig">&nbsp;</div>
<?php echo getTheatresList($content['movie']['id']);?>
<?php if(strlen($content['movie']['description'])>3){?>
<div class="description">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['movie']['description']);?>
</div>
<?php }?>



</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span11 well well-mini" style="margin-left: 10px;">	
    <?php echo showBookmark('movies',$content['movie']['id']);?>
    <?php echo showReport('movies',$content['movie']['id']);?>
    
   <?php
	if(userdata('uid'))
	{
?>
<a href="#review-item" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this movie</a>
<?php }
else
{
?>
<a href="<?php echo base_url().'index.php/start/signin';?>" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this movie</a>

<?php
}
?></div>

<div id="reviews-box">
    <?php echo $this->general->getReviews($itemtype,$itemid,uri_string())?>
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

<div id="review-item" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Review this page" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="messageModal">Rate this page (<?php echo $itemtitle;?>)</h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('actions/review',array('class'=>'bigform','data-validate'=>'parsley'));
		echo $this->html->formField('label','Report Type','Please choose a rating',array('class'=>'email'));
		//echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-required'=>"true",'id'=>'category'));
	?>
	<div class="rating-active-container pull-left"></div><div class="rating-text pull-left"></div>
    <div class="clearbig">&nbsp;</div>
	<?php
		echo $this->html->formField('label','Message','Please write your review',array('class'=>'email'));
		echo $this->html->formField('textarea','message-required','',array('placeholder'=>'Your review','class'=>'span10 wysiwyg','rows'=>'5','data-required'=>"true"));		
   ?>
   <input type="hidden" value="<?php echo $itemid;?>" name="itemid" />
   <input type="hidden" value="<?php echo $itemtype;?>" name="itemtype" />
   <input type="hidden" value="<?php echo uri_string();?>" name="itemurl" /> 
   <input type="hidden" id="rating-active-score" name="score-required" value="" data-required="true" />
   		<button class="btn btn-primary submit-btn">Submit Review</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>