<?php 
$itemtitle=$content['video']['title'];
$itemid=$content['video']['id'];
$itemtype='videos';
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

<!--<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>-->
<div class="clear">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('videos/index/','Videos');?> <span class="divider">/</span></li>
  <li><?php echo anchor('videos/'.$this->df->get_field_value('videos',array('id'=>$content['video']['id']),'slug'),$this->df->get_field_value('videos',array('id'=>$content['video']['id']),'title'));?></li>
</ul>

<div class="widget-heading" style="margin-bottom:15px;"><h1 style="line-height:normal;"><?php echo $content['video']['title'];?></h1></div>
<div class="span12 navi">
<?php
if($content['prev']!='0')
{
	echo anchor('videos/'.$content['prev'][0]['slug'],'&larr; Prev',array('class'=>'btn pull-left'));
}
?>
<?php //echo $content['photo']['title'];?>
<?php
if($content['next']!='0')
{
	echo anchor('videos/'.$content['next'][0]['slug'],'Next &rarr;',array('class'=>'btn pull-right'));
}
?>
</div>
	<div class="img-holder well well-mini span11">
    
    <?php  
	//print_r($content['video']);
	//echo youtube_embed('http://www.youtube.com/watch?v=zB4b_7ddiLg');
	//echo youtube_embed($content['video']['url'],600,400);
		$utube=new YoutubeVideoDetails();
		$video= parse_url($content['video']['url']);
		parse_str($video['query'], $query);
		$videoKey=$query['v'];
		$utube->video($videoKey);
		echo $utube->get_embed(550,400);
	?>
    </div>    
<div class="meta-divider">&nbsp;</div>

<div class="span13" style="margin:0;">
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
?><?php echo showBookmark('videos',$content['video']['id']);?>    
<?php echo showReport('videos',$content['video']['id']);?>
</div>
<div class="clearbig">&nbsp;</div>
<div class="meta-divider">&nbsp;</div>
<div class="related-news">
<?php if(count($content['related'])>0){?>
<ul id="galleries">
<div class="widget-heading" style="margin-bottom:15px;"><h4>Related Videos</h4></div>
<?php
	$utube=new YoutubeVideoDetails();
	foreach($content['related'] as $listing)
	{
		$video= parse_url($listing['url']);
		parse_str($video['query'], $query);
		$videoKey=$query['v'];
		$utube->video($videoKey);
		$imgurl=str_replace('https','http',$utube->get_thumbnail());
		//echo $content['listings']['title'];
		if($listing['id']!=$itemid)
		{
?>
<li class="clearfix">
<?php echo anchor('videos/'.$listing['slug'],'<img src="'.$imgurl.'" />',array('class'=>'listing-img'));?>

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