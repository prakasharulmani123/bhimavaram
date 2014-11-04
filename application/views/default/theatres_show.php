<?php 
$itemtitle=$content['theatre']['name'];
$itemid=$content['theatre']['id'];
$itemtype='theatres';
?>
<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>
<div class="clear">&nbsp;</div>
<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('movies/theatres','Theatres');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['theatre']['name'],8);?></li></ul>
 
<div class="widget-heading">
<h1 style="line-height:normal"><?php echo anchor('movies/theatre/'.$content['theatre']['slug'],ucfirst($content['theatre']['name']));?></h1>
</div>

<div class="listing-img detail-img">
 <?php echo showBigAvatar($content['theatre']['picture'],$content['theatre']['name'],array('class'=>''));?>
 	<?php /*?><div class="share-btn">
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_google_plusone_share"></a>
        <a class="addthis_button_pinterest_share"></a>
        <a class="addthis_button_email"></a>
        </div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51ed30806c650b5f"></script>
        <!-- AddThis Button END -->
	</div><?php */?>
</div>
<div id="listing-details">
<div class="listing-rating-container"><div class="rating-container" title="<?php echo $content['theatre']['review_score'];?>"></div></div><div class="users-count"><?php echo '<a href="#reviews-box">'.$content['theatre']['total_reviews'].' Reviews</a>';?>
    <?php
	if(userdata('uid'))
	{
?>
 | <a href="#review-item" role="button" data-toggle="modal">Rate this</a>
 <?php }?>
 </div>

<div class="listing-meta span8">
<div class="meta-title span3">Operating since<span>:</span></div>
<div class="meta-data span4"><?php echo $content['theatre']['started_at'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Address<span>:</span></div>
<div class="meta-data span4"><?php echo $content['theatre']['address'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Landmark<span>:</span></div>
<div class="meta-data span4"><?php echo $content['theatre']['landmark'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Timings<span>:</span></div>
<div class="meta-data span4"><?php echo $content['theatre']['timings_from'].' - '.$content['theatre']['timings_to'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Contact Person<span>:</span></div>
<div class="meta-data span4"><?php echo $content['theatre']['contact_person'];?></div>
<div class="meta-divider">&nbsp;</div>
<div class="meta-title span3">Phone<span>:</span></div>
<div class="meta-data span4"><?php echo $content['theatre']['phone'];?></div>
</div><!--Listing-meta Ends-->
</div><!--Listing-Details Ends-->
<div class="sidePadding10 span12">
<?php if(strlen($content['theatre']['description'])>3){?>
<div class="description">
<h4 class="underline">Description</h4>
<?php echo htmlspecialchars_decode($content['theatre']['description']);?>
</div>
<?php }?>
<div class="clearbig">&nbsp;</div>
<?php echo getMoviesList($content['theatre']['id']);?>


</div><!--Listing-Meta-Right Ends-->
<div class="meta-divider">&nbsp;</div>

<div class="span12 well well-mini" style="margin-left:10px">	
    <?php echo showBookmark('theatres',$content['theatre']['id']);?>
	<?php echo showReport('theatres',$content['theatre']['id']);?>
   <?php
	if(userdata('uid'))
	{
?>
<a href="#review-item" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this movie</a>
<?php }
else
{
?>
<a href="<?php echo base_url() . 'index.php/movies/checkuserlogin/'.$content['theatre']['slug'].'/'.'theatre'; ?>" class="btn send-message btn-primary pull-right" role="button" data-toggle="modal"><i class="icon-star-empty"></i>&nbsp; Review this movie</a>

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
   		echo form_open('actions/report',array('class'=>'bigform','data-parsley-validate'=>'true'));
		echo $this->html->formField('label','Report Type','Please choose report type',array('class'=>'email'));
		echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-parsley-required'=>"true",'id'=>'category'));
		echo $this->html->formField('label','Message','Please enter your message',array('class'=>'email'));
		echo $this->html->formField('textarea','message-required','',array('placeholder'=>'Your message','class'=>'span10','rows'=>'5','data-parsley-required'=>"true"));		
   ?>
   <input type="hidden" value="<?php echo $itemid;?>" name="itemid" />
   <input type="hidden" value="<?php echo 'movies_'.$itemtype;?>" name="itemtype" />
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
		//echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-parsley-required'=>"true",'id'=>'category'));
	?>
	<div class="rating-active-container pull-left"></div><div class="rating-text pull-left"></div>
    <div class="clearbig">&nbsp;</div>
	<?php
		echo $this->html->formField('label','Message','Please write your review',array('class'=>'email'));
		echo $this->html->formField('textarea','message-required','',array('placeholder'=>'Your review','class'=>'span10 wysiwyg','rows'=>'5','data-parsley-required'=>"true"));		
   ?>
   <input type="hidden" value="<?php echo $itemid;?>" name="itemid" />
   <input type="hidden" value="<?php echo $itemtype;?>" name="itemtype" />
   <input type="hidden" value="<?php echo uri_string();?>" name="itemurl" /> 
   <input type="hidden" id="rating-active-score" name="score-required" value="" data-parsley-required="true" />
   		<button class="btn btn-primary submit-btn">Submit Review</button>
        </form>
   
  </div>
  <div class="modal-footer">
    
  </div>
</div>