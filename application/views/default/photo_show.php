<?php 
$itemtitle=$content['photo']['title'];
$itemid=$content['photo']['id'];
$itemtype='photos';
?>

<style>
.breadcrumb {
  margin: 0px 0 5px !important;
  padding: 8px 3px !important;
  float: left;
}

.related-news{
	float:left;
	margin:15px 0;
}

#galleries{
margin: 15px 0;
float: left;
}
</style>

<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<!--<div class="center clearfix">
<?php echo showAd('image','468','60');?>
</div>-->
<div class="clear">&nbsp;</div>
<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('photos/index/','Photo Galleries');?> <span class="divider">/</span></li>
  <li><?php echo anchor('photos/gallery/'.$this->df->get_field_value('photo_albums',array('id'=>$content['photo']['albumid']),'slug'),$this->df->get_field_value('photo_albums',array('id'=>$content['photo']['albumid']),'name'));?></li>
</ul>
<div class="widget-heading">
<h1><?php echo ucfirst($content['album']['name']);?> (<?php echo count($content['photos']);?> Photos) <p><?php echo htmlspecialchars_decode($content['album']['description']);?></p>
</h1>
</div>
<div class="span13 navi" style="margin:10px 0 0;">
<?php
if($content['prev']!='0')
{
	echo anchor('photos/show/'.$content['prev'][0]['id'],'&larr; Prev',array('class'=>'btn pull-left'));
}
?>
<?php echo $content['photo']['title'];?>
<?php
if($content['next']!='0')
{
	echo anchor('photos/show/'.$content['next'][0]['id'],'Next &rarr;',array('class'=>'btn pull-right'));
}
?>
</div>
	<div class="img-holder well well-mini span12">
    <img src="<?php echo $this->settings->baseUrl().'/uploads/'.$content['photo']['photo'];?>" />
    </div>    
<div class="meta-divider">&nbsp;</div>

<div class="span13" style="margin-left:0px">
<?php 
if(userdata('uid'))
{
?>
<a href="#comment-item" class="btn btn-primary comment-item" role="button" data-toggle="modal"><i class="icon-comment-alt"></i>&nbsp; Post a comment</a>
<?php
}
else
{
?>
<a href="<?php echo base_url().'index.php/start/signin';?>" class="btn btn-primary comment-item" role="button" data-toggle="modal"><i class="icon-comment-alt"></i>&nbsp; Post a comment</a>

<?php }
?><?php echo showBookmark('news',$content['news']['id']);?>    
<?php echo showReport('news',$content['news']['id']);?>
</div>
<div class="meta-divider">&nbsp;</div>
<div class="related-news">
<?php if(count($content['related'])>0){?>
<ul id="galleries">
<div class="widget-heading" style="margin-bottom:15px;"><h4>More from this gallery</h4></div>
<?php
	foreach($content['related'] as $listing)
	{
		//echo $content['listings']['title'];
		if($listing['id']!=$itemid)
		{
?>
<li class="clearfix">
<?php echo anchor('photos/show/'.$listing['id'],'<img src="'.$this->settings->baseUrl().'/uploads/thumb/'.$listing['photo'].'" />',array('class'=>'listing-img'));?>

</li>
<?php	
		}
	}
?>
</ul>
<?php }?>
</div><!--related-news Ends-->
 <div class="clearbig">&nbsp;</div>
<div id="reviews-box">
    <?php  echo $this->general->getComments($itemtype,$itemid,uri_string())?>
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
   		echo form_open('actions/comment',array('class'=>'bigform','data-parsley-validate'=>'true'));
		//echo $this->html->formField('label','Report Type','Please choose a rating',array('class'=>'email'));
		//echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-parsley-required'=>"true",'id'=>'category'));
	?>
    <div class="clearbig">&nbsp;</div>
	<?php
		echo $this->html->formField('label','Message','Your Comment',array('class'=>'email'));
		echo $this->html->formField('textarea','comment-required','',array('placeholder'=>'Your review','class'=>'span10 wysiwyg','rows'=>'5','data-parsley-required'=>"true"));		
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