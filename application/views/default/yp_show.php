<style>
.widget-heading a{
	float:none !important;
}
</style>
<?php $itemtitle=$content['listing']['title'];
$itemid=$content['listing']['id'];
$itemtype='yellowpages';

echo $this->load->view('default/sidebars/top_ad_banner', '', true);
?>

<div class="clear">&nbsp;</div>
<ul class="breadcrumb">
  <li><?php echo anchor('yellowpages/index','Browse Listings');?><span class="divider">/</span></li>
  <li><?php echo anchor('yellowpages/listings/'.$content['category'][0]['id'],$content['category'][0]['name']);?><span class="divider">/</span></li>
  <li><?php echo $content['listing']['title']?></li>
</ul>

<div class="widget-heading">
<h1 style="line-height:normal;"><?php echo $content['listing']['title']?></h1>
</div>

<div class="listing-img detail-img">
 <?php echo showBigAvatar($content['listing']['picture'],$content['listing']['title'],array('class'=>''));?>
</div>

<div id="listing-details">
<div class="listing-rating-container"><div class="rating-container" title="<?php echo $content['listing']['review_score'];?>"></div></div><div class="users-count"><?php echo '<a href="#reviews-box">'.$content['listing']['total_reviews'].' Reviews</a>';?>
   <?php
	if(userdata('uid'))
	{
?>
 | <a href="#review-item" role="button" data-toggle="modal">Rate this</a>
 <?php }?>
 </div>
<div class="listing-meta span9" style="width:420px;">
<div class="meta-title span3">Category<span>:</span></div>
<div class="meta-data span5"><?php echo anchor('yellowpages/listings/'.$content['listing']['category'],$this->df->get_field_value('yp_categories',array('id'=>$content['listing']['category']),'name'));?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Address<span>:</span></div>
<div class="meta-data span5"><?php echo $content['listing']['address'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php if($content['listing']['phone']!='')
{?>
<div class="meta-title span3">Phone Number<span>:</span></div>
<div class="meta-data span5"><?php echo $content['listing']['phone'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php
}
?>

<?php if(strlen($content['listing']['mobile'])>1){?>
<div class="meta-title span3">Mobile Number<span>:</span></div>
<div class="meta-data span5"><?php echo $content['listing']['mobile'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php }?>
<?php if(strlen($content['listing']['fax'])>1){?>
<div class="meta-title span3">Fax<span>:</span></div>
<div class="meta-data span5"><?php echo $content['listing']['fax'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php }?>
<?php if($content['listing']['website']!='')
{?>
<div class="meta-title span3">Website<span>:</span></div>
<div class="meta-data span5"><?php echo $content['listing']['website'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php
}
?>
<?php if(strlen($content['listing']['twitter'])>1 || strlen($content['listing']['facebook'])>1 || strlen($content['listing']['googleplus'])>1){?>
<div class="meta-title span3">Social Profile<span>:</span></div>
<div class="meta-divider">&nbsp;</div>
<?php }?>
<?php if($content['listing']['payment_options']!='')
{?>
<div class="meta-title span3">Payment Options<span>:</span></div>
<div class="meta-data span4"><?php echo $content['listing']['payment_options'];?></div>
<?php }?>
</div><!--Listing-meta Ends-->
</div><!--Listing-Details Ends-->
<div class="clear">&nbsp;</div>
<div class="padding10 span13" style="margin-left:0px;">
<?php if(strlen($content['listing']['description'])>3){?>
<div class="description span7">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['listing']['description']);?>
</div>
<?php }?>
<div class="working-hours span5">
<h4 class="underline">Working Hours</h4>
<div class="list-data"><?php 
$timings=json_decode($content['listing']['working_hours'],true);
foreach($timings as $k=>$v)
{
	echo '<div><span class="span2">'.ucwords($k).'</span> : '.$v.'</div>';
}
?></div>

</div>

</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span12 well well-mini" style="margin-left:10px;">
	<?php if(userdata('uid')) { ?>
	<a href="#send-message" class="btn send-message" role="button" data-toggle="modal"><i class="icon-envelope-alt"></i>&nbsp; Send a Message</a>
    <?php } else {?>
    <a href="<?php echo base_url().'index.php/yellowpages/yellow_auth/'.$content['listing']['slug'];?>" class="btn send-message" role="button" data-toggle="modal"><i class="icon-envelope-alt"></i>&nbsp; Send a Message</a>
    <?php } ?>
    <?php echo showBookmark('yellowpages',$content['listing']['id']);?>
    <?php echo showReport('yellowpages',$content['listing']['id']);?>
    <?php if(userdata('uid')) { ?>
	<a href="#review-item" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this listing</a>
	<?php } else { ?>
	<a href="<?php echo base_url().'index.php/yellowpages/yellow_auth/'.$content['listing']['slug'];?>" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this listing</a>
	<?php } ?>
</div>

<div id="reviews-box">
    <?php echo $this->general->getReviews($itemtype,$itemid,uri_string())?>
</div><!--Reviews-List Ends-->

<!--==========Modal Boxes Starts============-->

<div id="send-message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Send a Message" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="messageModal">Send a message to <span class="to-email"><?php echo $content['listing']['title'];?></span></h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('yellowpages/message',array('class'=>'bigform','data-validate'=>'parsley'));
		echo $this->html->formField('label','Message','Please enter your message',array('class'=>'email'));
		echo $this->html->formField('textarea','message-required','',array('placeholder'=>'Your message','class'=>'span10','rows'=>'5','data-required'=>"true"));		
   ?>
   <input type="hidden" value="<?php echo $content['listing']['id'];?>" name="listingid" />
   <input type="hidden" value="<?php echo $content['listing']['slug'];?>" name="slug" />
   		<button class="btn btn-primary submit-btn">Send Message</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>



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