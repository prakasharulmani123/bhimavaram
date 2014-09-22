<h1>Manage Areas</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>City</th>    
      <th>Name</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['areas'] as $area){?>
    <tr>
     <td><?php echo $this->df->get_field_value('cities',array('id'=>$area['cityid']),'city');?></td>
      <td><?php echo $area['name'];?></td>
      <td><?php echo anchor('admin/areas/editarea/'.$area['id'],'Edit').' | '.anchor('admin/areas/delete/'.$area['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
