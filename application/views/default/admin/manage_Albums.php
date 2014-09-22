<h1>Manage Photo Albums</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['albums'] as $album){?>
    <tr>
      <td><?php echo $album['name'];?></td>
      <td><?php echo anchor('admin/photos/editalbum/'.$album['id'],'Edit').' | '.anchor('admin/photos/manage_photos/'.$album['id'],'Manage Photos').' | '.anchor('admin/photos/deletealbum/'.$album['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
//echo $content['navigation'];
?>
