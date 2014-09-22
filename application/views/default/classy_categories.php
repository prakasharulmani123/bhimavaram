<div class="span20 center clearfix"><?php echo showAd('image','600','90');?></div>
<div class="clearfix">&nbsp;</div>

<div class="search-holder curve4 clearfix alert">	
	  <?php  
	  echo form_open('classifieds/search',array('class'=>'span10','data-validate'=>'parsley'));
	  echo $this->html->formField('input','q-required',postdata('q'),array('placeholder'=>'Search Classifieds','class'=>'abovePadding10 span6 ','data-required'=>"true"));?>
      <input type="submit" class="btn abovePadding10 span4" value="Search Ads">
      </form>
      <div class="span1 divider"> or </div>
      <?php echo anchor('classifieds/add',"Post a Free Ad!",array('class'=>'btn btn-info abovePadding10 span6 pull-right'));?>
</div><!--Search-Holder Ends-->
<h1>Browse Classifieds</h1>
<div class="clearbig">&nbsp;</div>
<ul class="categories span14 pull-left">
<?php 
$catindex=1;
foreach($content['categories'] as $main)
{ 

?>
	<li class="span4 pull-left"><div class="title"><?php echo anchor('classifieds/ads/'.$main['id'],$main['name']); ?></div>
    	<?php
        $getsubcategories=$this->df->get_multi_row('classy_categories',array('parentid'=>$main['id']));
		if(count($getsubcategories)>0)
		{
			$count=0;
			$catcount=count($getsubcategories);
			echo "<ul>";
			foreach($getsubcategories as $sub)
			{
				if($count<5)
				{
				echo "<li>";
				echo anchor('classifieds/ads/'.$sub['id'],ucwords($sub['name']).' ('.$this->df->get_count('classy_listings',array('cityid'=>userdata('cityid'),'category'=>$sub['id'],'active'=>'1')).')');
				echo "</li>";
				$count++;
				}
			}
			if($catcount>5)
			{
				echo "<li class='all-link'>";
				echo anchor('classifieds/ads/'.$main['id'],'See all ('.$catcount.')');
				echo "</li>";
			}
			echo "</ul>";
		}
		?>
    </li>
    
 <?php 
 if(($catindex%3)==0)
 {
	 echo '<div class="clear">&nbsp;</div>';
 }
 $catindex++;
 }?>
</ul>
