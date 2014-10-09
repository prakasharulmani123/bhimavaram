<h1>Manage Theatres</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>City</th>    
      <th>Name</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['theatres'] as $theatre){?>
    <tr>
     <td><?php echo $this->df->get_field_value('cities',array('id'=>$theatre['cityid']),'city');?></td>
      <td><?php echo $theatre['name'];?></td>
      <td><?php echo anchor('admin/movies/edittheatre/'.$theatre['id'],'Edit').' | '.anchor('admin/movies/deletetheatre/'.$theatre['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
