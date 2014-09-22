<?php $itemtitle=$content['ad']['title'];
$itemid=$content['ad']['id'];
$itemtype='classifieds';
?>
<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>
<div class="clear">&nbsp;</div>
<div id="listing-details span13"><h1 class="noline"><?php echo $content['ad']['title'];?>
</h1>
<div class="ad-meta">
Posted in <?php echo anchor('classifieds/ads/'.$content['ad']['category'],$this->df->get_field_value('classy_categories',array('id'=>$content['ad']['category']),'name'));?>
</div>

<div class="clear">&nbsp;</div>
<div class="listing-img pull-left span6">
 <?php echo showBigAvatar($content['ad']['picture'],$content['ad']['title'],array('class'=>''));?>
</div>
<div class="ad-details span7 pull-left">
<div class="meta-label clearfix"><span>Ad Type </span><?php echo $content['ad']['adtype'];?></div>
<div class="meta-label clearfix"><span>Location </span><?php echo $this->df->get_field_value('cities',array('id'=>$content['ad']['cityid']),'city');?></div>
<div class="meta-label clearfix"><span>Price </span> <?php echo $price=($content['ad']['price']=='0')?'Free':'<i class="icon-rupee"></i>&nbsp; '.$content['ad']['price'];?></div>
<div class="meta-label clearfix"><span>Contact Person </span><?php echo $this->df->get_field_value('users',array('uid'=>$content['ad']['uid']),'name');?></div>
<div class="meta-label clearfix"><span>Phone </span><?php echo $content['ad']['phone'];?></div>
</div>
</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span12">
<?php echo showBookmark('classifieds',$content['ad']['id']);?>    
<?php echo showReport('classifieds',$content['ad']['id']);?>
<?php
	if(userdata('uid'))
	{
?>
    <a href="#send-message" class="btn btn-primary pull-right big-text abovePadding10 span7" role="button" data-toggle="modal"><i class="icon-envelope-alt"></i>&nbsp; Reply to this Ad</a>
<?php }
else
{
?>    
    <a href="<?php echo base_url().'index.php/start/signin';?>" class="btn btn-primary pull-right big-text abovePadding10 span6" role="button" data-toggle="modal"><i class="icon-envelope-alt"></i>&nbsp; Reply to this Ad</a>
<?php
}
?>
</div>
<div class="meta-divider">&nbsp;</div>

<?php if(strlen($content['ad']['description'])>3){?>
<div class="span12 description">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['ad']['description']);?>
</div>
<?php }?>

<!--==========Modal Boxes Starts============-->

<div id="send-message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Send a Message" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="messageModal">Send a message to <span class="to-email"><?php echo $itemtitle;?></span></h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('classifieds/message',array('class'=>'bigform','data-validate'=>'parsley'));
	?> 
	<?php
		echo $this->html->formField('label','Message','Please enter your message*',array('class'=>'email'));
		echo $this->html->formField('textarea','message-required','',array('placeholder'=>'Your message','class'=>'span10','rows'=>'5','data-required'=>"true"));		
   ?>
   	 <div class="control-group">
    <label class="control-label" for="inputName">Name*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','name-required',userdata('name'),array('placeholder'=>'Your Name','class'=>'span6','data-required'=>"true"));?>
    </div>
  </div>
	 <div class="control-group">
    <label class="control-label" for="inputName">Email Address*</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','email-required-valid_email',userdata('email'),array('placeholder'=>'','class'=>'span6','data-required'=>"true",'data-type'=>"email"));?>
    </div>
  </div> 
	 <div class="control-group">
    <label class="control-label" for="inputName">Phone Number</label>
    <div class="controls">
      <?php  echo $this->html->formField('input','phone-numeric','',array('placeholder'=>'Only digits allowed','class'=>'span6','data-type'=>"digits"));?>      
    </div>
  </div>   
   <input type="hidden" value="<?php echo $itemid;?>" name="listingid" />
   		<button class="btn btn-primary submit-btn span6 abovePadding10">Send Message</button>
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