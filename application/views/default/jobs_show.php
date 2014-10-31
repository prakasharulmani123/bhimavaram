<?php $itemtitle=$content['listing']['title'];
$itemid=$content['listing']['id'];
$itemtype='jobs';
?>
<!--<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>-->
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
<div class="clr">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('jobs/index','Jobs');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['listing']['title'],8);?></li></ul>
<div class="listing-img">
 <?php 
 if($content['listing']['business']!='0')
 {
 echo showBigAvatar($content['business']['picture'],$content['listing']['title'],array('class'=>''));
 }
 ?>

</div>
<div id="listing-details"><h1 class="noline"><div class="span8"><?php echo $content['listing']['title'];?></div></h1>
<div class="listing-meta span8">
<div class="meta-title span3">Industry<span>:</span></div>
<div class="meta-data span4"><?php echo anchor('jobs/index/'.$content['listing']['category'],$this->df->get_field_value('jobs_categories',array('id'=>$content['listing']['category']),'name'));?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Job Type<span>:</span></div>
<div class="meta-data span4"><?php echo $this->df->get_field_value('jobs_type',array('id'=>$content['listing']['jobtype']),'name');?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Qualification<span>:</span></div>
<div class="meta-data span4"><?php echo $this->df->get_field_value('jobs_qualifications',array('id'=>$content['listing']['qualification']),'name');?></div>
<div class="meta-divider">&nbsp;</div>
<?php if($content['listing']['business']!='0')
{
?>
<div class="meta-title span3">Location<span>:</span></div>
<div class="meta-data span4"><?php echo $content['listing']['location'].' ('.$this->df->get_field_value('cities',array('id'=>$content['listing']['id']),'city').')';?></div>
<div class="meta-divider">&nbsp;</div>
<?php }?>
<div class="meta-title span3">Salary<span>:</span></div>
<div class="meta-data span4">Rs.<?php echo $content['listing']['salary_from'].' - Rs.'.$content['listing']['salary_to'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Experience<span>:</span></div>
<div class="meta-data span4"><?php echo $content['listing']['exp_from'].' - '.$content['listing']['exp_to'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php if($content['listing']['business']!='0')
{
?>
<div class="meta-title span3">Phone Number<span>:</span></div>
<div class="meta-data span4"><?php echo $content['business']['phone'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Business Name<span>:</span></div>
<div class="meta-data span4"><?php echo anchor('yellowpages/'.$content['business']['slug'],$content['business']['title']);?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Address<span>:</span></div>
<div class="meta-data span4"><?php echo $content['business']['address'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php 
}else{
?>
<div class="meta-title span3">Phone Number<span>:</span></div>
<div class="meta-data span4"><?php echo $content['listing']['phone'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Business Name<span>:</span></div>
<div class="meta-data span4"><?php echo $content['listing']['business_name'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Address<span>:</span></div>
<div class="meta-data span4"><?php echo $content['listing']['address'];?></div>
<div class="meta-divider">&nbsp;</div>
<?php }?>
<div class="meta-title span3">Last date to apply<span>:</span></div>
<div class="meta-data span4"><?php echo date("d M, Y",strtotime($content['listing']['last_date']));?></div>

</div><!--Listing-meta Ends-->
</div><!--Listing-Details Ends-->
<div class="sidePadding10 span11">
<?php if(strlen($content['listing']['description'])>3){?>
<div class="description">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['listing']['description']);?>
</div>
<?php }?>


</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span11 well well-mini">	
    <?php echo showBookmark('jobs',$content['listing']['id']);?>
    <?php echo showReport('jobs',$content['listing']['id']);?>
    <?php
	if(userdata('uid'))
	{
?>
<a href="#send-message" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-envelope-alt"></i>&nbsp; Send a Message</a>
<?php }
else
{
?>
<a href="<?php echo base_url().'index.php/start/signin';?>" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-envelope-alt"></i>&nbsp; Send a Message</a>
<?php
}
?>
</div>

<!--<div id="reviews-box">-->
    <?php //echo $this->general->getReviews($itemtype,$itemid,uri_string())?>
<!--</div>--><!--Reviews-List Ends-->

<!--==========Modal Boxes Starts============-->

<div id="send-message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Send a Message" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="messageModal">Send a message to <span class="to-email"><?php echo $content['listing']['title'];?></span></h3>
  </div>
  <div class="modal-body">
   <?php
   		echo form_open('jobs/message',array('class'=>'bigform','data-validate'=>'parsley'));
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

