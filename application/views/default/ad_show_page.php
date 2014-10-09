  <div class="container">
  <div class="span20 center clearfix" id="ad-content-holder">
<div class="span6">
    <div id="myCarousel" class="carousel slide">
      <ol class="carousel-indicators">
      <?php
         $pictures=$content['ad']['add_photos'];
		 $pictures=explode(',',$pictures);
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
      <div class="carousel-inner">
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
        <div class="item <?php echo $class;?>"><img src="<?php echo $this->settings->baseUrl().'/uploader/files/thumbnail/'.$pic;?>" /></div>
       <?php 
       $i++;
       }?>
      </div>
      <!-- Carousel nav -->
    </div>
</div><!--photos ends-->
<div class="content-data span12 pull-left left">
	<h1><?php echo $content['ad']['title'];?></h1>  
	<div class="clearfix data">
    <h2>Address</h2>
	<?php echo $content['ad']['address'];?>
    </div>
	<div class="clearfix data">
    <h2>Description</h2>
	<?php echo $content['ad']['description'];?>
    </div>
    <div class="clear">&nbsp;</div>
    <div style="padding:0 40px">
    <?php echo anchor('ads/go/'.$content['ad']['id'],'Click here to visit',array('class'=>'btn btn-success btn-block btn-large'));?>
    </div>
</div><!--content-data -->
<div class="clearbig">&nbsp;</div>
</div>

</div>