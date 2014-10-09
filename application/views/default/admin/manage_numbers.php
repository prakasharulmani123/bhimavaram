<h1>Manage Numbers</h1><table class="table table-striped">
  <thead>
    <tr>
      <th>City</th>    
      <th>Name</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($content['numbers'] as $number){?>
    <tr>
     <td><?php echo $this->df->get_field_value('cities',array('id'=>$number['cityid']),'city');?></td>
      <td><?php echo $number['name'];?></td>
      <td><?php echo anchor('admin/numbers/editnumber/'.$number['id'],'Edit').' | '.anchor('admin/numbers/delete/'.$number['id'],'Delete',array('onClick'=>"return confirm('Are you sure to delete?');"));?></td>
    </tr>
   <?php }?>
  </tbody>
</table>
<div class="clearbig">&nbsp;</div>
<?php 
echo $content['navigation'];
?>
