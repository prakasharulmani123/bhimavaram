<h1>Manage Videos</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['videos'] as $video){?>
    <tr>
      <td><?php echo $video['title'];?></td>
      <td><?php echo anchor('admin/photos/editvideo/'.$video['id'],'Edit').' | '.anchor('admin/photos/deletevideo/'.$video['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
