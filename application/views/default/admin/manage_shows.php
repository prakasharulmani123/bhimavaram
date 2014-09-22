<h2 class="split-title"><span>Manage Shows of <?php echo $content['theatre']['name'];?></span></h2>
<div id="user-account" class="span18 center-align">
	<div class="span10 ">
    	
    	<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Movie</th>
      <th>ShowTimes</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['movies'] as $movie)
  {?>
    <tr>
      <td><?php echo $this->df->get_field_value('movies_listings',array('id'=>$movie['movieid']),'name');//movie['name'];?></td>
      <td>
      <?php
	  $timings=explode(',',$movie['timings']);
     foreach($timings as $timing)
	 {
	  ?>
      <span class="tm-tag tm-tag-warning" id="tags_1"><span><?php echo $timing;?></span>
      <?php echo anchor('admin/movies/theatre_movie_delete_timing/'.$movie['theatreid'].'/'.$movie['movieid'].'/'.urlencode($timing),'×',array('class'=>"tm-tag-remove"));?>
      </span>
      <?php }?>
      </td>
      <td>
      <?php
      echo anchor('admin/movies/theatre_delete_movie/'.$movie['theatreid'].'/'.$movie['movieid'],'Delete',array('class'=>'delete_movie'));
	  ?>
      </td>      
    </tr>
   <?php 
   
  }?>
  </tbody>
</table>

    </div>
</div>
<?php echo anchor('admin/movies/theatre_add_movie/'.$content['theatre']['id'],'Add a movie',array('class'=>'btn align-center center btn-primary span9 pull-right'));?>