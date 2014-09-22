<?php 
$itemtitle=$content['deal']['title'];
$itemid=$content['deal']['id'];
$itemtype='deals';
?>
<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>
<div class="clear">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('deals/index','Deals');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['deal']['title'],8);?></li></ul>
<div class="listing-img">
 <?php echo showBigAvatar($content['deal']['picture'],$content['deal']['title'],array('class'=>''));?>
</div>
<div id="listing-details"><h1 class="noline"><div class="span8"><?php echo anchor('deals/'.$content['deal']['slug'],$content['deal']['title']);?></div></h1>
<div class="listing-rating-container"><div class="rating-container" title="<?php echo $content['deal']['review_score'];?>"></div></div><div class="users-count"><?php echo '<a href="#reviews-box">'.$content['movie']['total_reviews'].' Reviews</a>';?>
   <?php
	if(userdata('uid'))
	{
?>
 | <a href="#review-item" role="button" data-toggle="modal">Rate this</a>
 <?php }?> </div>

<div class="listing-meta span8">
<div class="meta-title span3">Where<span>:</span></div>
<div class="meta-data span4"><?php echo anchor('yellowpages/'.$content['business']['slug'],$content['business']['title']);?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">When<span>:</span></div>
<div class="meta-data span4"><?php echo date("d M, Y",strtotime($content['deal']['starts_on'])).' - '.date("d M, Y",strtotime($content['deal']['closes_on']));?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Category<span>:</span></div>
<div class="meta-data span4"><?php echo anchor('deals/index/'.$content['deal']['category'],$this->df->get_field_value('yp_categories',array('id'=>$content['deal']['category']),'name'));?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Address<span>:</span></div>
<div class="meta-data span4"><?php echo $content['business']['address'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Phone<span>:</span></div>
<div class="meta-data span4"><?php echo $content['business']['phone'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Payment Options<span>:</span></div>
<div class="meta-data span4"><?php echo $content['business']['payment_options'];?></div>

</div><!--Listing-meta Ends-->
</div><!--Listing-Details Ends-->
<div class="sidePadding10 span11">
<?php if(strlen($content['deal']['description'])>3){?>
<div class="description" style="text-align:justify;">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['deal']['description']);?>
</div>
<?php }?>



</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span11 well well-mini">	
    <?php echo showBookmark('deals',$content['deal']['id']);?>
    <?php echo showReport('deals',$content['deal']['id']);?>
    <?php
	if(userdata('uid'))
	{
?>
<a href="#review-item" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this deal</a>
<?php }
else
{
?>
<a href="<?php echo base_url().'index.php/start/signin';?>" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this deal</a>

<?php
}
?>
</div>

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