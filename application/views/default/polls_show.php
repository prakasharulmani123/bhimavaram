<?php 
$itemtitle=$content['poll']['question'];
$itemid=$content['poll']['id'];
$itemtype='polls';
?>
<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>
<div class="clear">&nbsp;</div>
<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('polls/index','Polls');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['poll']['question'],8);?></li></ul>
<div id="news-list" class="span10 pull-left">
<h1 class="noline"><?php echo $content['poll']['question'].' ('.$content['poll']['total_votes'].' Votes)';?></h1>
<div class="clearbig">&nbsp;</div>
<ul id="listings">
<li class="clearfix span12">
<div class="listing-details pull-left">	
<?php echo form_open('polls/vote',array('class'=>'form-horizontal password-form','data-parsley-validate'=>'true'));?>
	<?php
	$answers=$this->df->get_multi_row('poll_answers',array('questionid'=>$content['poll']['id']));
    	foreach($answers as $ans)
		{
			$percent=round(($ans['votes']/$content['poll']['total_votes'])*100,1);
	?>
    <div class="answer-box pull-left span5">
<label class="radio">
  <input type="radio" name="answer"  value="<?php echo $ans['id'];?>" data-parsley-required="true">  
  <?php echo $ans['answer'].' ('.$percent.'% )';?>
</label>
    
	<div class="progress progress-success offset1">    	
      <div class="bar" style="width: <?php echo $percent;?>%"></div>
    </div>
    </div>
	<?php
		}
	?>
    <input type="hidden" name="questionid" value="<?php echo $content['poll']['id'];?>" />
    <input type="hidden" name="slug" value="<?php echo $content['poll']['slug'];?>" />
    <div class="clearbig">&nbsp;</div>
<button type="submit" class="btn btn-danger span6 submit-btn">Submit Vote</button>
     <div class="clearbig">&nbsp;</div>
     </form>
</div>
</li>

</ul>
<div class="clear">&nbsp;</div>
</div>
<div class="span13" style="margin-left:0;">
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
?><?php echo showBookmark('polls',$content['poll']['id']);?>    
</div>
<div class="clearbig">&nbsp;</div>
<div id="reviews-box">
    <?php echo $this->general->getComments($itemtype,$itemid,uri_string())?>
</div><!--Reviews-List Ends-->
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