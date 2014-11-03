<?php echo $this->load->view('default/sidebars/top_ad_banner', '', true);?>

<div class="clearfix">&nbsp;</div>

<div class="span14 pull-left">
<div class="search-holder curve4 clearfix">	
	  <?php  
	  echo form_open('yellowpages/search',array('class'=>'span6','data-validate'=>'parsley'));
	  echo $this->html->formField('input','q-required',postdata('q'),array('placeholder'=>'Search business listings','class'=>'abovePadding10 span3 ','data-required'=>"true"));?>
      <input type="submit" class="btn abovePadding10 span3" value="Search Listings">
      </form>
      <div class="span1 divider"> or </div>
      <?php echo anchor('yellowpages/add',"List your business (It's absolutely free!)",array('class'=>'btn btn-info abovePadding10 span5 pull-right'));?>
</div><!--Search-Holder Ends-->
<div class="clearfix">&nbsp;</div>
<div class="widget-heading">
<h1>Browse Listings</h1>
</div>
<div class="clearbig">&nbsp;</div>
<ul class="categories">
<?php 
$catindex=1;
foreach($content['categories'] as $main)
{ 

?>
	<li class="span4 pull-left"><div class="title"><?php echo anchor('yellowpages/listings/'.$main['id'],$main['name']); ?></div>
    	<?php
        $getsubcategories=$this->df->get_multi_row('yp_categories',array('parentid'=>$main['id']));
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
				echo anchor('yellowpages/listings/'.$sub['id'],ucwords($sub['name']).' ('.$this->df->get_count('yp_listings',array('cityid'=>userdata('cityid'),'category'=>$sub['id'],'active'=>'1')).')');
				echo "</li>";
				$count++;
				}
			}
			if($catcount>5)
			{
				echo "<li class='all-link'>";
				echo anchor('yellowpages/listings/'.$main['id'],'See all ('.$catcount.')');
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

</div>
