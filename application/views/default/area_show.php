<style>
.breadcrumb {
  margin: 0px 0 5px !important;
  padding: 8px 6px !important;
}

.widget-heading h1 {
  border-bottom: 1px dotted #cccccc;
  line-height: 100%;
  margin: 0;
  padding: 0 0 20px;
}

.widget-heading {
	padding:0 !important;
	margin-top:15px;
}

#area-data{
	margin:0 !important;
}

#area-data p.description {
  padding-left: 0 !important;
}

.carousel-indicators {
  top: 20px !important;
}
</style>

<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<div class="">
<!--<div class="full-width span20">-->
<?php 
$itemtitle=$content['area']['name'];
$itemid=$content['area']['id'];
$itemtype='areas';
?>
<!--<div class="clearfix span12 abovePadding10 sidePadding10 center " style="margin-left:10px;">
<?php echo showAd('image','468','60');?>
</div>-->
<div class="clear">&nbsp;</div>

<ul class="breadcrumb">
  <li><?php echo anchor(base_url(),'Home');?><span class="divider">/</span></li>
  <li><?php echo anchor('areas/index',userdata('city').' Areas List');?> <span class="divider">/</span></li>
 <li><?php echo word_limiter($content['area']['name'],8);?></li>
 </ul>
<div class="widget-heading"><h1><?php echo ucfirst($content['area']['name'].', '.userdata('city').' - '.$content['area']['pincode']);?></h1></div>
<div id="listing-details">
<div class="sidePadding10" id="area-data">
		
        <?php if(strlen($content['area']['description'])>3){?>
        
        <div class="sidePadding10 span8">
            <div style="text-align:justify; margin:10px 0;" class="description">
	            <?php echo htmlspecialchars_decode($content['area']['description']);?>
            </div>
        </div>

		<?php }?>
</div><!--Area-data Ends-->
</div>


<div class="span4 pull-right" id="picture-holder">
<div id="myCarousel" class="carousel slide span4">
  <ol class="carousel-indicators">
  <?php
	 $pictures=explode(',',$content['area']['pictures']);
	 //print_r($pictures);
//   
  	for($i=0;$i<count($pictures);$i++) 
	{
		if($i==0)
		{
			$class=' class="active" ';
		}
		else
		{
			$class='';
		}
   ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" <?php echo $class;?>></li>
    <?php
	}
	?>
  </ol>
  <!-- Carousel items -->
  <div class="carousel-inner listing-img detail-img">
  <?php
  $i=0;
  foreach($pictures as $pic)
  {
		if($i==0)
		{
			$class=' active ';
		}
		else
		{
			$class='';
		}
  ?>
    <div class="item <?php echo $class;?>"><img src="<?php echo $this->settings->baseUrl().'/uploads/thumb/'.$pic;?>" /></div>
   <?php 
   $i++;
   }?>
  </div>
  <!-- Carousel nav -->
  <!--<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>-->
</div>
</div><!--picture-holder Ends-->
<div class="clearbig">&nbsp;</div>
<div class="span13" style="margin:0 0 10px;">
<?php echo showBookmark('areas',$content['area']['id']);?>    
 	<div class="share-btn pull-right">
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
       <!-- <a class="addthis_button_facebook"></a>
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_google_plusone_share"></a>
        <a class="addthis_button_pinterest_share"></a>
        <a class="addthis_button_email"></a>-->
        </div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51ed30806c650b5f"></script>
        <!-- AddThis Button END -->
	</div>
</div>
<div id="reviews-box">
    <?php //echo $this->general->getComments($itemtype,$itemid,uri_string())?>
</div><!--Reviews-List Ends-->
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
		//echo $this->html->formField('dropdown','category-required',array(''=>'Select','illegal'=>'Illegal Content','spam'=>'Spam Content','duplicate'=>'Duplicate Content','others'=>'Others'),array('class'=>'span10','data-required'=>"true",'id'=>'category'));
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
